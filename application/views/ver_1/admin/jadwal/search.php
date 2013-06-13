<div class="span6">
    <form class="well form-search" action="" method="post">
        <p class="f_legend">Cari Mahasiswa</p>
        <input type="text" class="input-xlarge" placeholder="mahasiswa" name="q">
        <button type="submit" class="btn">Submit</button>
    </form>
</div>

<div class="span6">
    <table data-rowlink="a" class="table table-striped">
        <thead>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($mahasiswa as $siswa) : ?>
        <tr>
            <td><?php echo $siswa->nim; ?></td>
            <td><?php echo $siswa->nama; ?></td>
            <td><?php echo $siswa->email; ?></td>
            <td>                
                <a href="<?php echo base_url(); ?>admin/admin_jadwal/lihat_krs/<?php echo $siswa->id; ?>" class="btn btn-success">Lihat KRS</a>
                <a href="<?php echo base_url(); ?>admin/admin_jadwal/print_krs/<?php echo $siswa->id; ?>" class="btn btn-info">Cetak KRS</a>
            </td>
        </tr>       
        <?php endforeach; ?> 
        </tbody>
    </table>
</div>