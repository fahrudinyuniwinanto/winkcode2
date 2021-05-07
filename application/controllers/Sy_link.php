<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sy_link extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sy_link_model');
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
            $config['base_url'] = base_url() . 'sy_link/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sy_link/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sy_link/index.html';
            $config['first_url'] = base_url() . 'sy_link/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sy_link_model->total_rows($q);
        $sy_link = $this->Sy_link_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sy_link_data' => $sy_link,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/sy_link/sy_link_list',
        );
        $this->load->view(layout(), $data);
    }

    public function read($id) 
    {
        $row = $this->Sy_link_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'rel' => $row->rel,
		'tbl1' => $row->tbl1,
		'tbl2' => $row->tbl2,
		'tblid1' => $row->tblid1,
		'tblid2' => $row->tblid2,
		'note' => $row->note,'content' => 'backend/sy_link/sy_link_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sy_link'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sy_link/create_action'),
	    'id' => set_value('id'),
	    'rel' => set_value('rel'),
	    'tbl1' => set_value('tbl1'),
	    'tbl2' => set_value('tbl2'),
	    'tblid1' => set_value('tblid1'),
	    'tblid2' => set_value('tblid2'),
	    'note' => set_value('note'),
	    'content' => 'backend/sy_link/sy_link_form',
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
		'rel' => $this->input->post('rel',TRUE),
		'tbl1' => $this->input->post('tbl1',TRUE),
		'tbl2' => $this->input->post('tbl2',TRUE),
		'tblid1' => $this->input->post('tblid1',TRUE),
		'tblid2' => $this->input->post('tblid2',TRUE),
		'note' => $this->input->post('note',TRUE),
	    );

            $this->Sy_link_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sy_link'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Sy_link_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sy_link/update_action'),
		'id' => set_value('id', $row->id),
		'rel' => set_value('rel', $row->rel),
		'tbl1' => set_value('tbl1', $row->tbl1),
		'tbl2' => set_value('tbl2', $row->tbl2),
		'tblid1' => set_value('tblid1', $row->tblid1),
		'tblid2' => set_value('tblid2', $row->tblid2),
		'note' => set_value('note', $row->note),
	    'content' => 'backend/sy_link/sy_link_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sy_link'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'rel' => $this->input->post('rel',TRUE),
		'tbl1' => $this->input->post('tbl1',TRUE),
		'tbl2' => $this->input->post('tbl2',TRUE),
		'tblid1' => $this->input->post('tblid1',TRUE),
		'tblid2' => $this->input->post('tblid2',TRUE),
		'note' => $this->input->post('note',TRUE),
	    );

            $this->Sy_link_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sy_link'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Sy_link_model->get_by_id($id);

        if ($row) {
            $this->Sy_link_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sy_link'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sy_link'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('rel', 'rel', 'trim|required');
	$this->form_validation->set_rules('tbl1', 'tbl1', 'trim|required');
	$this->form_validation->set_rules('tbl2', 'tbl2', 'trim|required');
	$this->form_validation->set_rules('tblid1', 'tblid1', 'trim|required');
	$this->form_validation->set_rules('tblid2', 'tblid2', 'trim|required');
	$this->form_validation->set_rules('note', 'note', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "sy_link.xls";
        $judul = "sy_link";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Rel");
	xlsWriteLabel($tablehead, $kolomhead++, "Tbl1");
	xlsWriteLabel($tablehead, $kolomhead++, "Tbl2");
	xlsWriteLabel($tablehead, $kolomhead++, "Tblid1");
	xlsWriteLabel($tablehead, $kolomhead++, "Tblid2");
	xlsWriteLabel($tablehead, $kolomhead++, "Note");

	foreach ($this->Sy_link_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->rel);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tbl1);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tbl2);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tblid1);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tblid2);
	    xlsWriteLabel($tablebody, $kolombody++, $data->note);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Sy_link.php */
/* Location: ./application/controllers/Sy_link.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-06 05:01:53 */
/* http://harviacode.com */