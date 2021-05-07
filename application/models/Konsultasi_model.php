<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Konsultasi_model extends CI_Model {

    public $table = 'konsultasi';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'nip',
            'nama',
            'email',
            'nomor_telepon',
            'skpd',
            'permasalahan',
            'uraian_permasalahan',
            'note',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }

}