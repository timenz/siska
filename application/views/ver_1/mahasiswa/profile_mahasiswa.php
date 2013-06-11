<!--Page contetn-->
<div class="span8" xmlns="http://www.w3.org/1999/html">
    <section>
        <div class="row">
            <div class="span8">
                <div class="blog_item">
                    <h2>Profile Mahasiswa</h2>
                    <p>Berikut adalah profile Anda.</p>
                    </br>
                    <table class="table">
                        <tr><td>Nama</td><td><?php echo $data_mhs['nama']; ?></td></tr>
                        <tr><td>Terdaftar sejak</td><td><?php echo date('d M Y H:i:s', to_epochtime($data_mhs['tanggal_daftar_ulang'])); ?></td></tr>
                        <tr><td>NIM</td><td><?php echo $data_mhs['nim']; ?></td></tr>
                        <tr><td>Tempat Lahir</td><td><?php echo $data_mhs['tempat_lahir']; ?></td></tr>
                        <tr><td>Tanggal Lahir</td><td><?php echo date('d M Y', to_epochtime($data_mhs['tgl_lahir'])); ?></td></tr>
                        <tr><td>Jenis Kelamin</td><td><?php  $data_mhs['jenis_kelamin'] == 'L' ? print('Laki Laki') : print('Perempuan'); ?></td></tr>
                        <tr><td>Kode Pos</td><td><?php echo $data_mhs['kodepos']; ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!--/Page contetn-->