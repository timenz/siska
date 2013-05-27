<?php

?>
<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal form_validation_ttip" id="form_pembayaran">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Nama</label>
                    <div class="controls"><?php echo $row['nama']; ?>
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Tanggal Konfirmasi</label>
                    <div class="controls"><?php echo $row['tgl_konfirmasi']; ?></div>
                </div>

                <div class="control-group formSep">
                    <label class="control-label">No Transaksi Transfer</label>
                    <div class="controls"><?php echo $row['no_transaksi_transfer']; ?>
                    </div>
                </div>

                <div class="control-group formSep">
                    <label class="control-label">Bank</label>
                    <div class="controls"><?php echo $row['bank']; ?>
                    </div>
                </div>


                <div class="control-group formSep">
                    <label class="control-label">Set Status</label>
                    <div class="controls"><select name="status" id="status" required>
                            <option value=""  ></option>
                            <option value="accept" >Accept</option>
                            <option value="reject"  >Reject</option>
                        </select></div>
                </div>

                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="edit" id="submit_button"></div>
                </div>
            </fieldset>
        </form>
    </div>

</div>

<script>
    var nama = '<?php echo $row['nama']; ?>';
    $(document).ready(function(){
        //$('#form_pembayaran').validate();
        $('#submit_button').click(function(e){
            var status = $('#status').val(), kon = true;
            if(status == 'accept'){
                var kon = confirm('Yakin untuk MENERIMA konfirmasi pembayaran dari sdr. ' + nama);
            }
            if(status == 'reject'){
                var kon = confirm('Yakin untuk MENOLAK konfirmasi pembayaran dari sdr. ' + nama);
            }

            if(!kon){
                e.preventDefault();
            }

        });
    });
</script>