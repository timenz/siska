<div  class="span12">
    <h3 class="heading">{page_title}</h3>

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
    <h3 class="heading">{ipk=}{ipk}</h3>
</div>