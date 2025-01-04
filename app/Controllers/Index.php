<?php

// Set the path
namespace App\Controllers;

class Index extends BaseController{
    public function index(){
        helper('url');
        
        if(!session()->has('isLoggedIn')){
            return redirect()->to('login'); 
        }

        $data['title'] = "ITSO OFFICE";

        return view('include\header', $data)
            .view('include\navbar')
            .view('index_view')
            .view('include\footer');
    }

    public function about(){
        $data['title'] = "About Us";

        return view('include\header', $data)
            .view('include\navbar')
            .view('about_view')
            .view('include\footer');
    }

    public function users(){
        $data['title'] = "Users List";

        return view('include\header', $data)
            .view('include\navbar')
            .view('users_view')
            .view('include\footer');
    }

    public function login(){
        if (session()->has('isLoggedIn')) {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() === 'POST') {
            // Load model
            $usersmodel = model('Users_model');

            $logindata = $this->request->getPost(['username', 'password']);

            $user = $usersmodel
                ->where('username', $logindata['username'])
                ->where('password', $logindata['password'])
                ->first();

            if (!$user) {
                session()->setFlashdata('error', 'Invalid username or password.');
            } elseif ($user['role'] !== 'Admin') {
                session()->setFlashdata('error', 'Admin privileges required.');
            } else {
                session()->set('isLoggedIn', true);
                session()->set('userData', [
                    'username' => $user['username'],
                    'role' => $user['role'],
                ]);
                return redirect()->to('/');
            }
        }

        $data['title'] = "Login";

        return view('include\header', $data)
            . view('login_view')
            . view('include\footer');
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('login');
    }
}

?>