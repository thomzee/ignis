<form action="<?php echo $slug . '/update/' . $data->id ?>" method="post">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group <?php form_error('name') ? print 'has-error' : '' ?>">
                    <label class="control-label"><?php echo lang('name') ?></label>
                    <input type="text" class="form-control" name="name"
                           value="<?php echo set_value('name') ? set_value('name') : $data->name; ?>"
                           placeholder="<?php echo lang('name') ?>">
                    <span class="help-block">
                        <?php echo form_error('name'); ?>
                    </span>
                </div>
                <div class="form-group <?php form_error('description') ? print 'has-error' : '' ?>">
                    <label class="control-label"><?php echo lang('description') ?></label>
                    <textarea rows="5" class="form-control" name="description" placeholder="<?php echo lang('description') ?>"><?php echo set_value('description') ? set_value('description') : $data->description; ?></textarea>
                    <span class="help-block">
                        <?php echo form_error('description'); ?>
                    </span>
                </div>
            </div>
        </div>
        <fieldset>
            <legend><?php echo sprintf(lang('list_of'), lang('privileges')) ?></legend>
            <div class="treemenu">
                <?php echo $rolelib; ?>
            </div>
        </fieldset>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary"><?php echo lang('button_save') ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
    </div>
</form>