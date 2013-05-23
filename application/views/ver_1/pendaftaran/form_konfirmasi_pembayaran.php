<link rel="stylesheet" href="{assets_url}/js/validation_engine/validationEngine.jquery.css" type="text/css"/>
<script src="{assets_url}/js/validation_engine/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="{assets_url}/js/validation_engine/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>


<?php

?>


<!--Page contetn-->
<div class="span8">
    <section>
        <div class="row">
            <div class="span8">
                <form class="form-horizontal" method="post" action="{action}" id="form_pembayaran">
                    <fieldset>
                        <legend>Form Konfirmasi Pembayaran</legend>
                        <p>Setelah Anda melakukan pembayaran di bank ini ..</p>

                        <div class="control-group">
                            <label class="control-label" for="no_transaksi_transfer">No Transaksi Transfer</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge validate[required]" id="no_transaksi_transfer" name="no_transaksi_transfer" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="bank">Nama Bank</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge validate[required]" id="bank" name="bank" />
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Simpan</button>
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
        $("#form_pembayaran").validationEngine();

    });
</script>