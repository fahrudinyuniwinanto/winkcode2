<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_group extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_group_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user_group/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user_group/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user_group/index.html';
            $config['first_url'] = base_url() . 'user_group/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_group_model->total_rows($q);
        $user_group = $this->User_group_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_group_data' => $user_group,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/user_group/user_group_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user_group/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user_group/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user_group/index.html';
            $config['first_url'] = base_url() . 'user_group/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_group_model->total_rows($q);
        $user_group = $this->User_group_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_group_data' => $user_group,
            'idhtml' => $idhtml,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/user_group/user_group_lookup',
        );
        
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        $row = $this->User_group_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'group_name' => $row->group_name,
		'note' => $row->note,
		'created_by' => $row->created_by,
		'created_at' => $row->created_at,
		'updated_by' => $row->updated_by,
		'updated_at' => $row->updated_at,'content' => 'backend/user_group/user_group_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_group'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('user_group/create_action'),
	    'id' => set_value('id'),
	    'group_name' => set_value('group_name'),
	    'note' => set_value('note'),
	    'created_by' => set_value('created_by'),
	    'created_at' => set_value('created_at'),
	    'updated_by' => set_value('updated_by'),
	    'updated_at' => set_value('updated_at'),
	    'content' => 'backend/user_group/user_group_form',
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
		'group_name' => $this->input->post('group_name',TRUE),
		'note' => $this->input->post('note',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_by' => $this->input->post('updated_by',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->User_group_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user_group'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->User_group_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user_group/update_action'),
		'id' => set_value('id', $row->id),
		'group_name' => set_value('group_name', $row->group_name),
		'note' => set_value('note', $row->note),
		'created_by' => set_value('created_by', $row->created_by),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_by' => set_value('updated_by', $row->updated_by),
		'updated_at' => set_value('updated_at', $row->updated_at),
	    'content' => 'backend/user_group/user_group_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_group'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'group_name' => $this->input->post('group_name',TRUE),
		'note' => $this->input->post('note',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_by' => $this->input->post('updated_by',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->User_group_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user_group'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->User_group_model->get_by_id($id);

        if ($row) {
            $this->User_group_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user_group'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_group'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('group_name', 'group name', 'trim|required');
	$this->form_validation->set_rules('note', 'note', 'trim|required');
	$this->form_validation->set_rules('created_by', 'created by', 'trim');
	$this->form_validation->set_rules('created_at', 'created at', 'trim');
	$this->form_validation->set_rules('updated_by', 'updated by', 'trim');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "user_group.xls";
        $judul = "user_group";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Group Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Note");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated By");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");

	foreach ($this->User_group_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->group_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->note);
	    xlsWriteNumber($tablebody, $kolombody++, $data->created_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
	    xlsWriteNumber($tablebody, $kolombody++, $data->updated_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file User_group.php */
/* Location: ./application/controllers/User_group.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-08-20 10:09:36 */
/* http://harviacode.com */