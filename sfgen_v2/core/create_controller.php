<?php

$string = "<?php
//Subscribe Youtube Channel Peternak Kode on https://youtube.com/c/peternakkode
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $c . " extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        sf_construct();
        \$this->load->model('$m');
        \$this->load->library('form_validation');";

if ($jenis_tabel <> 'reguler_table') {
    $string .= "        \n\t\$this->load->library('datatables');";
}
        
$string .= "
    }";

if ($jenis_tabel == 'reguler_table') {
    
$string .= "\n\n    public function index()
    {   
        sf_validate('M');
        \$q = urldecode(\$this->input->get('q', TRUE));
        \$start = intval(\$this->input->get('start'));
        
        if (\$q <> '') {
            \$config['base_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
            \$config['first_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
        } else {
            \$config['base_url'] = base_url() . '$c_url/index.html';
            \$config['first_url'] = base_url() . '$c_url/index.html';
        }

        \$config['per_page'] = 10;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$data = array(
            '" . $c_url . "_data' => \$$c_url,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
            'content' => 'backend/".strtolower($c)."/".strtolower($c)."_list',
        );
        \$this->load->view(layout(), \$data);
    }";


$string .= "\n\n    public function lookup()
    {
        sf_validate('M');
        \$q = urldecode(\$this->input->get('q', TRUE));
        \$start = intval(\$this->input->get('start'));
        \$idhtml = \$this->input->get('idhtml');
        
        if (\$q <> '') {
            \$config['base_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
            \$config['first_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
        } else {
            \$config['base_url'] = base_url() . '$c_url/index.html';
            \$config['first_url'] = base_url() . '$c_url/index.html';
        }

        \$config['per_page'] = 10;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);


        \$data = array(
            '" . $c_url . "_data' => \$$c_url,
            'idhtml' => \$idhtml,
            'q' => \$q,
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
            'content' => 'backend/".strtolower($c)."/".strtolower($c)."_lookup',
        );
        ob_start();
        \$this->load->view(\$data['content'], \$data);
        return ob_get_contents();
        ob_end_clean();
    }";


} else {
    
$string .="\n\n    public function index()
    {
        \$this->load->view('$c_url/$v_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo \$this->" . $m . "->json();
    }";

}
    
$string .= "\n\n    public function read(\$id) 
    {
        sf_validate('R');
        \$row = \$this->" . $m . "->get_by_id(\$id);
        if (\$row) {
        \$data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
$string .= "\n\t    'content' => 'backend/".strtolower($c)."/".strtolower($c)."_read',";
$string .= "\n\t    );
            \$this->load->view(layout(), \$data);
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$c_url'));
        }
    }

    public function create() 
    {
        sf_validate('C');
        \$data = array(
        'button' => 'Create',
        'action' => site_url('$c_url/create_action'),";
foreach ($all as $row) {
    $string .= "\n\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
}
$string .="\n\t    'content' => 'backend/".strtolower($c)."/".strtolower($c)."_form',";
$string .= "\n\t);
        \$this->load->view(layout(), \$data);
    }
    
    public function create_action() 
    {
        sf_validate('c');        
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    //by @fahrudinyewe@gmail.com
    if($row['column_name']=="created_at"){
        $string .= "\n\t\t'" . $row['column_name'] . "' => date('Y-m-d H:i:s'),";
        continue;
    }
    if($row['column_name']=="created_by"){
        $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->session->userdata('username'),";
        continue;
    }
    if($row['column_name']=="isactive"){
        $string .= "\n\t\t'" . $row['column_name'] . "' => 1,";
        continue;
    }
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}
$string .= "\n\t    );

            \$this->".$m."->insert(\$data);
            \$this->session->set_flashdata('message', 'Data baru berhasil ditambahkan!');
            redirect(site_url('$c_url'));
        }
    }
    
    public function update(\$id) 
    {
        sf_validate('U');
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$data = array(
            'button' => 'Update',
            'action' => site_url('$c_url/update_action'),";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
}
$string .="\n\t    'content' => 'backend/".strtolower($c)."/".strtolower($c)."_form',";
$string .= "\n\t    );
            \$this->load->view(layout(), \$data);
        } else {
            \$this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('$c_url'));
        }
    }
    
    public function update_action() 
    {
        sf_validate('U');
        if(!is_allow('U_'.ucwords(\$this->router->fetch_class()))){
            \$this->session->set_flashdata('message', 'Maaf, Anda tidak memiliki akses untuk membuat data '.ucwords(\$this->router->fetch_class()));
            redirect(site_url(strtolower(\$this->router->fetch_class())));
        }
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->update(\$this->input->post('$pk', TRUE));
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    if($row['column_name']=="updated_at"){
        $string .= "\n\t\t'" . $row['column_name'] . "' => date('Y-m-d H:i:s'),";
        continue;
    }
    if($row['column_name']=="updated_by"){
        $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->session->userdata('username'),";
        continue;
    }
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}    
$string .= "\n\t    );

            \$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
            \$this->session->set_flashdata('message', 'Edit data telah berhasil!');
            redirect(site_url('$c_url'));
        }
    }
    
    public function delete(\$id) 
    {
        sf_validate('D');
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            /*\$data = array(
                'isactive'=>0,
            );
            \$this->Berita_model->update(\$id,\$data);*/
            \$this->".$m."->delete(\$id);
            \$this->session->set_flashdata('message', 'Hapus data berhasil!');
            redirect(site_url('$c_url'));
        } else {
            \$this->session->set_flashdata('message', 'Maaf, data tidak ditemukan');
            redirect(site_url('$c_url'));
        }
    }

    public function _rules() 
    {";
foreach ($non_pk as $row) {
    //by @fahrudinyewe@gmail.com
    if($row['column_name']=="created_at" || $row['column_name']=="created_by" || $row['column_name']=="updated_at" || $row['column_name']=="updated_by" || $row['column_name']=="note" ||  $row['column_name']=="isactive" ||  $row['column_name']=="add_1" ||  $row['column_name']=="add_2"){
        $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim');";
        continue;
    }
    $int = $row3['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
    $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim|required$int');";
}    
$string .= "\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }";

if ($export_excel == '1') {
    $string .= "\n\n    public function excel()
    {
        sf_validate('E');
        \$this->load->helper('exportexcel');
        \$namaFile = \"$table_name.xls\";
        \$judul = \"$table_name\";
        \$tablehead = 0;
        \$tablebody = 1;
        \$nourut = 1;
        //penulisan header
        header(\"Pragma: public\");
        header(\"Expires: 0\");
        header(\"Cache-Control: must-revalidate, post-check=0,pre-check=0\");
        header(\"Content-Type: application/force-download\");
        header(\"Content-Type: application/octet-stream\");
        header(\"Content-Type: application/download\");
        header(\"Content-Disposition: attachment;filename=\" . \$namaFile . \"\");
        header(\"Content-Transfer-Encoding: binary \");

        xlsBOF();

        \$kolomhead = 0;
        xlsWriteLabel(\$tablehead, \$kolomhead++, \"No\");";
foreach ($non_pk as $row) {
        $column_name = label($row['column_name']);
        $string .= "\n\txlsWriteLabel(\$tablehead, \$kolomhead++, \"$column_name\");";
}
$string .= "\n\n\tforeach (\$this->" . $m . "->get_all() as \$data) {
            \$kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber(\$tablebody, \$kolombody++, \$nourut);";
foreach ($non_pk as $row) {
        $column_name = $row['column_name'];
        $xlsWrite = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? 'xlsWriteNumber' : 'xlsWriteLabel';
        $string .= "\n\t    " . $xlsWrite . "(\$tablebody, \$kolombody++, \$data->$column_name);";
}
$string .= "\n\n\t    \$tablebody++;
            \$nourut++;
        }

        xlsEOF();
        exit();
    }";
}

if ($export_word == '1') {
    $string .= "\n\n    public function word()
    {
        sf_validate('W');
        header(\"Content-type: application/vnd.ms-word\");
        header(\"Content-Disposition: attachment;Filename=$table_name.doc\");

        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        \$this->load->view('" . $c_url ."/". $v_doc . "',\$data);
    }";
}

if ($export_pdf == '1') {
    $string .= "\n\n    function pdf()
    {
        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        \$html = \$this->load->view('" . $c_url ."/". $v_pdf . "', \$data, true);
        \$this->load->library('pdf');
        \$pdf = \$this->pdf->load();
        \$pdf->WriteHTML(\$html);
        \$pdf->Output('" . $table_name . ".pdf', 'D'); 
    }";
}

$string .= "\n\n}\n\n/* End of file $c_file */
/* Location: ./application/controllers/$c_file */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator ".date('Y-m-d H:i:s')." */
/* http://harviacode.com */
/* Customized by Youtube Channel: Peternak Kode (A Channel gives many free codes)*/
/* Visit here: https://youtube.com/c/peternakkode */";




$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

//create data master access dan user_access/group_access
// INSERT INTO `master_access` (`id`, `nm_access`, `note`, `created_at`, `created_by`) VALUES (NULL, 'M_PENGUMUMAN', 'PENGUMUMAN', TIMESTAMP(''), NULL);

?>