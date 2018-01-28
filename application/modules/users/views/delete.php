<form action="<?php echo $slug . '/destroy/' . $data->id ?>" method="post">
    <div class="box-body">
        <?php $this->load->view('view') ?>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-danger"><?php echo lang('button_delete') ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close'); ?></button>
    </div>
</form>