<?php
$f_opt = '<option></option>';
foreach($row_fakultas as $row){
    $cl = '';
    if($fakultas_kode == $row->kode){
        $cl = 'selected="selected"';
    }
    $f_opt .= '<option '.$cl.' value="'.$row->kode.'">'.$row->nama.'</option>';
}
$p_opt = '<option></option>';
foreach($row_prodi as $row){
    $cl = '';
    if($programstudi_kode == $row->kode){
        $cl = 'selected="selected"';
    }
    $p_opt .= '<option '.$cl.' value="'.$row->kode.'">'.$row->nama.'</option>';
}
$d_opt = '<option></option>';
foreach($row_karyawan as $row){
    $cl = '';
    if($karyawan_id == $row->id){
        $cl = 'selected="selected"';
    }
    $d_opt .= '<option '.$cl.' value="'.$row->id.'">'.$row->nama.'</option>';
}
?>
<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <input type="hidden" name="id" value="{id}">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">NID</label>
                    <div class="controls"><input type="text" name="nid" class="input-xlarge" value="{nid}">
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Fakultas</label>
                    <div class="controls"><select name="fakultas_kode"><?php echo $f_opt; ?></select></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Program Studi</label>
                    <div class="controls"><select name="programstudi_kode"><?php echo $p_opt; ?></select></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Nama Karyawan</label>
                    <div class="controls"><select name="karyawan_id"><?php echo $d_opt; ?></select></div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="edit"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>