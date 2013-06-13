<style type="text/css">
    .main-info {
        background-color: #DDFF75;
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
    }
</style>
<div class="span12">
    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>
    <a href="{base_url}mhs_jadwal/dashboard_krs" class="btn btn-info">Isi KRS</a>
    <a href="{base_url}mhs_jadwal/jadwal" class="btn btn-info">Lihat Jadwal</a>
</div>

<div  class="span12 main-info">
    <h3 class="heading">Selamat Datang di Pengisian KRS Mahasiswa</h3>

    <b>1. Mahasiswa Baru (Semester Pertama)</b>
    <br> &nbsp; &nbsp; - Telah melakukan registrasi
    <br> &nbsp; &nbsp; - Pengisian KRS dilakukan oleh mahasiswa masing-masing Jurusan/Prodi

    <br><br><b>2. Mahasiswa Lama</b>
    <br> &nbsp; &nbsp; - Memenuhi persyaratan untuk dapat mengisi KRS
    <br> &nbsp; &nbsp; - Memenuhi jadwal pengisian KRS yang telah ditetapkan
    <br> &nbsp; &nbsp; - Mengisikan secara langsung ke komputer mata kuliah yang diambil sesuai jatah SKS

    <br><br><b>3. Jumlah SKS/Mata Kuliah yang Dapat Diambil</b>
    <br> &nbsp; &nbsp; - Bagi Mahasiswa Lama (aktif), jumlah SKS yang dapat diambil sebesar 24 sks.

    <br><br><b>4. Perhatian</b>
    <br> &nbsp; &nbsp; - Bila karena sesuatu hal, mahasiswa tidak dapat hadir untuk mengisi KRS, ia dapat mewakilkan kepada orang lain.
</div>



