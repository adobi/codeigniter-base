
        <fieldset class="control-group">
            <label for="%%COLUMN_NAME%%">%%UC_COLUMN_NAME%%</label>
            <div class="controls">
                <input type="text" name = "%%COLUMN_NAME%%" id = "%%COLUMN_NAME%%" class = "input-xxlarge" value = "<?php echo $_POST && isset($_POST['%%COLUMN_NAME%%']) ? $_POST['%%COLUMN_NAME%%'] : ($item ? $item->%%COLUMN_NAME%% : '') ?>"/>
            </div>
        </fieldset>  