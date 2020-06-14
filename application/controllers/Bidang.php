<?php
defined('BASEPATH') or exit('No direct script accesss allowed');

class Bidang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bidang_model');
    }
    function index()
    {
        $data['title'] = 'Halaman Bidang';
        $data['bidang'] = $this->Bidang_model->getAll();
        $data['tbl_t'] = $this->Bidang_model->getTahun();

        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/sidebar');
        $this->load->view('Templates/topbar');
        $this->load->view('Input Data/v_bidang', $data);
        $this->load->view('Templates/footer');
    }
    public function create()
    {
        $Thn = $this->input->post('tahun');
        $kode = $this->input->post('kode_rek');
        $nabid = $this->input->post('nama_bid');

        $objek = array(
            'id_tahun' => $Thn,
            'kode_rek' => $kode,
            'nama_bidang' => $nabid
        );
        $this->Bidang_model->create($objek);
        $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
        redirect('Bidang', 'refresh');
    }
    public function hapus($id)
    {
        $this->Bidang_model->remove($id);
        $this->session->set_flashdata('message', 'Data Berhasil DIhapus');
        redirect('bidang');
    }
    public function edit($id)
    {
        $data['title'] = 'Halaman Edit Bidang';
        $data['isi_bidang'] = $this->Bidang_model->get_id($id);
        $data['tbl_t'] = $this->Bidang_model->getTahun();
        // var_dump($data['isi_bidang']);
        // die;
        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/sidebar');
        $this->load->view('Templates/topbar');
        $this->load->view('Input Data/v_edit_bidang', $data);
        $this->load->view('Templates/footer');
    }
    public function proses_edit()
    {
        $id = $this->input->post('id');
        $kode = $this->input->post('kode_rek');
        $nabid = $this->input->post('nama_bid');

        $objek = array(
            'id_tahun' => $id,
            'kode_rek' => $kode,
            'nama_bidang' => $nabid
        );
        $this->Bidang_model->update($id, $objek);
        $this->session->set_flashdata('message', 'Data Berhasil Diedit');
        redirect('bidang', 'refresh');
    }
}