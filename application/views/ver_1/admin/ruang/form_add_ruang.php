<?php
$k_opt = '<option></option>';
foreach($row_weekday as $row){
    $k_opt .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
}
?>
<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Ruang</label>
                    <div class="controls"><input type="text" name="ruang" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Weekday</label>
                    <div class="controls"><select name="weekday_id"><?php echo $k_opt; ?></select></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Jam Masuk</label>
                    <div class="controls"><input type="text" name="jam_in" class="input-xlarge">
                    <span class="help-block">format penulisan HH:MM </span>
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Jam Keluar</label>
                    <div class="controls"><input type="text" name="jam_out" class="input-xlarge">
                        <span class="help-block">format penulisan HH:MM </span>
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Kuota</label>
                    <div class="controls"><input type="text" name="kuota" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Keterangan</label>
                    <div class="controls"><input type="text" name="keterangan" class="input-xlarge">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="tambah"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>