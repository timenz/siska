<div  class="span12">
    <h3 class="heading">{page_title}</h3>
    <div style="margin-bottom: 10px;">
        <?php if(count($link_add) > 1){ ?>
        <a class="btn btn-success" href="<?php echo $link_add['link']; ?>"><?php echo $link_add['name']; ?></a>
        <?php } ?>
    </div>
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

</div>