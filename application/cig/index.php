<p>
    <a class="btn btn-primary" href="<?= base_url(); ?>%%CONTROLLER%%/edit"><i class="icon-plus"></i>Create new</a>
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
            <a href="<?php echo base_url() ?>%%CONTROLLER%%/edit/<?php echo $item->id ?>" class="btn btn-primary"><i class="icon-edit"></i>Edit</a>
            <a href="<?php echo base_url() ?>%%CONTROLLER%%/delete/<?php echo $item->id ?>" class="btn btn-danger"><i class="icon-trash"></i>Delete</a>
        </fieldset>
    <?php endforeach ?>
<?php endif ?>