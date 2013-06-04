<div  class="span12">
    <h3 class="heading">{page_title}</h3>

    <h4>
        <?php
        foreach($konten2 as $items2){ ?>
            <?php foreach($items2 as $item2){ ?>
                <?php echo $item2; ?>
            <?php } ?>
        <?php }?>
    </h4>
</div>
<div>
    <form action="" method="post" >
    <table class="table table-striped">
        <tr>
            <td>{title2}</td>
            <td>{dropdown_jadwal}</td>
            <td><input class="btn btn-gebo" type="submit" value="DAFTAR MAHASISWA"></td>
        </tr>
    </table>
    </form>
        <form method="post" action="{action}" class="form-horizontal">
            <fieldset>
                <div>
                    <table class="table table-striped">
                        <thead><tr><?php
                            foreach($heading as $item){ ?>
                                <th><?php echo $item; ?></th>
                            <?php }?></tr></thead>
                        <tbody><?php
                        foreach($konten as $items){ ?>
                            <tr><?php foreach($items as $item){ ?>
                                    <td><?php echo $item; ?></td>
                                <?php } ?></tr>
                        <?php }?></tbody>
                    </table>
                </div>

                <div class="control-group">
                    <div class="controls"><input class="btn btn-gebo" type="submit" value="SAVE"></div>
                </div>
            </fieldset>
        </form>

    </div>