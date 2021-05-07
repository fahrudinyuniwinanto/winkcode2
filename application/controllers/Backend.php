<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backend extends CI_Controller
{
    private $m;
    public function __construct()
    {
        parent::__construct();
        is_logged();
    }

    public function index()
    {

        $data = array(
            'content' => 'backend/dashboard',

        );
        $this->load->view(layout(), $data);
    }
}
