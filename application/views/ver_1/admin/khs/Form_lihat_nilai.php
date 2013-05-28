<?php
$role_opt = '<option></option>';
//foreach($row_role as $row){
//    $role_opt .= '<option value="'.$row->id.'">'.$row->role.'</option>';
//}
//
//$k_opt = '<option></option>';
//foreach($row_karyawan as $row){
//    $k_opt .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
//}

?>
<div class="span12">
    <h3 class="heading">Form Lihat Nilai</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <fieldset>
                <div class="control-group formSep">ID Mahasiswa
                    <div class="controls"><input type="text" name="username" class="input-xlarge">
                        <span class="help-block">Muncul Nama Mahasiswa</span></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Mata Kuliah</label>
                    <div class="controls"><select name="id_role">
                            <option>Silakan dipilih</option>
                            <?php echo $role_opt; ?></select></div>
                </div>

                <center>
                    <p>&nbsp;</p>
                    <table width="399" border="1">
                        <tr>
                            <td width="74"><div align="center">id makul</div></td>
                            <td width="72"><div align="center">Nama Mata Kuliah</div></td>
                            <td width="71"><div align="center">Nilai</div></td>
                            <td width="74"><div align="center">Bobot</div></td>
                            <td width="74"><div align="center">Jumlah</div></td>
                        </tr>
                    </table>
                    <table border=1>
                        <?php //tambahan Ariawan
                        for ($baris=1;$baris<=9;$baris++)
                        {
                            ?>
                            <tr>
                                <?php
                                for ($kolom=1;$kolom<=5;$kolom++)
                                {
                                    ?>
                                    <td>
                                        <?php
                                        echo "Baris $baris, Kolom $kolom";
                                        ?>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        } //akhir tambahan Ariawan
                        ?>
                    </table>
                    <div align="right">
                        <table width="200" border="1">
                            <tr>
                                <td width="35">Total</td>
                                <td width="71">&nbsp;</td>
                                <td width="72">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>IPK </td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </center>

                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="Save"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>