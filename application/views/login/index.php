
<?php if (validation_errors()): ?>
    <div class="alert alert-error">
        <?php echo validation_errors() ?>
    </div>
<?php endif ?>

<?php echo form_open('', array('class'=>'form-horizontal')) ?>
        
	    <legend>Please login</legend>
    
        <fieldset class="control-group">
            <label class="control-label" for="name">Name</label>
            <div class="controls">
			    <input type="text" name="username" id="username" class="username input-xlarge" />
            </div>
        </fieldset>
        <fieldset class="control-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
			    <input type="password" name="password" id="password" class="password input-xlarge" />
            </div>
        </fieldset>
        <fieldset class="form-actions">
            <input type="submit" value="Login" class="btn primary">
        </fieldset> 

<?php echo form_close() ?>