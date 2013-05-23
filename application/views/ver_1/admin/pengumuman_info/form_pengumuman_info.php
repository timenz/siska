<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <input type="hidden" name="id" class="input-xlarge" value="{id_pengumuman_info}">
            <fieldset>

                <div class="control-group formSep">
                    <label class="control-label">Tanggal Kegiatan</label>
                    <div class="controls">
                        <input type="text" name="tgl_kegiatan" id="tgl_kegiatan" value="{tgl_kegiatan}" class="input-medium datepicker" /> <small>format: YYYY-MM-DD</small>
                    </div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Jam</label>
                    <div class="controls">
                        <input type="text" name="jam" id="jam" value="{jam}" class="input-mini" /><small>format: HH:mm</small>
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