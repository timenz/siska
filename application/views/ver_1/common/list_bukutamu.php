<?php if (isset($row_bukutamu) and !empty($row_bukutamu)):?>
    <div class="span8">
        <h3><span class="colored">///</span> Daftar Pesan</h3>
        <?php foreach($row_bukutamu as $bukutamu):?>
            <blockquote>
                <p><?php echo $bukutamu->message; ?></p>
                <small><?php echo date("F j, Y", strtotime($bukutamu->tgl_posting)); ?> <cite><?php echo $bukutamu->nama; ?></cite></small>
            </blockquote>

            <?php if ($bukutamu->is_reply):?>
                <blockquote class="pull-right":>
                    <p><?php echo $bukutamu->reply_message; ?></p>
                    <small>Admin</small>
                </blockquote>
                <br style="clear: both;"/>
            <?php endif; ?>

            <hr class="clear clearfix" style=" display:block; clear: both;"/>
        <?php endforeach; ?>
    </div>
<?php endif; ?>