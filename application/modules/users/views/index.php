<section class="content-header">
    <h1><?php echo $menu; ?></h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <a data-href="<?php echo $slug . '/create' ?>" class="btn btn-primary btn-modal-form" title="<?php echo lang('create') ?>" data-title="<?php echo sprintf(lang('form_create'), $menu) ?>" data-icon="fa fa-edit fa-fw" data-background="modal-primary"><?php echo lang('button_create') ?></a>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover datatables">
                <thead>
                    <tr>
                        <th><?php echo lang('_no') ?></th>
                        <th><?php echo lang('first_name') ?></th>
                        <th><?php echo lang('last_name') ?></th>
                        <th><?php echo lang('email') ?></th>
                        <th><?php echo lang('phone') ?></th>
                        <th><?php echo lang('active') ?></th>
                        <th><?php echo lang('action') ?></th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="box-footer">

        </div>
    </div>
</section>