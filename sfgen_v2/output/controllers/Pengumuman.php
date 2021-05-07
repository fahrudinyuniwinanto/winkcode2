<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengumuman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengumuman_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pengumuman/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pengumuman/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pengumuman/index.html';
            $config['first_url'] = base_url() . 'pengumuman/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pengumuman_model->total_rows($q);
        $pengumuman = $this->Pengumuman_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengumuman_data' => $pengumuman,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('pengumuman/pengumuman_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Pengumuman_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pengumuman' => $row->id_pengumuman,
		'judul' => $row->judul,
		'perihal' => $row->perihal,
		'isi' => $row->isi,
		'tgl_pengumuman' => $row->tgl_pengumuman,
		'jam_pengumuman' => $row->jam_pengumuman,
		'created_by' => $row->created_by,
		'update_by' => $row->update_by,
		'created_at' => $row->created_at,
		'update_at' => $row->update_at,
		'isactive' => $row->isactive,
	    );
            $this->load->view('pengumuman/pengumuman_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengumuman'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengumuman/create_action'),
	    'id_pengumuman' => set_value('id_pengumuman'),
	    'judul' => set_value('judul'),
	    'perihal' => set_value('perihal'),
	    'isi' => set_value('isi'),
	    'tgl_pengumuman' => set_value('tgl_pengumuman'),
	    'jam_pengumuman' => set_value('jam_pengumuman'),
	    'created_by' => set_value('created_by'),
	    'update_by' => set_value('update_by'),
	    'created_at' => set_value('created_at'),
	    'update_at' => set_value('update_at'),
	    'isactive' => set_value('isactive'),
	);
        $this->load->view('pengumuman/pengumuman_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'judul' => $this->input->post('judul',TRUE),
		'perihal' => $this->input->post('perihal',TRUE),
		'isi' => $this->input->post('isi',TRUE),
		'tgl_pengumuman' => $this->input->post('tgl_pengumuman',TRUE),
		'jam_pengumuman' => $this->input->post('jam_pengumuman',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'update_by' => $this->input->post('update_by',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'update_at' => $this->input->post('update_at',TRUE),
		'isactive' => $this->input->post('isactive',TRUE),
	    );

            $this->Pengumuman_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengumuman'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pengumuman_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengumuman/update_action'),
		'id_pengumuman' => set_value('id_pengumuman', $row->id_pengumuman),
		'judul' => set_value('judul', $row->judul),
		'perihal' => set_value('perihal', $row->perihal),
		'isi' => set_value('isi', $row->isi),
		'tgl_pengumuman' => set_value('tgl_pengumuman', $row->tgl_pengumuman),
		'jam_pengumuman' => set_value('jam_pengumuman', $row->jam_pengumuman),
		'created_by' => set_value('created_by', $row->created_by),
		'update_by' => set_value('update_by', $row->update_by),
		'created_at' => set_value('created_at', $row->created_at),
		'update_at' => set_value('update_at', $row->update_at),
		'isactive' => set_value('isactive', $row->isactive),
	    );
            $this->load->view('pengumuman/pengumuman_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengumuman'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pengumuman', TRUE));
        } else {
            $data = array(
		'judul' => $this->input->post('judul',TRUE),
		'perihal' => $this->input->post('perihal',TRUE),
		'isi' => $this->input->post('isi',TRUE),
		'tgl_pengumuman' => $this->input->post('tgl_pengumuman',TRUE),
		'jam_pengumuman' => $this->input->post('jam_pengumuman',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'update_by' => $this->input->post('update_by',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'update_at' => $this->input->post('update_at',TRUE),
		'isactive' => $this->input->post('isactive',TRUE),
	    );

            $this->Pengumuman_model->update($this->input->post('id_pengumuman', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengumuman'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pengumuman_model->get_by_id($id);

        if ($row) {
            $this->Pengumuman_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengumuman'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengumuman'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
	$this->form_validation->set_rules('perihal', 'perihal', 'trim|required');
	$this->form_validation->set_rules('isi', 'isi', 'trim|required');
	$this->form_validation->set_rules('tgl_pengumuman', 'tgl pengumuman', 'trim|required');
	$this->form_validation->set_rules('jam_pengumuman', 'jam pengumuman', 'trim|required');
	$this->form_validation->set_rules('created_by', 'created by', 'trim|required');
	$this->form_validation->set_rules('update_by', 'update by', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('update_at', 'update at', 'trim|required');
	$this->form_validation->set_rules('isactive', 'isactive', 'trim|required');

	$this->form_validation->set_rules('id_pengumuman', 'id_pengumuman', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pengumuman.php */
/* Location: ./application/controllers/Pengumuman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-08 05:16:41 */
/* http://harviacode.com */