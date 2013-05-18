<?php
$role_opt = '<option></option>';
foreach($row_role as $row){
    $role_opt .= '<option value="'.$row->id.'">'.$row->role.'</option>';
}

$k_opt = '<option></option>';
foreach($row_karyawan as $row){
    $k_opt .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
}

?>
<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
        <fieldset>
            <div class="control-group formSep">
                <label class="control-label">{lang_username}</label>
                <div class="controls"><input type="text" name="username" class="input-xlarge"><span class="help-block">{lang_first_password}</span>
                </div>
            </div>
            <div class="control-group formSep">
                <label class="control-label">{lang_role}</label>
                <div class="controls"><select name="id_role"><?php echo $role_opt; ?></select></div>
            </div>
            <div class="control-group formSep">
                <label class="control-label">{lang_karyawan}</label>
                <div class="controls"><select name="id_karyawan"><?php echo $k_opt; ?></select></div>
            </div>
            <div class="control-group">
                <div class="controls"><input class="btn btn-gebo" type="submit" value="{lang_submit}"></div>
            </div>
        </fieldset>
        </form>
    </div>

</div>