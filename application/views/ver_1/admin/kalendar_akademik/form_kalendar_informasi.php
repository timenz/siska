<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <input type="hidden" name="id" class="input-xlarge" value="{id_kalendar_informasi}">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Kalendar Akademik</label>
                    <div class="controls">{dropdown_kalendar_akademik}</div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Tanggal Kegiatan</label>
                    <div class="controls">
                        <input type="text" name="tgl_kegiatan_start" id="tgl_kegiatan_start" value="{tgl_kegiatan_start}" class="input-medium datepicker" /> -
                        <input type="text" name="tgl_kegiatan_end" id="tgl_kegiatan_end" value="{tgl_kegiatan_end}" class="input-medium datepicker" />
                   </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Judul Kegiatan</label>
                    <div class="controls">
                        <input type="text" name="judul" id="judul" value="{judul}" />
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Deskripsi Kegiatan</label>
                    <div class="controls">
                        <textarea name="deskripsi" id="deskripsi" class="span8" rows="6">{deskripsi}</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="Simpan"> {link_back} </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>