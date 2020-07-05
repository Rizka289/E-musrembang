<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script accesss allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('form_validation');
        $this->load->helper('cookie');
    }
    public function index()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $data['title'] = 'Halaman Login';
        $this->load->view('templates/login_header', $data);
        $this->load->view('registrasi/login');
        $this->load->view('templates/login_footer');
    }
    public function login()
    {
        $user = [];
        $name = $this->input->post('name');
        $password = $this->input->post('password');

        if ($this->input->post('pilih') == 'desa') {
            $user = $this->db->get_where('desa', ['username' => $name])->row_array();
        } elseif ($this->input->post('pilih') == 'dusun') {
            $user = $this->db->get_where('dusun', ['username' => $name])->row_array();
        }

        if ($name == $user['username'] && password_verify($password, $user['password'])) {
            $data = [
                'user' => $this->input->post('pilih')
            ];
            $this->session->set_userdata($data);

            unset($user["password"]);

            $cookie = array(
                'name'   => 'user',
                'value'  => json_encode($user),
                'expire' => '3600',
                'path' => '/',
                'secure' => TRUE
            );

            setcookie('user', json_encode($user), time() + (86400 * 30), "/");
            if ($this->input->post('pilih') == 'desa') {
                redirect('desa');
            } elseif ($this->input->post('pilih') == 'dusun') {
                redirect('dusun');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Invalid login, please try again
          </div>');
            redirect('login');
        }
    }

    public function registrasi()
    {


        $data['title'] = 'Halaman Login';
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short'
        ]);

        $userDesa = $this->db->count_all('desa');
        $userDusun = $this->db->count_all('dusun');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['jmlhDesa'] = $userDesa;
            $data['jmlhDusun'] = $userDusun;
            $this->Login_model->tambahDataUser();
            $this->load->view('templates/login_header', $data);
            $this->load->view('registrasi/registrasi', $data);
            $this->load->view('templates/login_footer');
        } else {
            $this->Login_model->tambahDataUser();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> You have create an account  </div>');
            redirect('login');
        }
    }
    function ambilJumlahUser($user)
    {
        echo $this->db->count_all($user);
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logged out !
      </div>');

        redirect(base_url());
    }
    public function profile()
    {
        $data['title'] = 'Halaman Profile';

        $this->load->view("templates/header", $data);
        $this->load->view("templates/sidebar");
        $this->load->view("templates/topbar");
        $this->load->view("profile/profile", $data);
        $this->load->view("templates/footer");
    }
    public function userDusun()
    {
        $data['user'] = $this->Login_model->getAll();
        $data['title'] = 'Kelola User Dusun';


        $this->load->view('ext/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kelola user dusun/v_dusun', $data);
        $this->load->view('ext/footer');
    }
    public function hapusDusun($id)
    {
        $this->Login_model->remove($id);
        redirect('Login/userDusun');
    }
}