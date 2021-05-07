<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Crud extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$db = $this->db->database;
		$q = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$db'";
		$dtables = $this->db->query($q);
		$tables = $dtables->result_array();
		$data = array(
			'db' => $db,
			'tables' => $tables,
			'content' => 'backend/crud/crud_frm',
		);
		$this->load->view(layout(), $data);
	}

	public function getFields() {
		$db = $this->input->get('db');
		$table = $this->input->get('table');
		$q = "SELECT * FROM INFORMATION_SCHEMA.`COLUMNS` WHERE TABLE_SCHEMA='$db' and `TABLE_NAME`='$table'";
		$data = $this->db->query($q);
		$fields = $data->result_array();
		$pk = "";
		foreach ($fields as $k => $v) {
			$fields[$k]['CAPTION'] = ucwords(str_replace("_", " ", strtolower($v['COLUMN_NAME'])));
			$fields[$k]['ELEMENT'] = "TEXT";
			if ($pk == "" && $v['COLUMN_KEY'] == 'PRI') {
				$pk = $v['COLUMN_NAME'];
			}
		}

		echo $this->outputJson(compact(['fields', 'pk']));
	}

	public function getCode() {
		$req = json_decode(file_get_contents('php://input'));
		$h = $req->h;
		$fields = $req->fields;

		$model = $this->makeModel($h, $fields);
		$controller = $this->makeController($h, $fields);
		$view = $this->makeView($h, $fields);
		$path_model = APPPATH . "models/" . ucwords($h->table) . '_model.php';
		$path_controller = APPPATH . "controllers/" . ucwords($h->table) . '.php';
		$path_view = APPPATH . "views/backend/" . strtolower($h->table) . "/" . strtolower($h->table) . "_frm.php";
		$res = compact(['path_model', 'path_controller', 'path_view', 'model', 'controller', 'view']);
		echo $this->outputJson(compact(['res']));
	}

	private function makeModel($h, $fields) {
		$data = compact(['h', 'fields']);
		return utf8_encode($this->load->view('backend/crud/template_model', $data, TRUE));
	}
	private function makeController($h, $fields) {
		$data = compact(['h', 'fields']);
		return utf8_encode($this->load->view('backend/crud/template_controller', $data, TRUE));
	}
	private function makeView($h, $fields) {
		$data = compact(['h', 'fields']);
		return utf8_encode($this->load->view('backend/crud/template_view', $data, TRUE));
	}

	public function writeTo() {
		$req = json_decode(file_get_contents('php://input'));
		$path = $req->path;
		$code = $req->code;

		if (file_exists($path)) {
			echo $this->outputJson("File sudah ada sebelumnya", 500);
		} else {
			if (!file_exists(dirname($path))) {
				mkdir(dirname($path), 0755, true);
			}
			$myfile = fopen($path, "w") or die("Unable to open file!");
			fwrite($myfile, html_entity_decode($code));
			fclose($myfile);
			echo $this->outputJson("File berhasil dibuat");
		};

	}

}