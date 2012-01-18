
<p><a href="<?php echo base_url() ?><?php echo $this->uri->segment(1) ?>" class="btn primary"><i class="arrow-left"></i>Go back</a></p>

<?php if (validation_errors()): ?>
    <div class="alert-message block-message error">
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>

<?php echo form_open('', array('id'=>'edit-form', 'class'=>'form-horizontal')) ?>    

    <legend>
        <?php if ($item): ?>
            Edit
        <?php else: ?>
            New
        <?php endif ?>
    </legend>    