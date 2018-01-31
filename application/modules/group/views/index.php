<section class="content-header">
    <h1><?php echo $menu; ?></h1>
</section>

<section class="content">
    <div class="box box-primary">
        <?php if ($this->securitylib->check_access('create', $slug)){ ?>
        <div class="box-header with-border">
            <a data-href="<?php echo $slug . '/create' ?>" class="btn btn-primary btn-modal-form" title="<?php echo lang('create') ?>" data-title="<?php echo sprintf(lang('form_create'), $menu) ?>" data-icon="fa fa-edit fa-fw" data-background="modal-primary"><?php echo lang('button_create') ?></a>
        </div>
        <?php } ?>
        <div class="box-body">
            <table class="table table-bordered table-hover datatables">
                <thead>
                    <tr>
                        <th><?php echo lang('_no') ?></th>
                        <th><?php echo lang('name') ?></th>
                        <th><?php echo lang('description') ?></th>
                        <th><?php echo lang('action') ?></th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="box-footer">

        </div>
    </div>
</section>