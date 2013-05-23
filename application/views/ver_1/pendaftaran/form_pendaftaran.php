<link rel="stylesheet" href="{assets_url}/js/validation_engine/validationEngine.jquery.css" type="text/css"/>
<script src="{assets_url}/js/validation_engine/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
    <script src="{assets_url}/js/validation_engine/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>


<?php
$opt_tgl = '';
for($i = 1; $i < 32; $i++){
    $opt_tgl .= '<option value="'.$i.'">'.$i.'</option>';
}

$opt_bulan = '';
$arr_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
for($i = 1; $i < 13; $i++){
    $opt_bulan .= '<option value="'.$i.'">'.$arr_bulan[$i].'</option>';
}

$opt_thn = '';
$min = date('Y') - 15;
$span = 40;
for($i = $min; $i > $min - $span; $i--){
    $opt_thn .= '<option value="'.$i.'">'.$i.'</option>';
}

$opt_prop = '<option></option>';
foreach($propinsi as $prop){
    $opt_prop .= '<option value="'.$prop->id.'">'.$prop->nama_propinsi.'</option>';
}

$opt_jen = '<option></option>';
foreach($jenjang_pendidikan as $prop){
    $opt_jen .= '<option value="'.$prop->id.'">'.$prop->jenjang_pendidikan.'</option>';
}

$opt_progdi = '<option></option>';
foreach($progdi as $prop){
    $sel = '';
    if($row['programstudi_kode'] != '' and $row['programstudi_kode'] == $prop->kode){
        $sel = 'selected="selected"';
    }
    $opt_progdi .= '<option '.$sel.' value="'.$prop->kode.'">'.$prop->fname.'/'.$prop->nama.'</option>';
}

$opt_jenisdaftar = '<option></option>';
foreach($jenis_pendaftaran as $prop){
    $opt_jenisdaftar .= '<option value="'.$prop->id.'">'.$prop->nama.'</option>';
}


?>


<!--Page contetn-->
<div class="span8">
    <section>
        <div class="row">
            <div class="span8">
                <form class="form-horizontal" method="post" action="{action}" id="form_pendaftaran">
                    <input name="id" value="<?php echo $row['id']; ?>" type="hidden" />
                    <fieldset>
                        <legend>Form Pendaftaran Mahasiswa</legend>
                        <div class="control-group">
                            <label class="control-label" for="nama">Nama Lengkap</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge validate[required]" id="nama" name="nama" value="<?php echo $row['nama']; ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="tempat_lahir">Tempat Lahir</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge validate[required]" id="tempat_lahir" name="tempat_lahir" value="<?php echo $row['tempat_lahir']; ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
                            <div class="controls">
                                <select id="tgl" name="tgl" class="span1"><?php echo $opt_tgl; ?></select>
                                <select id="bln" name="bln" class="span2"><?php echo $opt_bulan; ?></select>
                                <select id="thn" name="thn" class="span1"><?php echo $opt_thn; ?></select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="propinsi_id">Propinsi</label>
                            <div class="controls">
                                <select id="propinsi_id" name="propinsi_id" class="validate[required]"><?php echo $opt_prop; ?></select>
                            </div>
                        </div>

                        <div class="control-group" style="display:none;" id="field_kab">
                            <label class="control-label" for="kota_kab_id">Kota Kabupaten</label>
                            <div class="controls">
                                <select id="kota_kab_id" name="kota_kab_id"></select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="kodepos">Kode Pos</label>
                            <div class="controls">
                                <input type="text" class="input validate[required]" id="kodepos" name="kodepos" value="<?php echo $row['kodepos']; ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="alamat">Alamat</label>
                            <div class="controls">
                                <textarea class="input-xlarge" id="alamat" name="alamat" rows="3"> <?php echo $row['alamat']; ?></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="telp">Telepon</label>
                            <div class="controls">
                                <input type="text" class="input validate[required]" id="telp" name="telp" value="<?php echo $row['telp']; ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="jenjang_pendidikan_id">Jenjang Pendidikan</label>
                            <div class="controls">
                                <select id="jenjang_pendidikan_id" name="jenjang_pendidikan_id"><?php echo $opt_jen; ?></select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="controls">
                                <select id="jenis_kelamin" name="" class="span2"><option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option></select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="asal_sekolah">Asal Sekolah</label>
                            <div class="controls">
                                <input type="text" class="input validate[required] span3" id="asal_sekolah" name="asal_sekolah" value="<?php echo $row['asal_sekolah']; ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="asal_universitas">Asal Universitas</label>
                            <div class="controls">
                                <input type="text" class="input validate[required] span3" id="asal_universitas" name="asal_universitas" value="<?php echo $row['asal_universitas']; ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="transkrip_nilai">Nilai Transkrip</label>
                            <div class="controls">
                                <input type="file" class="input validate[required] span3" id="transkrip_nilai" name="transkrip_nilai" value="<?php echo $row['transkrip_nilai']; ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="kshu">Nilai SKHU</label>
                            <div class="controls">
                                <input type="file" class="input validate[required] span3" id="skhu" name="skhu" value="<?php echo $row['skhu']; ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="programstudi_kode">Program Studi</label>
                            <div class="controls">
                                <select id="programstudi_kode" name="programstudi_kode" class="span4"><?php echo $opt_progdi; ?></select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="jenis_pendaftaran_id">Jenis Pendaftaran</label>
                            <div class="controls">
                                <select id="jenis_pendaftaran_id" name="jenis_pendaftaran_id"><?php echo $opt_jenisdaftar; ?></select>
                                <p class="help-block">namanya di isi lengkap ya</p>
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <?php if($valid){ ?>
                            <button type="button" class="btn btn-warning" id="daftar">Daftar Sekarang</button>
                            <?php } ?>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </section>
</div>
<!--/Page contetn-->

<script>
    jQuery(document).ready(function($){
        //$('#form_pendaftaran').validationEngine();
        $("#form_pendaftaran").validationEngine();

        $('#daftar').click(function(e){
            var konpirm = confirm('Yakin untuk mendaftar ?,, Perhatian..,setelah mendaftar data sudah tidak bisa diedit kembali.');

            e.preventDefault();
            if(!konpirm){return;}
            console.log('asdasdhfasjhgfliaw');
            alert('Terima kasih sudah mendaftar,, silakan cetak surat2 untuk proses selanjutnya.');

        });

        $('#propinsi_id').change(function(){
            var propinsi = $(this).val();
            if(propinsi == ''){
                $('#field_kab').hide();
                $('#kota_kab_id').removeClass('validate[required]');
                return;
            }
            $.post(base_index + 'json_print/common/get_listkota', {propinsi : $(this).val()}, function(data){
                if(data.valid){
                    var str = '';
                    for(i in data.konten){
                        var row = data.konten[i];
                        str += '<option value="'+row.id+'">'+row.nama_kota+'</option>';

                    }
                    $('#kota_kab_id').html(str);
                    $('#kota_kab_id').addClass('validate[required]');
                    $('#field_kab').show();

                }else{
                    $(this).val('');
                }
            }, 'json');
        });

    });
</script>