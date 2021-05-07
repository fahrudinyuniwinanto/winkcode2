<?='<?php'?>

//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class <?=ucwords($h->table)?>_model extends CI_Model {

    public $table = '<?=$h->table?>';
    public $id    = '<?=$h->pk?>';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        return [
<?php foreach ($fields as $k => $v): ?>
            '<?=$v->COLUMN_NAME?>',
<?php endforeach?>

        ];
    }

}