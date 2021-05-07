<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_access extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
         if ($this->session->userdata('logged')!=TRUE){
            redirect(site_url('Auth'));
        }
        $this->load->model('User_access_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user_access/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user_access/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user_access/index.html';
            $config['first_url'] = base_url() . 'user_access/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_access_model->total_rows($q);
        $user_access = $this->User_access_model->get_limit_data_cek($config['per_page'], $start, $q);
        // print_r($user_access);die();
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_access_data' => $user_access,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/user_access/user_access_cek',
        );
        $this->load->view(layout(), $data);
    }

    public function index_list()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user_access/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user_access/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user_access/index.html';
            $config['first_url'] = base_url() . 'user_access/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_access_model->total_rows($q);
        $user_access = $this->User_access_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_access_data' => $user_access,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/user_access/user_access_list',
        );
        $this->load->view(layout(), $data);
    }

    public function read($id) 
    {
        $row = $this->User_access_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_group' => $row->id_group,
		'kd_access' => $row->kd_access,
		'nm_access' => $row->nm_access,
		'is_allow' => $row->is_allow,
		'note' => $row->note,'content' => 'backend/user_access/user_access_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_access'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('user_access/create_action'),
	    'id' => set_value('id'),
	    'id_group' => set_value('id_group'),
	    'kd_access' => set_value('kd_access'),
	    'nm_access' => set_value('nm_access'),
	    'is_allow' => set_value('is_allow'),
	    'note' => set_value('note'),
	    'content' => 'backend/user_access/user_access_form',
	);
        $this->load->view(layout(), $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_group' => $this->input->post('id_group',TRUE),
		'kd_access' => $this->input->post('kd_access',TRUE),
		'nm_access' => $this->input->post('nm_access',TRUE),
		'is_allow' => $this->input->post('is_allow',TRUE),
		'note' => $this->input->post('note',TRUE),
	    );

            $this->User_access_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user_access'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->User_access_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user_access/update_action'),
		'id' => set_value('id', $row->id),
		'id_group' => set_value('id_group', $row->id_group),
		'kd_access' => set_value('kd_access', $row->kd_access),
		'nm_access' => set_value('nm_access', $row->nm_access),
		'is_allow' => set_value('is_allow', $row->is_allow),
		'note' => set_value('note', $row->note),
	    'content' => 'backend/user_access/user_access_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_access'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_group' => $this->input->post('id_group',TRUE),
		'kd_access' => $this->input->post('kd_access',TRUE),
		'nm_access' => $this->input->post('nm_access',TRUE),
		'is_allow' => $this->input->post('is_allow',TRUE),
		'note' => $this->input->post('note',TRUE),
	    );

            $this->User_access_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user_access'));
        }
    }
    

    public function aktifkan() 
    {
        // print_r($_POST);die();
        $isradiocheck = $this->input->post('ischeck', TRUE);//die($isradiocheck);
        //$ischeck = $isradiocheck==1?0:1;//rubah status
        // $iduseraccess = $this->input->post('iduseraccess', TRUE);die($iduseraccess);
        $kdmasteraccess = $this->input->post('kdmasteraccess', TRUE);
        $idgroup = $this->input->post('idgroup', TRUE);
        
        if ($this->User_access_model->existing($idgroup,$kdmasteraccess)) {
// die($isradiocheck);
            $iduseraccess = $this->db->query("select id from user_access where kd_access=$kdmasteraccess and id_group=$idgroup")->row()->id;
            //die($iduseraccess);
            $data = array(
                'is_allow'=>$isradiocheck,
        );

            $this->User_access_model->update($iduseraccess, $data);
        }else{
            $this->User_access_model->insert(array('id_group'=>$idgroup,'kd_access'=>$kdmasteraccess,'is_allow'=>1));
        }
           
        
    }
    
    public function delete($id) 
    {
        $row = $this->User_access_model->get_by_id($id);

        if ($row) {
            $this->User_access_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user_access'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_access'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_group', 'id group', 'trim|required');
	$this->form_validation->set_rules('kd_access', 'kd access', 'trim|required');
	$this->form_validation->set_rules('nm_access', 'nm access', 'trim|required');
	$this->form_validation->set_rules('is_allow', 'is allow', 'trim|required');
	$this->form_validation->set_rules('note', 'note', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "user_access.xls";
        $judul = "user_access";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Group");
	xlsWriteLabel($tablehead, $kolomhead++, "Kd Access");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Access");
	xlsWriteLabel($tablehead, $kolomhead++, "Is Allow");
	xlsWriteLabel($tablehead, $kolomhead++, "Note");

	foreach ($this->User_access_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_group);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kd_access);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_access);
	    xlsWriteNumber($tablebody, $kolombody++, $data->is_allow);
	    xlsWriteLabel($tablebody, $kolombody++, $data->note);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file User_access.php */
/* Location: ./application/controllers/User_access.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-20 10:09:30 */
/* http://harviacode.com */