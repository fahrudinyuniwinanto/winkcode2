<div class="input-group m-b">
    <input type="text" ng-model="f.q" class="form-control input-sm q-search" placeholder="" value="<?=@$q?>">
    <span class="input-group-btn"><button type="button" class="btn btn-sm btn-primary btn-search">Cari</button></span>
</div>
<div class="table-responsive">
    <table class="table table-condensed table-bordered table-hover">
        <thead>
            <tr>
            	<?php $i = 0;?>
                <?php if ($data != []): ?>
                <?php foreach (@$data[0] as $k => $v): ?>
                <?php if ($i == 0): ?>
                <?php $pk = $k?>
                <?php elseif ($i == 1): ?>
                <?php $nm = $k?>
                <?php endif?>
                <td>
                    <?=ucwords(str_replace('_', ' ', $k))?>
                </td>
            	<?php $i++;?>
                <?php endforeach?>
                <?php endif?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value): ?>
            <tr class="pointer onclicktrlookup" data-id="<?=@$value[@$pk]?>" data-name="<?=@$value[@$nm]?>" data-json='<?=json_encode($value)?>'>
                <?php foreach ($value as $k => $v): ?>
                <td>
                    <?=$v?>
                </td>
                <?php endforeach?>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>
<?php

$req = "&limit=$limit";
foreach ($this->input->get() as $k => $v) {
    if (!in_array($k, ['start', 'limit'])) {
        $req .= "&$k=$v";
    }
}

$this->load->library('pagination');
$config['page_query_string'] = true;
$config['base_url']          = current_url() . '?' . $req; //'http://example.com/index.php/test/page/';
$config['total_rows']        = $total;
$config['per_page']          = $limit;

$this->pagination->initialize($config);

echo $this->pagination->create_links();

?>