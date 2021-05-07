<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Permasalahan_model extends CI_Model {

    public $table = 'permasalahan';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
            'id',
            'permasalahan',
            'type',
            'note',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'isactive',

        ];
    }

}