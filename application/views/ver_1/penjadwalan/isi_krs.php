<!--<div class="row-fluid">-->
<!--    <div class="span12">-->
<!--        <h3 class="heading">PENGISIAN KRS</h3>-->
<!--        <div class="row-fluid">-->
<!--            <div class="span12">-->
<!--                <div class="vcard">-->
<!--                    <img class="thumbnail" src="{base_url}assets/ver_1/admin/images/foto.gif" alt="">-->
<!--                </div>-->
<!--                    <ul>-->
<!--                        <li class="v-heading">-->
<!--                            User info-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span class="item-key">NIM</span>-->
<!--                            <div class="vcard">{nim}</div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span class="item-key">Nama Lengkap</span>-->
<!--                            <div class="vcard-item">{nama}</div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span class="item-key">Kategori</span>-->
<!--                            <div class="vcard-item">{kategori}</div>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <span class="item-key">Semester</span>-->
<!--                            <div class="vcard-item">{semester}</div>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<style>
    .heading.top {
        border-bottom: 1px solid #333;
    }
    .info-mahasiswa {
        boder: 1px solid #000;
        padding: 5px;
        background-color: #eee;
    }
    .info-mahasiswa > span {
        float: left;
        min-width: 130px;
    }
    .info-mahasiswa > span > div {
        float: right;
        width: 80%;
    }

</style>

<div class="row-fluid">
    <div class="span12">
        <div class="heading top">
            <h1>PENGISIAN KRS</h3>
        </div>
        <div class="info-mahasiswa">
            <span>NIM </span> <div class="val">: <?php echo $data_mhs['nim']; ?></div>
            <span>Nama Lengkap </span> <div class="val">: <?php echo $data_mhs['nama']; ?></div>
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

         <?php if ($this->session->flashdata('warning')) : ?>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('warning'); ?>
            </div>
         <?php endif; ?>

         <input type="hidden" name="id_mahasiswa" value="<?php echo $data_mhs['id']; ?>" />
         <input type="hidden" name="id_kalendar_akademik" value="<?php echo $kalendar_akademik_id; ?>" />

         <table class="table table-bordered table-striped" id="smpl_tbl">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Ruang</th>
                    <th>Waktu</th>
                    <th>Hari</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($makuls as $makul) : ?>
                <tr>
                    <td>
                        <input type="checkbox" name="id_jadwal_krs[]" value="<?php echo $makul->jadwal_krs_id; ?>" />
                        <input type="hidden" name="<?php echo $makul->jadwal_krs_id; ?>" value="<?php echo $makul->sks; ?>" /></td>
                    <td><?php echo $makul->nama; ?></td>
                    <td><?php echo $makul->sks; ?></td>
                    <td><?php echo $makul->semester; ?></td>
                    <td><?php echo $makul->ruang; ?></td>
                    <td><?php echo $makul->jam_in; ?></td>
                    <td><?php echo $makul->hari; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <div class="control-group">
        <div action="{action}" class="controls"><input class="btn btn-gebo" type="submit" value="S I M P A N"></div>
    </div>
    </form>
</div>


