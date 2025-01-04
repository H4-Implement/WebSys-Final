<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BorrowController extends BaseController {
    public function index() {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('login');
        }
    
        // Load models
        $itemModel = model('Equipment_model');
        $search = $this->request->getGet('search');
    
        // Apply search conditions
        if ($search) {
            $itemModel->groupStart()
                        ->like('CATEGORY', $search)
                        ->orLike('NAME', $search)
                        ->orLike('STATUS', $search)
                        ->orLike('UNIQUEID', $search)
                        ->orLike('ID', $search)
                        ->groupEnd();
        }
    
        // Pagination and data retrieval
        $data['items'] = $itemModel->paginate(6);
        $data['pager'] = $itemModel->pager;
        $data['search'] = $search;
        $data['title'] = "Borrowing Manager";
    
        return view('include/header', $data)
            . view('include/navbar')
            . view('borrow_view', $data)
            . view('include/footer');
    }

    //BORROW FUNCTION
    public function borrow($UNIQUEID) {
        // Load the Equipment and User models
        $itemmodel = model('Equipment_model');
        $usermodel = model('Users_model');
        
        if ($this->request->is('POST')) {
            // Retrieve the input from the form
            $studentNumber = $this->request->getPost('USEDBY');
            
            // Query the User_model to fetch the username associated with the student number
            $user = $usermodel->where('id', $studentNumber)->first();
            
            if (!$user) {
                return redirect()->back()->with('error', 'Invalid Student Number. Please try again.');
            }
            
            // Prepare data for updating the equipment record
            $itemdata = [
                'USEDBY' => $user['username'], 
                'STATUS' => 'In-Use',
                'DATE_BORROWED' => date('Y-m-d H:i:s'),
            ];
            
            // Update the item with the new data
            $itemmodel->update($UNIQUEID, $itemdata);
            $borrowerName = $user['username'];
            $itemName = $itemmodel->find($UNIQUEID)['NAME'];  
            $dateBorrowed = date('Y-m-d H:i:s');

            $email = service('email');
            $email->setSubject('Borrowed Equipments');
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
                        <h1>Item Borrowed Confirmation</h1>
                    </div>
                    <div class='content'>
                        <p>Dear $borrowerName,</p>
                        <p>We would like to confirm that you have successfully borrowed the following item from ITSO:</p>
                        <div class='details'>
                            <p><strong>Item Name:</strong> $itemName</p>
                            <p><strong>Date Borrowed:</strong> $dateBorrowed</p>
                        </div>
                        <p>If you need any further assistance or wish to return the item, please contact the ITSO office.</p>
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

            // Redirect to the item list or a success page
            return redirect()->to('borrow')->with('success', 'Item successfully borrowed.');
        }
        
        // Retrieve the item data to display in the view
        $data['item'] = $itemmodel->find($UNIQUEID);
        
        if (!$data['item']) {
            // Redirect to the item list if the item is not found
            return redirect()->to('borrow')->with('error', 'Item not found.');
        }
        
        $data['title'] = "Borrow an Item";
        
        return view('include/header', $data)
            .view('include/navbar')
            .view('equipment_borrow', $data)
            .view('include/footer');
    }
    

    public function return($UNIQUEID) {
        // Load models
        $itemmodel = model('Equipment_model');
        $usermodel = model('Users_model');
    
        // Retrieve the item data
        $item = $itemmodel->find($UNIQUEID);
    
        if (!$item) {
            return redirect()->to('item')->with('error', 'Item not found.');
        }
    
        // Retrieve the user who borrowed the item
        $user = $usermodel->where('username', $item['USEDBY'])->first();
    
        if (!$user) {
            return redirect()->to('item')->with('error', 'User not found.');
        }
    
        // Prepare data for updating the item
        $itemData = [
            'USEDBY' => null,
            'STATUS' => 'Available',
        ];
    
        // Prepare email data
        $borrowerName = $user['username'];
        $itemName = $item['NAME'];
        $dateReturned = date('Y-m-d H:i:s');
    
        // Create email service instance
        $email = service('email');
        $email->setSubject('Item Return Confirmation');
        $email->setTo($user['email']);
    
        // Create the email message with embedded values
        $message = "<html>
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
                    <h1>Item Return Confirmation</h1>
                </div>
                <div class='content'>
                    <p>Dear $borrowerName,</p>
                    <p>We would like to confirm that the following item has been successfully returned to ITSO:</p>
                    <div class='details'>
                        <p><strong>Item Name:</strong> $itemName</p>
                        <p><strong>Date Returned:</strong> $dateReturned</p>
                    </div>
                    <p>Thank you for returning the item on time. If you have any further inquiries or need assistance, feel free to contact the ITSO office.</p>
                </div>
                <div class='footer'>
                    <p>Thank you for using ITSO services!</p>
                    <p>From ITSO Office</p>
                </div>
            </div>
        </body>
        </html>
        ";
    
        // Set email body
        $email->setMessage($message);
    
        // Send the email
        if ($itemmodel->update($UNIQUEID, $itemData)) {
            // Send email only after the item is updated
            if ($email->send()) {
                $this->logAction('Return');
                return redirect()->to('borrow')->with('success', 'Item successfully returned and email sent.');
            } else {
                return redirect()->to('borrow')->with('error', 'Item returned, but failed to send email. Please try again.');
            }
        }
    
        // Handle update failure
        return redirect()->to('borrow')->with('error', 'Failed to return the item. Please try again.');
    }    
}