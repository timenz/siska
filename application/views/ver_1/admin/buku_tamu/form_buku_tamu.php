<div class="span12">
    <h3 class="heading">{page_title}</h3>
    <div>
        <form method="post" action="{action}" class="form-horizontal">
            <input type="hidden" name="id" class="input-xlarge" value="<?php echo $row_bukutamu['id']; ?>">
            <fieldset>
                <div class="control-group formSep">
                    <label class="control-label">Nama</label>
                    <div class="controls"><?php echo $row_bukutamu['nama']; ?></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Subject</label>
                    <div class="controls"><?php echo $row_bukutamu['subject']; ?></div>
                </div>

                <div class="control-group formSep">
                    <label class="control-label">Pesan</label>
                    <div class="controls"><textarea id="pesan" readonly="readonly"><?php echo $row_bukutamu['message']; ?></textarea></div>
                </div>
                <div class="control-group formSep">
                    <label class="control-label">Pesan Balasan</label>
                    <div class="controls"><textarea id="reply_message" name="reply_message" ></textarea></div>
                </div>
                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="Simpan"> {link_back} </div>
                </div>
            </fieldset>
        </form>
    </div>

</div>