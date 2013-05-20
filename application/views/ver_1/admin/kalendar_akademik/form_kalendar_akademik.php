<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <input type="hidden" name="id" class="input-xlarge" value="{id_kalendar_akademik}">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Fakultas</label>
                    <div class="controls">{dropdown_fakultas}</div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Program Studi</label>
                    <div class="controls">{dropdown_programstudi}</div>
                </div>

                <div class="control-group formSep">
                    <label class="control-label">Semester</label>
                    <div class="controls">{dropdown_semester}</textarea></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Tahun Akademik</label>
                    <div class="controls"><input type="text" name="tahun_akademik" id="tahun_akademik"size="4" value="{tahun_akademik}" class="input-mini" /> </div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="Simpan"> {link_back} </div>
                </div>
            </fieldset>
        </form>
    </div>

</div>