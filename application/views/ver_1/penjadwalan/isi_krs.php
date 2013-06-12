<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">PENGISIAN KRS</h3>
        <div class="row-fluid">
            <div class="span12">
                <div class="vcard">
                    <img class="thumbnail" src="{base_url}assets/ver_1/admin/images/foto.gif" alt="">
                </div>
                    <ul>
                        <li class="v-heading">
                            User info
                        </li>
                        <li>
                            <span class="item-key">NIM</span>
                            <div class="vcard">{nim}</div>
                        </li>
                        <li>
                            <span class="item-key">Nama Lengkap</span>
                            <div class="vcard-item">{nama}</div>
                        </li>
<!--                        <li>
                            <span class="item-key">Kategori</span>
                            <div class="vcard-item">{kategori}</div>
                        </li>  -->
                        <li>
                            <span class="item-key">Semester</span>
                            <div class="vcard-item">{semester}</div>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</div>
<br>

<br>

<div class="row-fluid">
    <div id="isi" class="span12">
        <h3 class="heading">Mata Kuliah Yang Dapat Diambil (maksimal pengambilan SKS sebanyak 24)</h3>


        <form method="post" action="{action}" class="form-horizontal">
            <div class="control-group">
                <div><input class="btn btn-gebo" type="submit"  value="S I M P A N"></div>
            </div>

         <table class="table table-bordered table-striped" id="smpl_tbl">
            <thead>
            <tr>
                <?php
                foreach($heading as $item){ ?>
                <th><center><?php echo $item; ?></center></th>
                <?php }?>

            </thead>
            <tbody>
            <?php foreach($konten as $items){ ?>
            <?php foreach($items as $item){ ?>
            <td><?php echo $item;?></td>
            <?php } ?></tr>
            <?php }?>

                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Keterangan</h3>
                    </div>
                    <div class="modal-body">
                        <p>Mata Kuliah ini berisi uraian materi tentang bla bla
                            bla bla bla bla bla bla bla bla bla bla bla bla bla
                            bla bla bla bla bla bla bla bla bla bla bla bla </p>
                    </div>
                </div>
            </tbody>
        </table>

    </div>
    <div class="control-group">
        <div action="{action}" class="controls"><input class="btn btn-gebo" type="submit"  value="S I M P A N"></div>
    </div>
    </form>
</div>


