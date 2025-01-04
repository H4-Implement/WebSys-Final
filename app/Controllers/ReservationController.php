<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ReservationController extends BaseController {
    public function index(){
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('login');
        }

        $data['title'] = "Reservation Page";

        // Load the model
        $itemmodel = model('Equipment_model');
        $search = $this->request->getGet('search');
        
        // Query items where STATUS is 'Reserved'
        if ($search) {
            $itemModel->groupStart()
                        ->like('CATEGORY', $search)
                        ->orLike('NAME', $search)
                        ->groupEnd();
        }
    
        // Pagination and data retrieval
        $data['items'] = $itemmodel->paginate(8);
        $data['pager'] = $itemmodel->pager;
        $data['search'] = $search;
        
        // Load the view with filtered data
        return view('include/header', $data)
            .view('include\navbar')
            .view('reservation_view', $data)
            .view('include/footer');    

        }
    
    //CANCEL FUNCTION
    public function cancel($UNIQUEID){
        // Load the Equipment model
        $itemmodel = model('Equipment_model');
    
        // Fetch the current item data to ensure it exists
        $item = $itemmodel->find($UNIQUEID);
    
        if (!$item) {
            // Redirect back with an error if the item doesn't exist
            return redirect()->back()->with('error', 'Item not found.');
        }
    
        // Update the item fields
        $itemmodel->update($UNIQUEID, [
            'RESERVEDBY' => null,
            'STATUS' => 'Available',
            'DATE_RESERVED' => null,
            'DATE_RESERVED_END' => null,
        ]);
        return redirect()->to('reserve')->with('success', 'Item successfully returned.');
    }
    
    //RESERVE BLOCK
    public function reserve($UNIQUEID) {
        // Load the Equipment and User models
        $itemmodel = model('Equipment_model');
        $usermodel = model('Users_model');
        
        if ($this->request->is('POST')) {
            // Retrieve the input from the form
            $studentNumber = $this->request->getPost('RESERVEDBY');
            
            // Query the User_model to fetch the username and role associated with the student number
            $user = $usermodel->where('id', $studentNumber)->first();
            
            if (!$user) {
                return redirect()->back()->with('error', 'Invalid Student Number. Please try again.');
            }
            
            // Check if the user has the role "Associate"
            if ($user['role'] !== 'Associate') {
                return redirect()->back()->with('error', 'Reservation is only allowed for users with the "Associate" role.');
            }
            
            // Prepare data for updating the equipment record
            $itemdata = [
                'RESERVEDBY' => $user['username'],
                'STATUS' => 'Reserved',
                'DATE_RESERVED' => $this->request->getPost('DATE_RESERVED'),
                'DATE_RESERVED_END' => $this->request->getPost('DATE_RESERVED_END'),
            ];
    
            // Update the item with the new data
            $itemmodel->update($UNIQUEID, $itemdata);
    
            // Prepare data for email
            $reservedBy = $user['username'];
            $itemName = $itemmodel->find($UNIQUEID)['NAME'];
            $dateReserved = $this->request->getPost('DATE_RESERVED');
            $dateReservedEnd = $this->request->getPost('DATE_RESERVED_END');
            
            // Send confirmation email
            $email = service('email');
            $email->setSubject('Reservation Confirmation');
            $email->setTo($user['email']);
            $message = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        color: #333;
                        line-height: 1.6;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #fff;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        text-align: center;
                        padding-bottom: 20px;
                    }
                    .header h1 {
                        margin: 0;
                        color: #007bff;
                    }
                    .content {
                        padding: 20px;
                    }
                    .content p {
                        margin: 0 0 10px;
                    }
                    .content .details {
                        margin-top: 10px;
                        padding: 10px;
                        background-color: #f9f9f9;
                        border-left: 4px solid #007bff;
                        border-radius: 5px;
                    }
                    .footer {
                        text-align: center;
                        padding-top: 20px;
                        font-size: 0.9em;
                        color: #777;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h1>Reservation Confirmation</h1>
                    </div>
                    <div class='content'>
                        <p>Dear $reservedBy,</p>
                        <p>We are pleased to confirm that you have successfully reserved the following item:</p>
                        <div class='details'>
                            <p><strong>Item Name:</strong> $itemName</p>
                            <p><strong>Reserved On:</strong> $dateReserved</p>
                            <p><strong>Reservation End Date:</strong> $dateReservedEnd</p>
                        </div>
                        <p>If you need any further assistance or wish to modify your reservation, please contact the ITSO office.</p>
                    </div>
                    <div class='footer'>
                        <p>Thank you for using ITSO services!</p>
                        <p>From ITSO Office</p>
                    </div>
                </div>
            </body>
            </html>
            ";
    
            $email->setMessage($message);
    
            if (!$email->send()) {
                print_r($email->printDebugger());
            }

            // Redirect to the reservation page or a success page
            return redirect()->to('reserve')->with('success', 'Item successfully reserved.');
        }
        
        // Retrieve the item data to display in the view
        $data['item'] = $itemmodel->find($UNIQUEID);
        
        if (!$data['item']) {
            // Redirect to the reservation list if the item is not found
            return redirect()->to('reserve')->with('error', 'Item not found.');
        }
        
        $data['title'] = "Reserve an Item";
        
        return view('include/header', $data)
            .view('include/navbar')
            .view('equipment_reserve', $data)
            .view('include/footer');
    }
    

    //RESCHDULE BLOCK
    public function reschedule($UNIQUEID){
        $itemmodel = model('Equipment_model');
        $usermodel = model('Users_model');

        if ($this->request->is('POST')) {
            $existingItem = $itemmodel->where('UNIQUEID', $UNIQUEID)->first();

            $itemdata = $this->request->getPost([
                'DATE_RESERVED',
                'DATE_RESERVED_END'
            ]);

            // Retain existing RESERVEDBY value if not provided in the POST data
            $itemdata['RESERVEDBY'] = $existingItem['RESERVEDBY'];

            // Update the reservation
            $itemmodel->update($UNIQUEID, $itemdata);

            // Send email notification
            $reservedByUser = $usermodel->where('id', $itemdata['RESERVEDBY'])->first(); 

            if ($reservedByUser) {
                $email = service('email');
                $email->setTo($reservedByUser['email']); 
                $email->setSubject('Reservation Rescheduled');
                $email->setMessage(
                    "Dear {$reservedByUser['name']},\n\n" .
                    "Your reservation has been updated.\n\n" .
                    "New Reservation Details:\n" .
                    "Start Date: {$itemdata['DATE_RESERVED']}\n" .
                    "End Date: {$itemdata['DATE_RESERVED_END']}\n\n" .
                    "Thank you for using our system."
                );

                if (!$email->send()) {
                    log_message('error', "Failed to send email to {$reservedByUser['email']}");
                }
            }

            return redirect()->to('reserve')->with('success', 'Reservation successfully updated.');
        }

        $data['item'] = $itemmodel->where('UNIQUEID', $UNIQUEID)->first();
        $data['title'] = "Edit Item";

        return view('include/header', $data)
            . view('include/navbar')
            . view('equipment_reschedule', $data)
            . view('include/footer');
    }

}

?>