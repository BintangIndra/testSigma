<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;

class UsersController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function register()
    {
        helper(['form']);
        $model = new UserModel();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
                'password' => 'required|min_length[5]',
                'email'    => 'required|valid_email|is_unique[users.email]',
            ];

            if ($this->validate($rules)) {
                $model->save([
                    'username' => $this->request->getPost('username'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'email'    => $this->request->getPost('email'),
                ]);

                return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
            } else {
                return redirect()->to('/register')->withInput()->with('errors', $this->validator->getErrors());
            }
        }

        return view('register');
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $model = new UserModel();
        $user = $model->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            return redirect()->to('/dashboard');
        } else {    
            return redirect()->to('/login')->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}