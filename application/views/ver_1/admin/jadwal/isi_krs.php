<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">PENGISIAN KRS</h3>
        <div class="row-fluid">
            <div class="span12">
                <div class="vcard">
                    <img class="thumbnail" src="{base_url}assets/ver_1/admin/images/foto.gif" alt="">
                    <ul>
                        <li class="v-heading">
                            User info
                        </li>
                        <li>
                            <span class="item-key">NIM</span>
                            <div class="vcard-item">{nim}</div>
                        </li>
                        <li>
                            <span class="item-key">Nama Lengkap</span>
                            <div class="vcard-item">{nama}</div>
                        </li>
                        <li>
                            <span class="item-key">Kategori</span>
                            <div class="vcard-item">{kategori}</div>
                        </li>
                        <li>
                            <span class="item-key">Semester</span>
                            <div class="vcard-item">{semester}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<br>

<div class="row-fluid">
    <div class="span12">
        <h3 class="heading">Mata Kuliah Yang Dapat Diambil</h3>
        <table class="table table-bordered table-striped" id="smpl_tbl">
            <thead>
            <tr>
                <?php
                foreach($heading as $item){ ?>
                <th><?php echo $item; ?></th>
                <?php }?>

            </thead>
            <tbody>
            <?php foreach($konten as $items){ ?>
            <?php foreach($items as $item){ ?>
            <td><?php echo $item;?></td>
            <?php } ?></tr>
            <?php }?>

                <!--                <th class="table_checkbox">Pilih</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Prodi</th>
                <th>Rombel</th>
                <th>Waktu</th>
                <th>Ruang</th>
                <th>Peserta</th>
                <th>Keterangan</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th class="table_checkbox"><input type="checkbox" name="row_sel"></th>
                <th>[label]</th>
                <th>[label]</th>
                <th>[label]</th>
                <th>[label]</th>
                <th>[label]</th>
                <th>{dropdown_ruang}</th>
                <th>[label]</th>
                <th>[label] / 30</th>
                <th><a href="#myModal" role="button" class="btn" data-toggle="modal">View</a></th>-->
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
        <div class="control-group">
            <div class="controls"><input class="btn btn-gebo" type="submit" value="TAMBAH KRS"></div>
        </div>
    </div>
</div>


