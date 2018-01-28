<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label"><?php echo lang('first_name') ?></label>
            <span class="control-label"> : <?php echo $data->first_name ?></span>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo lang('last_name') ?></label>
            <span class="control-label"> : <?php echo $data->last_name ?></span>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo lang('email') ?></label>
            <span class="control-label"> : <?php echo $data->email ?></span>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo lang('phone') ?></label>
            <span class="control-label"> : <?php echo $data->phone ?></span>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo lang('active') ?></label>
            <span class="control-label"> : <?php echo print_yes_no($data->active) ?></span>
        </div>
    </div>
</div>