<?php
$model_opt = '<option></option>';
foreach($row_model as $row){
    $model_opt .= '<option value="'.$row['name'].'">'.$row['dir'].'/'.$row['name'].'</option>';
}

$parent_opt = '<option></option>';
foreach($parent_permission as $row){
    $parent_opt .= '<option value="'.$row->id.'">['.$row->model.'/'.$row->method.'/'.$row->permission.']</option>';
}

?>
<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Parent</label>
                    <div class="controls"><select name="parent_model"><?php echo $parent_opt; ?></select>
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Class Model</label>
                    <div class="controls"><select name="id_role"><?php echo $model_opt; ?></select></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Method</label>
                    <div class="controls"><select name="id_karyawan"></select></div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="{lang_submit}"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>