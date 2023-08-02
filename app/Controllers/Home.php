<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Pager\Pager;

class Home extends BaseController
{
    protected $user;

    public function __construct()
    {
        helper(['url']);
        $this->user = new UserModel();
    }

    public function index()
    {
        echo view('inc/header');
        $data['users'] =     $this->user->orderby('id','DESC')->paginate(3,'group1');
        $data['Pager'] = $this->user->pager;
        echo view('home',$data);
        echo view('inc/footer');
    }

    public function saveUser(){
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');

        $this->user->save(["username" => $username , "email" => $email]);

        session()->setFlashdata("selamat","data anda sudah masuk");
        redirect()->to(base_url());
    }
}