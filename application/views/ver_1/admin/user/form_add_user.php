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
<div>
    <h3>{page_title}</h3>
    <div>
        <form method="post" action="{action}">
        <fieldset>
        <div><label>{lang_username}</label><input type="text" name="username"></div>
            <div><label>{lang_role}</label><select name="id_role"><?php echo $role_opt; ?></select></div>
            <div><label>{lang_karyawan}</label><select name="id_karyawan"><?php echo $k_opt; ?></select></div>
            <div>{lang_first_password}</div>
            <div><input type="submit" value="{lang_submit}"></div>
        </fieldset>
        </form>
    </div>

</div>