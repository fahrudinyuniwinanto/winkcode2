<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sy_config extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!is_allow('M_'.ucwords($this->router->fetch_class()))){
                redirect(site_url('backend'));
        }
        $this->load->model('Sy_config_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged')!=TRUE){
            redirect(site_url('Auth'));
        }
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'sy_config/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sy_config/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sy_config/index.html';
            $config['first_url'] = base_url() . 'sy_config/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sy_config_model->total_rows($q);
        $sy_config = $this->Sy_config_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sy_config_data' => $sy_config,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sy_config/sy_config_list',
        );
        $this->load->view(layout(), $data);
    }

    public function read($id) 
    {
        $row = $this->Sy_config_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'conf_name' => $row->conf_name,
		'conf_val' => $row->conf_val,
		'note' => $row->note,'content' => 'backend/sy_config/sy_config_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sy_config'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sy_config/create_action'),
	    'id' => set_value('id'),
	    'conf_name' => set_value('conf_name'),
	    'conf_val' => set_value('conf_val'),
	    'note' => set_value('note'),
	    'content' => 'backend/sy_config/sy_config_form',
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
		'conf_name' => $this->input->post('conf_name',TRUE),
		'conf_val' => $this->input->post('conf_val',TRUE),
		'note' => $this->input->post('note',TRUE),
	    );

            $this->Sy_config_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sy_config'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Sy_config_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sy_config/update_action'),
		'id' => set_value('id', $row->id),
		'conf_name' => set_value('conf_name', $row->conf_name),
		'conf_val' => set_value('conf_val', $row->conf_val),
		'note' => set_value('note', $row->note),
	    'content' => 'backend/sy_config/sy_config_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sy_config'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'conf_name' => $this->input->post('conf_name',TRUE),
		'conf_val' => $this->input->post('conf_val',TRUE),
		'note' => $this->input->post('note',TRUE),
	    );

            $this->Sy_config_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sy_config'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Sy_config_model->get_by_id($id);

        if ($row) {
            $this->Sy_config_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sy_config'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sy_config'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('conf_name', 'conf name', 'trim|required');
	$this->form_validation->set_rules('conf_val', 'conf val', 'trim|required');
	$this->form_validation->set_rules('note', 'note', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "sy_config.xls";
        $judul = "sy_config";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Conf Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Conf Val");
	xlsWriteLabel($tablehead, $kolomhead++, "Note");

	foreach ($this->Sy_config_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->conf_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->conf_val);
	    xlsWriteLabel($tablebody, $kolombody++, $data->note);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Sy_config.php */
/* Location: ./application/controllers/Sy_config.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-06 05:25:16 */
/* http://harviacode.com */