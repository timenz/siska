<?php
$f_opt = '<option></option>';
foreach($row_weekday as $row){
    $cl = '';
    if($weekday_id == $row->id){
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
                    <label class="control-label">Ruang</label>
                    <div class="controls"><input type="text" name="ruang" class="input-xlarge" value="{ruang}">
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Weekday</label>
                    <div class="controls"><select name="weekday_id"><?php echo $f_opt; ?></select></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Jam Masuk</label>
                    <div class="controls"><input type="text" name="jam_in" class="input-xlarge" value="{jam_in}">
                        <span class="help-block">format penulisan HH:MM </span>
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Jam Keluar</label>
                    <div class="controls"><input type="text" name="jam_out" class="input-xlarge" value="{jam_out}">
                        <span class="help-block">format penulisan HH:MM </span>
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Kuota</label>
                    <div class="controls"><input type="text" name="kuota" class="input-xlarge" value="{kuota}">
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Keterangan</label>
                    <div class="controls"><input type="text" name="keterangan" class="input-xlarge" value="{keterangan}">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="edit"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>