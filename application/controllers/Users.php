<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // if(!is_allow('M_'.ucwords($this->router->fetch_class()))){
        //         redirect(site_url('backend'));
        // }
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/index.html';
            $config['first_url'] = base_url() . 'users/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q);
        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'users_data' => $users,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/users/users_list',
        );
        $this->load->view(layout(), $data);
    }

    public function lookup()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $idhtml = $this->input->get('idhtml');
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/index.html';
            $config['first_url'] = base_url() . 'users/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q);
        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q);


        $data = array(
            'users_data' => $users,
            'idhtml' => $idhtml,
            'q' => $q,
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content' => 'backend/users/users_lookup',
        );
        ob_start();
        $this->load->view($data['content'], $data);
        return ob_get_contents();
        ob_end_clean();
    }

    public function read($id) 
    {
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user' => $row->id_user,
		'fullname' => $row->fullname,
		'username' => $row->username,
		'password' => $row->password,
		'email' => $row->email,
		'id_group' => $row->id_group,
		'foto' => $row->foto,
		'telp' => $row->telp,
		'note' => $row->note,
		'created_by' => $row->created_by,
		'updated_by' => $row->updated_by,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
		'note_1' => $row->note_1,'content' => 'backend/users/users_read',
	    );
            $this->load->view(
            layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('users/create_action'),
	    'id_user' => set_value('id_user'),
	    'fullname' => set_value('fullname'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'email' => set_value('email'),
	    'id_group' => set_value('id_group'),
        'nm_id_group'=>set_value('nm_id_group'),
	    'foto' => set_value('foto'),
	    'telp' => set_value('telp'),
	    'note' => set_value('note'),
	    'created_by' => set_value('created_by'),
	    'updated_by' => set_value('updated_by'),
	    'created_at' => set_value('created_at'),
	    'updated_at' => set_value('updated_at'),
	    'note_1' => set_value('note_1'),
	    'content' => 'backend/users/users_form',
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
		'fullname' => $this->input->post('fullname',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		'email' => $this->input->post('email',TRUE),
        // 'id_group' => $this->input->post('id_group',TRUE),
		'id_group' => $this->input->post('id_group',TRUE),//dev
		'foto' => $this->input->post('foto',TRUE),
		'telp' => $this->input->post('telp',TRUE),
		'note' => $this->input->post('note',TRUE),
		'created_by' => $this->session->userdata('id_user'),
		'updated_by' => $this->input->post('updated_by',TRUE),
		'created_at' => date("Y-m-d H:i:s"),
		'updated_at' => $this->input->post('updated_at',TRUE),
		'note_1' => $this->input->post('note_1',TRUE),
	    );

            $this->Users_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('users'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users/update_action'),
		'id_user' => set_value('id_user', $row->id_user),
		'fullname' => set_value('fullname', $row->fullname),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'email' => set_value('email', $row->email),
		'id_group' => set_value('id_group', $row->id_group),
        'nm_id_group'=>set_value('id_group_nm',$row->group_name),
		'foto' => set_value('foto', $row->foto),
		'telp' => set_value('telp', $row->telp),
		'note' => set_value('note', $row->note),
		'created_by' => set_value('created_by', $row->created_by),
		'updated_by' => set_value('updated_by', $row->updated_by),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_at' => set_value('updated_at', $row->updated_at),
		'note_1' => set_value('note_1', $row->note_1),
	    'content' => 'backend/users/users_form',
	    );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $row = $this->Users_model->get_by_id($this->input->post('id_user', TRUE));
        if($this->input->post('password',TRUE)==""){
            $pass = $row->password;
        }else{
            $pass = md5($this->input->post('password',TRUE));
        }

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            $data = array(
		'fullname' => $this->input->post('fullname',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $pass,
		'email' => $this->input->post('email',TRUE),
        // 'id_group' => $this->input->post('id_group',TRUE),
		'id_group' => 1,//dev
		'foto' => $this->input->post('foto',TRUE),
		'telp' => $this->input->post('telp',TRUE),
		'note' => $this->input->post('note',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'updated_by' => $this->session->userdata('id_user'),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => date("Y-m-d H:i:s"),
		'note_1' => $this->input->post('note_1',TRUE),
	    );

            $this->Users_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('fullname', 'fullname', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('id_group', 'id group', 'trim');
	$this->form_validation->set_rules('foto', 'foto', 'trim');
	$this->form_validation->set_rules('telp', 'telp', 'trim|required');
	$this->form_validation->set_rules('note', 'note', 'trim');
	$this->form_validation->set_rules('created_by', 'created by', 'trim');
	$this->form_validation->set_rules('updated_by', 'updated by', 'trim');
	$this->form_validation->set_rules('created_at', 'created at', 'trim');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim');
	$this->form_validation->set_rules('note_1', 'note 1', 'trim');

	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-13 02:45:48 */
/* http://harviacode.com */