<?php
$role_opt = '<option></option>';
foreach($row_role as $row){
    $cl = '';
    if($row_user['id_role'] == $row->id){
        $cl = 'selected="selected"';
    }
    $role_opt .= '<option '.$cl.' value="'.$row->id.'">'.$row->role.'</option>';
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
            <input type="hidden" name="id" class="input-xlarge" value="<?php echo $row_user['id']; ?>">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Username</label>
                    <div class="controls"><?php echo $row_user['username']; ?>
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Password</label>
                    <div class="controls"><input type="text" name="password" class="input-xlarge">
                        <span class="help-block">Kosongi jika tidak diganti</span>
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Role</label>
                    <div class="controls"><select name="id_role"><?php echo $role_opt; ?></select></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Nama Karyawan</label>
                    <div class="controls"><?php echo $row_user['nama']; ?></div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="Edit"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>