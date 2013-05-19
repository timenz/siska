<link rel="stylesheet" href="{assets_url}/js/validation_engine/validationEngine.jquery.css" type="text/css"/>
<script src="{assets_url}/js/validation_engine/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="{assets_url}/js/validation_engine/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>


<?php

$opt_progdi = '<option></option>';
foreach($progdi as $prop){
    $opt_progdi .= '<option value="'.$prop->kode.'">'.$prop->fname.'/'.$prop->nama.'</option>';
}


?>
<style>
    img#recaptcha_logo{
        display:none;
    }
    img#recaptcha_tagline{
        display:none;
    }
</style>
<script>
    var RecaptchaOptions = {
        theme : 'clean'
    };
</script>

<!--Page contetn-->
<div class="span8">
    <section>
        <div class="row">
            <div class="span8">
                <form class="form-horizontal" method="post" action="{action}" id="form_pendaftaran">
                    <fieldset>
                        <legend>Form Pendaftaran Mahasiswa</legend>
                        <div class="control-group">
                            <label class="control-label" for="nama">Nama Lengkap</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge validate[required,minSize[5]]" id="nama" name="nama" >
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="telp">Telepon</label>
                            <div class="controls">
                                <input type="text" class="input validate[required,custom[integer],minSize[6]]" id="telp" name="telp">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="programstudi_kode">Program Studi yang Dituju</label>
                            <div class="controls">
                                <select id="programstudi_kode" name="programstudi_kode" class="span4 validate[required]"><?php echo $opt_progdi; ?></select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="email">Email</label>
                            <div class="controls">
                                <input type="text" class="input validate[required,custom[email]] span3" id="email" name="email">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <input type="password" class="input validate[required,minSize[6]] span3" id="password" name="password">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="password2">Ketik Ulang Password</label>
                            <div class="controls">
                                <input type="password" class="input validate[required,equals[password]] span3" id="password2">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="recaptcha">Kode Keamanan</label>
                            <div class="controls">
                                <?php echo re_captcha(); ?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Register</button>

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

        $('#recaptcha_response_field').addClass('validate[required]');

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