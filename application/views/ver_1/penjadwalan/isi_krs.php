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
            <h1>PENGISIAN KRS</h1>
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
        <h3 class="heading">Mata Kuliah Yang Dapat Diambil</h3>


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
                    <th><center>Pilih</center></th>
                    <th><center>Matakuliah</center></th>
                    <th><center>SKS</center></th>
                    <th><center>Semester</center></th>
                    <th><center>Ruang</center></th>
                    <th><center>Waktu</center></th>
                    <th><center>Hari</center></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($makuls as $makul) : ?>
                <tr>
                    <td>
                        <center><input type="checkbox" name="id_jadwal_krs[]" value="<?php echo $makul->jadwal_krs_id; ?>" /></center>
                        <input type="hidden" name="<?php echo $makul->jadwal_krs_id; ?>" value="<?php echo $makul->sks; ?>" /></td>
                    <td><?php echo $makul->nama; ?></td>
                    <td><center><?php echo $makul->sks; ?></center></td>
                    <td><center><?php echo $makul->semester; ?></center></td>
                    <td><?php echo $makul->ruang; ?></td>
                    <td><?php echo $makul->jam_in; ?></td>
                    <td><center><?php echo $makul->hari; ?></center></td>
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


