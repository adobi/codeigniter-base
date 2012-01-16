<?= form_open(); ?>

    <fieldset class="round">
        
        <p>
            <label class = "block" for="%%COLUMN_NAME%%">%%UC_COLUMNS_NAME%%</label>
            <input type="text" name = "%%COLUMN_NAME%%" id = "%%COLUMN_NAME%%" value="<?= $current_item ? $current_item->%%COLUMN_NAME%% : '' ?>" />
        </p>

        <p>
            <label class = "block" for="%%COLUMN_NAME%%">%%UC_COLUMNS_NAME%%</label>
            <input type="text" name = "%%COLUMN_NAME%%" id = "%%COLUMN_NAME%%" value="<?= $current_item ? $current_item->%%COLUMN_NAME%% : '' ?>" class = "datepicker" />
        </p>
        <p>
            <label class = "block" for="%%COLUMN_NAME%%">%%UC_COLUMNS_NAME%%</label>
            <textarea  name = "%%COLUMN_NAME%%" id = "%%COLUMN_NAME%%" cols="60" rows="3"><?= $current_item ? $current_item->%%COLUMN_NAME%% : '' ?></textarea>
        </p>
        
        <p>
            <button>Mentés</button>
        </p>
    </fieldset>

<?= form_close(); ?>