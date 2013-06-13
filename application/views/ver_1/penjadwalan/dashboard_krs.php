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
            <h2>Kartu Rencana Studi - Semester <?php echo $mhs['semester']; ?> Tahun <?php echo $tahun_akademik; ?></h2>
        </div>
        <div class="info-mahasiswa">
            <span>NIM </span> <div class="val">: <?php echo $data_mhs['nim']; ?></div>
            <span>Nama Lengkap </span> <div class="val">: <?php echo $data_mhs['nama']; ?></div>
        </div>
    </div>
</div>
<br />
<div class="row-fluid">
    <div class="span6"><h3 class="heading">Mata Kuliah Yang Telah Diambil</h3></div>
    <div class="span6">
        <div class="pull-right">
            <?php if ($sudah_isi_krs  > 0) : ?>
                <a class="btn btn-info disabled">Isi KRS</a>
            <?php else : ?>
                <a href="{base_url}mhs_jadwal/isi_krs" class="btn btn-info">Isi KRS</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <table class="table table-bordered table-striped" id="smpl_tbl">
            <thead>
            <tr>
            <?php
            foreach($heading as $item){ ?>
                <th><center><?php echo $item; ?></center></th>
            <?php }?>
            </tr>
            </thead>
            <tbody>
            <?php if (count($konten)) : ?>
                <?php foreach($konten as $items){ ?>
                <?php foreach($items as $item){ ?>
                    <td><?php echo $item; ?></td>
                <?php } ?></tr>
                <?php }?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Tidak ada data</td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>

    </div>
</div>