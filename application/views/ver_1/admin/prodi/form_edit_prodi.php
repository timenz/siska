<?php
$f_opt = '<option></option>';
foreach($row_fakultas as $row){
    $cl = '';
    if($fakultas_kode == $row->kode){
        $cl = 'selected="selected"';
    }
    $f_opt .= '<option '.$cl.' value="'.$row->kode.'">'.$row->nama.'</option>';
}
?>
<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <input type="hidden" name="id" value="{id}">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Kode</label>
                    <div class="controls"><input type="text" name="kode" class="input-xlarge" value="{kode}">
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Nama</label>
                    <div class="controls"><input type="text" name="nama" class="input-xlarge" value="{nama}">
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Fakultas</label>
                    <div class="controls"><select name="fakultas_kode"><?php echo $f_opt; ?></select></div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="edit"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>