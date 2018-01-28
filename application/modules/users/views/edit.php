<form action="<?php echo $slug . '/update/' . $data->id ?>" method="post">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group <?php form_error('first_name') ? print 'has-error' : '' ?>">
                    <label class="control-label"><?php echo lang('first_name') ?></label>
                    <input type="text" class="form-control" name="first_name"
                           value="<?php echo set_value('first_name') ? set_value('first_name') : $data->first_name; ?>"
                           placeholder="<?php echo lang('first_name') ?>">
                    <span class="help-block">
                        <?php echo form_error('first_name'); ?>
                    </span>
                </div>
                <div class="form-group <?php form_error('email') ? print 'has-error' : '' ?>">
                    <label class="control-label"><?php echo lang('email') ?></label>
                    <input type="text" class="form-control" name="email" value="<?php echo set_value('email') ? set_value('first_name') : $data->email; ?>"
                           placeholder="<?php echo lang('email') ?>">
                    <span class="help-block">
                        <?php echo form_error('email'); ?>
                    </span>
                </div>
                <div class="form-group <?php form_error('password') ? print 'has-error' : '' ?>">
                    <label class="control-label"><?php echo lang('password') ?></label>
                    <input type="password" class="form-control" name="password" value=""
                           placeholder="<?php echo lang('password') ?>">
                    <span class="help-block">
                        <?php echo form_error('password'); ?>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group <?php form_error('last_name') ? print 'has-error' : '' ?>">
                    <label class="control-label"><?php echo lang('last_name') ?></label>
                    <input type="text" class="form-control" name="last_name"
                           value="<?php echo set_value('last_name') ? set_value('first_name') : $data->last_name; ?>" placeholder="<?php echo lang('last_name') ?>">
                    <span class="help-block">
                        <?php echo form_error('last_name'); ?>
                    </span>
                </div>
                <div class="form-group <?php form_error('phone') ? print 'has-error' : '' ?>">
                    <label class="control-label"><?php echo lang('phone') ?></label>
                    <input type="text" class="form-control" name="phone" value="<?php echo set_value('phone') ? set_value('first_name') : $data->phone; ?>"
                           placeholder="<?php echo lang('phone') ?>">
                    <span class="help-block">
                        <?php echo form_error('phone'); ?>
                    </span>
                </div>
                <div class="form-group <?php form_error('confirm_password') ? print 'has-error' : '' ?>">
                    <label class="control-label"><?php echo lang('confirm_password') ?></label>
                    <input type="password" class="form-control" name="confirm_password" value=""
                           placeholder="<?php echo lang('confirm_password') ?>">
                    <span class="help-block">
                        <?php echo form_error('confirm_password'); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary"><?php echo lang('button_save') ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
    </div>
</form>