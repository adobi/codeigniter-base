
<?php if (validation_errors()): ?>
    <div class="alert alert-error">
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>

    <?php echo form_open(base_url().'cig/index/' . ($_POST && ($controller || $model || $view) ? 'generate' : ''), array('id'=>'edit-form', 'class'=>'form-horizontal')) ?>    
        <legend>CRUD Generator</legend>
     
        <fieldset class="control-group">
            <label class="control-label" for="username">Table name</label>
            <div class="controls">
                prefix <input type="text" name="prefix" class="span1" value="<?php echo $_POST ? $_POST['prefix'] : '' ?>"/>
                name <input type="text" name = "table_name" id = "table_name" class = "xxlarge" value = "<?php echo $_POST ? $_POST['table_name'] : '' ?>"/>
            </div>
        </fieldset>
        <fieldset class="control-group">
            <label class="control-label" for="username">&nbsp;</label>
            <div class="controls">
                <label class="checkbox inline">
                    <input type="checkbox" name="model" value="1" checked="checked"> model
                </label>
                <label class="checkbox inline">
                    <input type="checkbox" name="view" value="1" checked="checked"> view
                </label>
                <label class="checkbox inline">
                    <input type="checkbox" name="controller" value="1" checked="checked"> controller
                </label>
            </div>
        </fieldset>                  
        <fieldset class="form-actions">
            <button class="btn primary"><i class="search"></i>View code</button> 
            <?php if (!$_POST || validation_errors()): ?>
            <?php else: ?>
                &nbsp;<button class="btn primary"><i class="time"></i>Generate code</button> 
            <?php endif ?>
            &nbsp; <a class="btn" href="<?php echo base_url() ?>/<?php echo $this->uri->segment(1) ?>">Cancel</a>
            
        </fieldset> 
    <?php echo form_close(); ?>

<?php if ($controller): ?>
    <legend>Controller</legend>
    
<pre class="prettyprint linenums"><?php echo htmlspecialchars($controller) ?></pre>
<?php endif ?>

<?php if ($model): ?>
    <legend>Model</legend>
    
<pre class="prettyprint linenums"><?php echo htmlspecialchars($model) ?></pre>
<?php endif ?>

<?php if ($view): ?>
    <legend>Views</legend>
    <?php foreach ($view as $key=>$item): ?>
        <h5><?php echo $key ?></h5>
<pre class="prettyprint linenums"><?php echo htmlspecialchars($item) ?></pre>
    <?php endforeach ?>
    
<?php endif ?>
