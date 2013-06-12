<div  class="span12">
    <h3 class="heading">{page_title}</h3>


</div>
<div>
    <form method="get" action="" class="form-horizontal">
    <table class="table table-striped">
        <tr>
            <td>{title2}</td>
            <td>{dropdown_jadwal}</td>
            <td><input class="btn btn-gebo" type="submit" value="DAFTAR MAHASISWA" id="get_list_mhs"></td>
        </tr>
    </table>
    </form>
    <?php if($show_tb){ ?>
    <form method="post" action="{action}" class="form-horizontal">
	<fieldset id="list_fieldset" style="">
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
<?php } ?>
</div>