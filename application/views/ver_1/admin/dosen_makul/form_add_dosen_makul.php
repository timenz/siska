<?php
$k_opt = '<option></option>';
foreach($row_dosen as $row){
    $k_opt .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
}

?>
<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Dosen</label>
                    <div class="controls">
                        <input type="hidden" name="matakuliah_id" value="{matakuliah_id}">
                        <select name="dosen_id"><?php echo $k_opt; ?></select>
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">SKS</label>
                    <div class="controls"><input type="number" name="sks" value="2"></div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="tambah"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>