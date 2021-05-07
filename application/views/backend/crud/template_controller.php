<?='<?php'?>

//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class <?=ucwords($h->table)?> extends CI_Controller {
    private $m;
    function __construct() {
        parent::__construct();
        is_logged();
        // sf_construct();
        $this->load->model('<?=ucwords($h->table)?>_model');
        $this->m = new <?=ucwords($h->table)?>_model();
    }

    public function index() {
        $data = array(
            'content' => "backend/<?=$h->table?>/<?=$h->table?>_frm",
        );
        $this->load->view(layout(), $data);
    }

    public function getList() {
        $frm      = $this->input->get('frm');
        $q        = $this->input->get('q');
        $order_by = $this->input->get('order_by');
        $page     = $this->input->get('page');
        $limit    = $this->input->get('limit');
        $limit    = @$limit == 0 ? 10 : $limit;

        $this->queryList($total, $current, $page, $limit, $q, [1 => 1]);

        $data = $current->result_array();
        header('Content-Type: application/json');
        echo json_encode(compact(['total', 'page', 'limit', 'data', 'q']));
    }

    private function queryList(&$total, &$current, $page, $limit, $q, $arr_where) {
        $total = $this->db->from($this->m->table)
            ->like('<?=@$h->pk?>', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->count_all_results();
        $current = $this->db->from($this->m->table)
            ->like('<?=@$h->pk?>', $q)
            ->group_start()
            ->where($arr_where)
            ->group_end()
            ->limit($limit, ($page * $limit) - $limit)->order_by($this->m->id, $this->m->order)->get();
    }

    public function lookup() {
        $q        = $this->input->get('q');
        $order_by = $this->input->get('order_by');
        $start    = $this->input->get('start');
        $limit    = $this->input->get('limit');
        $limit    = @$limit == 0 ? 10 : $limit;

        $total = $this->db->from($this->m->table)
            ->like('<?=@$h->pk?>', $q)
            ->count_all_results();
        $current = $this->db->from($this->m->table)
            ->like('<?=@$h->pk?>', $q)
            ->limit($limit, $start)->get();
        $data = $current->result_array();
        $this->load->view('backend/lookup', compact(['start', 'total', 'limit', 'data', 'q']));
    }

    public function save() {
        $req = json_decode(file_get_contents('php://input'));
        $h   = $req->h;
        $f   = $req->f;

        $arr = [];
        foreach ($this->m->getFields() as $k => $v) {
            $arr[$v] = @$h->$v;
        }
        if ($f->crud == 'c') {
            $this->db->insert($this->m->table, $arr);
        } else {
            $this->db->replace($this->m->table, $arr);
        }
        header('Content-Type: application/json');
        echo json_encode('Simpan data berhasil');
    }

    public function read($id) {
        $this->db->where($this->m->id, $id);
        $data = $this->db->get($this->m->table, 0, 1);
        $h    = $data->row();
        header('Content-Type: application/json');
        echo json_encode(compact(['h']));
    }

    public function delete($id) {
        $this->db->where($this->m->id, $id);
        $this->db->delete($this->m->table);
        header('Content-Type: application/json');
        echo json_encode('Hapus data berhasil');
    }

    public function prin() {
        $id = $this->input->get('id', TRUE);
        $this->db->where($this->m->id, $id);
        $data = $this->db->get($this->m->table, 0, 1);
        $data = array(
            'h'       => $data->row(),
            'content' => 'backend/<?=$h->table?>/<?=$h->table?>_print',
        );
        $this->load->view('layout_print', $data);
    }
}