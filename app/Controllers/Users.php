<?php
namespace App\Controllers;

class Users extends BaseController{
    public function index(){
        if(!session()->has('isLoggedIn')){
            return redirect()->to('login'); 
        }
        
        // Load the model
        $usersmodel = model('Users_model');

        // Retrieve the data from the table
        // $data['users'] = $usersmodel->get()->getResult();

         // Get the search query from GET parameters
        $search = $this->request->getGet('search');
        
        if ($search) {
            $usersmodel->like('username', $search)
                    ->orLike('email', $search)
                    ->orLike('fullname', $search);
        }
        // Pagination
        $data['users'] = $usersmodel->paginate(5);
        $data['pager'] = $usersmodel->pager;
        $data['search'] = $search;

        $data['title'] = "List of Users";
        return view('include\header', $data)
            .view('include\navbar')
            .view('users_view', $data)
            .view('include\footer');
    }

    public function add(){
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('login');
        }

        helper(['form', 'url']);

        if ($this->request->is('POST')) {
            // Load model
            $usersmodel = model('Users_model');

            // Retrieve data from form
            $registerData = $this->request->getPost([
                'username',
                'password',
                'email',
                'fullname',
                'role',
            ]);

            // VALIDATIONS
            $rules = [
                'username' => 'required|min_length[3]|max_length[20]',
                'password' => 'required|min_length[8]|max_length[255]|alpha_numeric_punct|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\s]).+$/]',
                'confpassword' => 'required|matches[password]',
                'email' => 'required|valid_email',
                'fullname' => 'required|min_length[3]|max_length[50]',
                'role' => 'required',
            ];
            
            $messages = [
                'username' => [
                    'required' => 'Username is required',
                    'min_length' => 'Username must have at least 3 characters',
                    'max_length' => 'Username must not exceed 20 characters',
                ],
                'password' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must have at least 8 characters',
                    'max_length' => 'Password must not exceed 255 characters',
                    'regex_match' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
                    'alpha_numeric_punct' => 'The password can only contain letters, numbers, spaces, and specific punctuation.',
                ],
                'confpassword' => [
                    'required' => 'Confirm password is required',
                    'matches' => 'Passwords do not match',
                ],
                'email' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Email is invalid',
                ],
                'fullname' => [
                    'required' => 'Fullname is required',
                    'min_length' => 'Fullname must have at least 3 characters',
                    'max_length' => 'Fullname must not exceed 50 characters',
                ],
                'role' => [
                    'required' => 'Role is required',
                ],
            ];

            // Check if the form data passed the validation rules
            if (!$this->validate($rules, $messages)) {
                $data['title'] = "Register New User";

                return view('include\header', $data)
                    . view('include\navbar')
                    . view('userAdd_view')
                    . view('include\footer');
            }

            $registerData['activationcode'] = uniqid();

            // Insert data to the table
            $usersmodel->insert($registerData);

            session()->setFlashdata('success', 'Registration successful!');

            // Send email to activate account
            $email = service('email');
            $email->setSubject('Account Activation');
            $email->setTo($registerData['email']);
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
                        .content a {
                            display: inline-block;
                            padding: 10px 20px;
                            margin-top: 20px;
                            background-color: #007bff;
                            color: #fff;
                            text-decoration: none;
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
                            <h1>Account Activation</h1>
                        </div>
                        <div class='content'>
                            <p>Hello, " . $registerData['fullname'] . ",</p>
                            <p>Thank you for registering. Please click the button below to activate your account:</p>
                            <a href='" . base_url('users/activate/' . $registerData['activationcode']) . "'>Activate Account</a>
                        </div>
                        <div class='footer'>
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

            // Redirect to the users list page
            return redirect()->to('users');
        }

        $data['title'] = "Register New User";

        return view('include\header', $data)
            . view('include\navbar')
            . view('userAdd_view')
            . view('include\footer');
    }

    public function activate($activationcode){
        // load model
        $usersmodel = model('Users_model');

        $user = $usersmodel->where('activationcode', $activationcode)->first();
        $updatedata['active'] = 1;
        $usersmodel->update($user['id'], $updatedata);  

        return redirect()->to('users')->with('success', 'Account activated successfully.');
    }

    //forgetpassword
    public function reset(){
        date_default_timezone_set('Asia/Manila');
        $usersmodel = model('Users_model');

        // Step 1: Send Reset Code
        if ($this->request->getPost('username')) {
            $username = $this->request->getPost('username');
            $user = $usersmodel->where('username', $username)->first();

            if (!$user) {
                return redirect()->back()->with('error', 'Username not found.')->withInput();
            }

            $resetCode = random_int(100000, 999999);
            $expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));

            $usersmodel->update($user['id'], [
                'reset_code' => $resetCode,
                'reset_expiry' => $expiry
            ]);

            $email = service('email');
            $email->setTo($user['email']);
            $email->setSubject('Password Reset Code'); 
            $message = "<p>Hello {$user['username']},</p>
                        <p>Use this 6-digit code to reset your password:</p>
                        <h3>$resetCode</h3>
                        <p>Expires in 10 minutes.</p>";
            $email->setMessage($message);

            if ($email->send()) {
                session()->set('code_sent', true); // Store as regular session data
                session()->set('reset_username', $username); // Store the username in session
                return redirect()->back()->with('success', 'A 6-digit code has been sent to your email.')->withInput();
            } else {
                return redirect()->back()->with('error', 'Failed to send email. Please try again later.')->withInput();
            }
        }

        // Step 2: Reset Password
        if ($this->request->getPost('code') && $this->request->getPost('new_password') && $this->request->getPost('retype_password')) {
            $code = $this->request->getPost('code');
            $newPassword = $this->request->getPost('new_password');
            $retypePassword = $this->request->getPost('retype_password');
            $user = $usersmodel->where('reset_code', $code)->first();

            if (!$user || strtotime($user['reset_expiry']) < time()) {
                return redirect()->back()->with('error', 'Invalid or expired code.')->withInput();
            }

            if ($newPassword !== $retypePassword) {
                return redirect()->back()->with('error', 'Passwords do not match.')->withInput();
            }

            $usersmodel->update($user['id'], [
                'password' => $newPassword,
                'reset_code' => null,
                'reset_expiry' => null
            ]);

            session()->remove('code_sent'); // Clear session state
            session()->remove('reset_username');
            return redirect()->to('login')->with('success', 'Password changed successfully.');
        }

        $data['title'] = "Forgot Password";
        return view('include\header', $data)
            .view('password_view')
            .view('include\footer');
    }

    public function view($id = 0){
        if(!session()->has('isLoggedIn')){
            return redirect()->to('login'); 
        }

        // Load the model
        $usersmodel = model('Users_model');

        // Retrieve the data from the table
        $data['user'] = $usersmodel->where('id', $id)->first();

        $data['title'] = "View User Account";
        return view('include\header', $data)
            .view('include\navbar')
            .view('userView_view', $data)
            .view('include\footer');

    }

    //deactivate account
    public function deactivate($id = 0){
        $usersmodel = model('Users_model');
        $usersmodel->update($id, ['active' => 0]);

        //message
        session()->setFlashdata('success', 'User deactivated successfully.');

        return redirect()->to('users/view/' . $id);
    }

    //reactivate account
    public function reactivate($id = 0){
        $usersmodel = model('Users_model');
        
        // Get user details by ID
        $user = $usersmodel->where('id', $id)->first();
    
        if ($user) {
            // Generate a new activation code
            $newActivationCode = uniqid();
    
            // Update the activation code for the user (without changing 'active' field)
            $updatedData = [
                'activationcode' => $newActivationCode
            ];
            $usersmodel->update($id, $updatedData);
    
            // Send reactivation email with the new activation button
            $email = service('email');
            $email->setSubject('Account Reactivation');
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
                        .content a {
                            display: inline-block;
                            padding: 10px 20px;
                            margin-top: 20px;
                            background-color: #007bff;
                            color: #fff;
                            text-decoration: none;
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
                            <h1>Your Account is Ready for Reactivation</h1>
                        </div>
                        <div class='content'>
                            <p>Hello, " . $user['fullname'] . ",</p>
                            <p>Your account is ready to be reactivated. Please click the button below to confirm the activation:</p>
                            <a href='" . base_url('users/activate/' . $newActivationCode) . "'>Activate Account</a>
                        </div>
                        <div class='footer'>
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
    
            // Flash message for successful reactivation
            session()->setFlashdata('success', 'User reactivation email with a new activation link has been sent.');
    
            // Redirect to the user's view page
            return redirect()->to('users/view/' . $id);
        } else {
            // Handle case where user is not found
            session()->setFlashdata('error', 'User not found.');
            return redirect()->to('users');
        }
    }
    
    public function edit($id = 0){
        if(!session()->has('isLoggedIn')){
            return redirect()->to('login'); 
        }
        
        $usersmodel = model('Users_model');

        if($this->request->is('POST')){
            // Retrieve data from form
            $updatedata = $this->request->getPost([
                'username',
                'email',
                'fullname',
                'role',
            ]);

            // Update data in the table
            $usersmodel->update($id, $updatedata);

            // Redirect to the users list page
            return redirect()->to('users');
        }

        // Retrieve the data from the table
        $data['user'] = $usersmodel->where('id', $id)->first();
        $data['title'] = "Edit User";
        return view('include\header', $data)
            .view('include\navbar')
            .view('userEdit_view', $data)
            .view('include\footer');
    }

    public function delete($id = 0){
        $usersmodel = model('Users_model');
        $usersmodel->delete($id);

        session()->setFlashdata('error', 'User deleted successfully.');

        return redirect()->to('users');
    }
}

?>