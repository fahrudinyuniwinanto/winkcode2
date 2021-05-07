<?php

function sf_construct() {
    $ci            = &get_instance();
    $ci->classname = ucwords($ci->router->fetch_class());
    if (!is_allow('M_' . $ci->classname)) {
        redirect(site_url($ci->classname));
    }
}

function sf_validate($acs) {
    $ci = &get_instance();
    switch ($acs) {
    case 'M':
        $msg = "Maaf, Anda tidak memiliki akses pada menu " . $ci->classname;
        break;
    case 'C':
        $msg = "Maaf, Anda tidak memiliki akses untuk membuat data " . $ci->classname;
        break;
    case 'R':
        $msg = "Maaf, Anda tidak memiliki akses untuk melihat data " . $ci->classname;
        break;
    case 'U':
        $msg = "Maaf, Anda tidak memiliki akses untuk mengedit data " . $ci->classname;
        break;
    case 'D':
        $msg = "Maaf, Anda tidak memiliki akses untuk menghapus data " . $ci->classname;
        break;

    default:
        $msg = "Maaf, Anda tidak memiliki akses.";
        break;
    }
    if (!is_allow($acs . '_' . $ci->classname)) {
        $ci->session->set_flashdata('message', $msg);
        redirect(site_url(strtolower($ci->router->fetch_class())));
    }
}

function sf_curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    // curl_setopt($ch, CURLOPT_POSTREDIR, 3);
    //  curl_setopt($ch,CURLOPT_HEADER, false);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

// pastikan untuk menggunakan sf_upload, di controller._rules field jangan di required
function sf_upload($nama_gambar, $lokasi_gambar, $tipe_gambar, $ukuran_gambar, $name_file_form) {
    $CI                    = &get_instance();
    $nmfile                = $nama_gambar . "_" . time();
    $config['upload_path'] = './' . $lokasi_gambar;
    //tambahi skrip disini is_dir exist
    $config['allowed_types'] = $tipe_gambar;
    $config['max_size']      = $ukuran_gambar;
    $config['file_name']     = $nmfile;
    $CI->load->library('upload', $config);
    $CI->upload->do_upload($name_file_form);
    // die($CI->upload->display_errors());
    $result1 = $CI->upload->data();
    $result  = ['gambar' => $result1];
    $dfile   = $result['gambar']['file_name'];

    return $dfile;
}

function sf_header($title = "SMAN Negeri 5 Magelang", $desc = "", $img_name = 'def') {
    $CI = &get_instance();
    echo '<section class="banner-area relative about-banner" id="home" style="background-image: url(' . base_url() . 'assets/blogsekolah/header/header_' . $img_name . '.jpg);">
                <div class="overlay overlay-bg"></div>
                <div class="container">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="about-content col-lg-12">
                            <h1 class="text-white">
                                ' . $title . '
                            </h1>
                            <p class="text-white link-nav"> ' . $desc . '</p>
                        </div>
                    </div>
                </div>
</section>';
}

function is_logged() {
    $ci = &get_instance();
    if ($ci->session->userdata('logged') != true) {
        redirect('Auth/login', 'refresh');
    }
}

function is_allow($acs) {
    $ci      = &get_instance();
    $lvl     = $_SESSION['level'];
    $isallow = $ci->db->query("SELECT * FROM user_access as aa inner join master_access as bb on aa.kd_access=bb.id WHERE bb.nm_access='$acs' and aa.id_group='$lvl'")->row();
    // die($ci->db->last_query());
    if ($isallow != []) {
        if ($isallow->is_allow == 1) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function get_data_kategori($for_modul, $add_opt = []) {

    $ci                   = &get_instance();
    $data_ref_jenis_rapat = $ci->db
        ->where('for_modul', $for_modul)
        ->get('kategori')->result_array();
    $ref_kategori = [];
    $ref_kategori = $add_opt;
    foreach ($data_ref_jenis_rapat as $v) {
        $ref_kategori[$v['id_kat']] = $v['cat_name'];
    }
    return $ref_kategori;
}

function get_combo($tbl, $id, $nm, $add_opt) {

    $ci   = &get_instance();
    $data = $ci->db->get($tbl)->result_array();
    $res  = [];
    $res  = $add_opt;
    foreach ($data as $v) {
        $res[$v[$id]] = $v[$nm];
    }
    return $res;
}

function data_app($id = 'APP_NAME') {
    $ci            = &get_instance();
    $data_instansi = $ci->db->query("SELECT conf_val FROM sy_config WHERE conf_name='$id'")->row();

    if ($data_instansi != []) {
        return $data_instansi->conf_val;
    } else {
        return "";
    }
}

function layout($l = 'back') {
    if ($l == 'front') {
        return "layout_frontend";
    } else {
        return "layout_backend";
    }
}

function cek_session_akses($link, $id) {
    $ci      = &get_instance();
    $session = $ci->db->query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'")->num_rows();
    if ($session == '0' and $ci->session->userdata('level') != 'admin') {
        redirect(base_url() . 'administrator/home');
    }
}

function get_data_users() {
    $ci = &get_instance();
    $ci->db->select('*')
        ->where_in('level', ['2', '3'])
        ->where('isactive', 1);
    $data_users_disposisi = $ci->db->get('users')->result_array();
    $users_disposisi      = [];
    foreach ($data_users_disposisi as $v) {
        $users_disposisi[$v['id_user']] = $v['fullname'];
    }
    return $users_disposisi;
}

function get_numrows($tbl) {
    $ci = &get_instance();
    $ci->db->select('*');
    $total_row = $ci->db->get($tbl)->num_rows();
    return $total_row;
}

function activate_menu($controller, $by = 'c') {
    //c=controller, f=method/function
    // Getting CI class instance.
    $CI = get_instance();
    // Getting router class to active.
    if ($by == 'c') {
        $class = $CI->router->fetch_class();
    } elseif ($by == 'f') {
        $class = $CI->router->fetch_method();
    }
    return ($class == $controller) ? 'active' : '';
}

function format_rupiah($number) {

    return 'Rp ' . number_format($number);
}

function formatBytes($size, $precision = 2) {
    $base     = log($size, 1024);
    $suffixes = ['', 'K', 'M', 'G', 'T'];

    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

function lookup() {?>
<div class="modal" id="lookup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <h1><i class="fa fa-refresh"></i></h1>
            </div>
        </div>
    </div>
</div>
<?php }

function nama_hari($day) {
    $dayList = [
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu',
    ];

    return $dayList[$day];
}

function tanggal_indo($tanggal) {
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tahun
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tanggal

    echo $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}

function GenerateCode() {
    $possible = '123456789';
    $operator = '+x-';
    $admin    = ['Edy S', 'Bima N', 'Zaki C'];
    $a        = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
    $b        = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
    $opr      = substr($operator, mt_rand(0, strlen($operator) - 1), 1);
    if ($opr == '+') {
        $res = $a + $b;
    } else if ($opr == 'x') {
        $res = $a * $b;
    } else {
        $res = $a - $b;
    }
    $code['adm']  = $admin[mt_rand(0, strlen($operator) - 1)];
    $code['res']  = $res;
    $code['text'] = $a . ' ' . $opr . ' ' . $b . ' =';
    return $code;
}

function integerToRoman($integer) {
    // Convert the integer into an integer (just to make sure)
    $integer = intval($integer);
    $result  = '';

    // Create a lookup array that contains all of the Roman numerals.
    $lookup = array('M' => 1000,
        'CM'                => 900,
        'D'                 => 500,
        'CD'                => 400,
        'C'                 => 100,
        'XC'                => 90,
        'L'                 => 50,
        'XL'                => 40,
        'X'                 => 10,
        'IX'                => 9,
        'V'                 => 5,
        'IV'                => 4,
        'I'                 => 1);

    foreach ($lookup as $roman => $value) {
        // Determine the number of matches
        $matches = intval($integer / $value);

        // Add the same number of characters to the string
        $result .= str_repeat($roman, $matches);

        // Set the integer to be the remainder of the integer and the value
        $integer = $integer % $value;
    }

    // The Roman numeral should be built, return it
    return $result;
}

function nomor_proposal($id_asnaf, $id_program, $m, $y) {
    $CI                 = get_instance();
    $nomor              = getAutoNumber("proposal", "no_surat", "", 3);
    $kode_asnaf_program = $CI->db->query("select note from kategori where id_kat=$id_asnaf")->row()->note;
    $m_romawi           = integerToRoman($m);
    return $no_surat    = $nomor . "/" . $kode_asnaf_program . "-" . $id_program . "/" . $m_romawi . "/" . $y;
}

function getAutoNumber($table, $field, $pref, $length, $where = "") {
    $ci    = &get_instance();
    $query = "SELECT IFNULL(MAX(CONVERT(MID($field," . (strlen($pref) + 1) . "," . ($length - strlen($pref)) . "),UNSIGNED INTEGER)),0)+1 AS NOMOR
                FROM $table WHERE LEFT($field," . (strlen($pref)) . ")='$pref' $where";
    $result = $ci->db->query($query)->row();
    $zero   = "";
    $num    = $length - strlen($pref) - strlen($result->NOMOR);
    for ($i = 0; $i < $num; $i++) {
        $zero = $zero . "0";
    }
    return $pref . $zero . $result->NOMOR;
}

function debug_form_validation() {
    $fields  = array_keys($errors);
    $err_msg = $errors[$fields[0]];
    die($err_msg);
}

function status_terakhir($id) {
    if ($id == 0) {
        $stat = "Pimpinan";
    } elseif ($id == 1) {
        $stat = "Survey";
    } elseif ($id == 2) {
        $stat = "Wakil Pimpinan";
    } elseif ($id == 3) {
        $stat = "Sekretaris";
    } else {
        $stat = "Bendahara";
    }
    return $stat;
}