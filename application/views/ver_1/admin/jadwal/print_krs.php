<div class="span10">
	<form class="form-horizontal well">
		<fieldset>
		<center><h1><p class="f_legend">KARTU RENCANA STUDI</p></h1></center>
		<p></p>
	    <div class="vcard">
            <ul style="margin-left:0px;">
            <li>
            <span class="item-key">Nama Lengkap</span>
				<div class="vcard-item"><?php echo $mhs[0]->nama; ?></div>
                </li>
                <li>
			<span class="item-key">N I M</span>
                <div class="vcard-item"><?php echo $mhs[0]->nim; ?></div>
				</li>
                <li>
            <span class="item-key">Semester</span>
                <div class="vcard-item"><?php echo $mhs[0]->semester; ?></div>
                </li>
            </ul>
        </div>	
				
<br><br>
		
		<div class="span11">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="table_checkbox">No</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>                
                <th>Ruang</th>
                <th>Dosen</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1;foreach($krs as $data) : ?>
            <tr>
                <th class="table_checkbox"><?php echo $no; ?></th>
                <th><?php echo $data->nama; ?></th>
                <th><?php echo $data->sks; ?></th>
                <th><?php echo $data->ruang; ?></th>
                <th><?php echo $data->nama_dosen; ?></th>                
            </tr>            
            <?php $no++;endforeach; ?>
            </tbody>
        </table>
		</div>


<center>			
<button class="btn btn-inverse">PRINT</button>
</center>				

</fieldset>
</form>
</div>





        