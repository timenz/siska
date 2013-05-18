<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <input type="hidden" name="id" class="input-xlarge" value="<?php echo $row_kalendar_akademik["id"]; ?>">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Fakultas</label>
                    <div class="controls"><?php echo form_dropdown("fakultas_kode",$row_fakultas,$row_kalendar_akademik["fakultas_kode"], "id='fakultas_kode'"); ?> </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Program Studi</label>
                    <div class="controls"><?php echo form_dropdown("programstudi_kode",$row_programstudi,$row_kalendar_akademik["programstudi_kode"], "id='programstudi_kode'"); ?></div>
                </div>

                <div class="control-group formSep">
                    <label class="control-label">Semester</label>
                    <div class="controls"><?php echo form_dropdown("semester",$row_semester,$row_kalendar_akademik["semester"], "id='semester'"); ?></textarea></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Tahun Akademik</label>
                    <div class="controls"><input type="text" name="tahun_akademik" id="tahun_akademik"size="4" value="<?php echo $row_kalendar_akademik["tahun_akademik"];?>" class="input-mini" /> </div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="Simpan"> {link_back} </div>
                </div>
            </fieldset>
        </form>
    </div>

</div>