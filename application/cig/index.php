<p>
    <a class="btn primary" href="<?= base_url(); ?>%%CONTROLLER%%/edit">Create new</a>
</p>

<?php if ($items): ?>
    <?php foreach ($items as $item): ?>
        <fieldset class="control-group">
            <?php foreach ($item as $prop => $value): ?>
                <?php if ($prop !== 'id'): ?>
                    <p><label><strong><?php echo ucfirst($prop) ?> </label></strong><?php echo $value ?></p>
                <?php endif ?>
            <?php endforeach ?>
        </fieldset>
        <fieldset class="form-actions" style="text-align:right;">
            <a href="<?php echo base_url() ?>%%CONTROLLER%%/edit/<?php echo $item->id ?>" class="btn primary"><i class="edit"></i>Edit</a>
            <a href="<?php echo base_url() ?>%%CONTROLLER%%/delete/<?php echo $item->id ?>" class="btn danger"><i class="trash"></i>Delete</a>
        </fieldset>
    <?php endforeach ?>
<?php endif ?>