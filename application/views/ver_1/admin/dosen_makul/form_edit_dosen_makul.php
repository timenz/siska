<?php
$f_opt = '<option></option>';
foreach($row_dosen as $row){
    $cl = '';
    if($dosen_id == $row->id){
        $cl = 'selected="selected"';
    }
    $f_opt .= '<option '.$cl.' value="'.$row->id.'">'.$row->nama.'</option>';
}

?>
<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <input type="hidden" name="id" value="{id}">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Nama Dosen</label>
                    <div class="controls"><select name="dosen_id"><?php echo $f_opt; ?></select></div>
                </div>

                <div class="control-group formSep">
                    <label class="control-label">SKS</label>
                    <div class="controls">
                        <input type="hidden" name="matakuliah_id" value="{matakuliah_id}">
                        <input type="number" name="sks" class="input-xlarge" value="{sks}">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="edit"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>