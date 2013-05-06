<?php
$lv = 'selected="selected"';
$pv = '';
if($jenis_kelamin == 'P')
    $pv = 'selected="selected"';
    $lv = '';
?>
<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <input type="hidden" name="id" value="{id}">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Nama</label>
                    <div class="controls"><input type="text" name="nama" class="input-xlarge" value="{nama}">
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Alamat</label>
                    <div class="controls"><textarea name="alamat">{alamat}</textarea></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Jenis Kelamin</label>
                    <div class="controls"><select name="jenis_kelamin">
                            <option value="L" <?php echo $lv; ?> >Laki laki</option>
                            <option value="P"  <?php echo $pv; ?> >Perempuan</option>
                        </select></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">No Telepon</label>
                    <div class="controls"><input type="text" name="telp" class="input-xlarge" value="{telp}">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="edit"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>