<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_access extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged')!=TRUE){
            redirect(site_url('Auth'));
        }
        $this->load->model('Master_access_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'master_access/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'master_access/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'master_access/index.html';
            $config['first_url'] = base_url() . 'master_access/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Master_access_model->total_rows($q);
        $master_access = $this->Master_access_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'master_access_data' => $master_access,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/master_access/master_access_list',
        );
        $this->load->view(layout(), $data);
    }

    public function read($id) 
    {
        $row = $this->Master_access_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nm_access' => $row->nm_access,
		'note' => $row->note,
		'created_at' => $row->created_at,
		'created_by' => $row->created_by,'content' => 'backend/master_access/master_access_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_access'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('master_access/create_action'),
	    'id' => set_value('id'),
	    'nm_access' => set_value('nm_access'),
	    'note' => set_value('note'),
	    'created_at' => set_value('created_at'),
	    'created_by' => set_value('created_by'),
	    'content' => 'backend/master_access/master_access_form',
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
		'nm_access' => $this->input->post('nm_access',TRUE),
		'note' => $this->input->post('note',TRUE),
		'created_at' => date("Y-m-d H:i:s"),
		'created_by' => $this->session->userdata('id_user'),
	    );

            $this->Master_access_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_access'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Master_access_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('master_access/update_action'),
		'id' => set_value('id', $row->id),
		'nm_access' => set_value('nm_access', $row->nm_access),
		'note' => set_value('note', $row->note),
		'created_at' => set_value('created_at', $row->created_at),
		'created_by' => set_value('created_by', $row->created_by),
	    'content' => 'backend/master_access/master_access_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_access'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nm_access' => $this->input->post('nm_access',TRUE),
		'note' => $this->input->post('note',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
	    );

            $this->Master_access_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_access'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Master_access_model->get_by_id($id);

        if ($row) {
            $this->Master_access_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_access'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_access'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nm_access', 'nm access', 'trim|required');
	$this->form_validation->set_rules('note', 'note', 'trim');
	$this->form_validation->set_rules('created_at', 'created at', 'trim');
	$this->form_validation->set_rules('created_by', 'created by', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "master_access.xls";
        $judul = "master_access";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Access");
	xlsWriteLabel($tablehead, $kolomhead++, "Note");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");

	foreach ($this->Master_access_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_access);
	    xlsWriteLabel($tablebody, $kolombody++, $data->note);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
	    xlsWriteNumber($tablebody, $kolombody++, $data->created_by);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=master_access.doc");

        $data = array(
            'master_access_data' => $this->Master_access_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('master_access/master_access_doc',$data);
    }

}

/* End of file Master_access.php */
/* Location: ./application/controllers/Master_access.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-07 02:33:42 */
/* http://harviacode.com */