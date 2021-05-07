<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Pengumuman_model');
        $this->load->model('Berita_model');
        $this->load->model('Galeri_model');
        $this->load->model('Ptk_model');
        $this->load->model('Siswa_model');
        $this->load->model('Slider_model');
        $this->load->model('Video_model');
        $this->load->model('Prestasi_sekolah_model');
        $this->load->model('Prestasi_siswa_model');
        $this->load->model('Prestasi_guru_model');

    }

    public function index() {
        $data = [
            'pengumuman' => $this->Pengumuman_model->get_all(),
            'berita'     => $this->Berita_model->get_all(),
            'galeri'     => $this->Galeri_model->get_all(),
            'slider'     => $this->Slider_model->get_all(),
            'ptk'        => $this->Ptk_model->get_all(),
            'siswa'      => $this->Siswa_model->get_all(),
            'content'    => 'frontend/index.php',
        ];
        $this->load->view('layout_frontend.php', $data);
    }

    public function ptk() {
        $data = [
            'data_ptk' => $this->Ptk_model->get_all(),
            'content'  => "frontend/ptk/ptk_list",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function siswa() {
        $data = [
            'data_siswa' => $this->Siswa_model->get_all(1), //parameter 1=siswa
            'content'    => "frontend/siswa/siswa_list",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function alumni() {
        $data = [
            'data_alumni' => $this->Siswa_model->get_all(0), //parameter 0=alumni
            'content'     => "frontend/alumni/alumni_list",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function prestasi_sekolah() {
        $data = [
            'data_prestasi_sekolah' => $this->Prestasi_sekolah_model->get_all(),
            'content'               => "frontend/prestasi/sekolah_list",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function prestasi_guru() {
        $data = [
            'data_prestasi_guru' => $this->Prestasi_guru_model->get_all(),
            'content'            => "frontend/prestasi/guru_list",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function prestasi_siswa() {
        $data = [
            'data_prestasi_siswa' => $this->Prestasi_siswa_model->get_all(),
            'content'             => "frontend/prestasi/siswa_list",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function hubungi_kami() {
        $data = [
            'content' => "frontend/hubungi_kami/hubungi_kami_index",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function pengumuman() {
        $data = [
            'data_pengumuman' => $this->Pengumuman_model->get_all(),
            'content'         => "frontend/pengumuman/pengumuman_list",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function video() {
        $last_id_video = $this->db->select_max('id_video')->get('video')->row()->id_video;
        $data          = [
            'data_video' => $this->Video_model->get_all(),
            'last_video' => $this->db->where("id_video", $last_id_video)->get('video')->row(),
            'content'    => "frontend/video/video_list",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function galeri() {
        $data = [
            'data_galeri' => $this->Galeri_model->get_all(),
            'content'     => "frontend/galeri/galeri_list",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function list_berita() {
        $data = [
            'data_berita' => $this->Berita_model->get_all(),
            'content'     => "frontend/berita/list_berita",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function single_berita($id) {
        $data = [
            'single_berita' => $this->Berita_model->get_by_id($id),
            'content'       => "frontend/berita/single_berita",
        ];
        $this->load->view(layout('front'), $data);
    }

    public function login() {
        $data = [
            // 'content'=>'frontend/login.php'
        ];
        $this->load->view('frontend/login.php', $data);
    }

}
