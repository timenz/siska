<?php
$k_opt = '<option></option>';
foreach($row_fakultas as $row){
    $k_opt .= '<option value="'.$row->kode.'">'.$row->nama.'</option>';
}
$p_opt = '<option></option>';
foreach($row_prodi as $row){
    $p_opt .= '<option value="'.$row->kode.'">'.$row->nama.'</option>';
}
$d_opt = '<option></option>';
foreach($row_karyawan as $row){
    $d_opt .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
}
?>
<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">NID</label>
                    <div class="controls"><input type="text" name="nid" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Fakultas</label>
                    <div class="controls"><select name="fakultas_kode"><?php echo $k_opt; ?></select></div>
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
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="tambah"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>