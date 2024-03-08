<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\TransaksiModel;
use App\Models\MasterDataModel;

class transaksiController extends Controller
{
    public function index()
    {
        $MasterDataModel = new MasterDataModel();
        $data = [
            'MasterData' => $MasterDataModel->findAll()
        ];
        return view('transaksi',$data);
    }

    public function create(){
        helper(['form']);
        $transaksiModel = new TransaksiModel();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'master_data' => 'required',
                'jumlah' => 'required',
                'users'    => 'required',
            ];

            if ($this->validate($rules)) {
                $transaksiModel->save([
                    'master_data' => $this->request->getPost('master_data'),
                    'jumlah' => $this->request->getPost('jumlah'),
                    'users'    => $this->request->getPost('users'),
                ]);

                return redirect()->to('/transaksi.index')->with('success', 'Traansaksi sukses');
            } 
        }

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