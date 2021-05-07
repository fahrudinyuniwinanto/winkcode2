<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Instansi_model extends CI_Model {

    public $table = 'instansi';
    public $id    = 'id_instansi';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id_instansi',
            'kode_instansi',
            'nama_instansi',
            'kepala_instansi',
            'alamat',
            'no_telp',
            'created_by',
            'update_by',
            'created_at',
            'update_at',
            'isactive',

        ];
    }

}