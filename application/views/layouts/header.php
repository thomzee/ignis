<!-- Logo -->
<a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><?php echo lang('mini') ?></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><?php echo lang('app') ?></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo base_url(); ?>/public/themes/AdminLTE-2.4.2/dist/img/user2-160x160.jpg"
                         class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $this->ion_auth->user()->row()->first_name . ' ' .$this->ion_auth->user()->row()->last_name ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="<?php echo base_url(); ?>/public/themes/AdminLTE-2.4.2/dist/img/user2-160x160.jpg"
                             class="img-circle" alt="User Image">

                        <p>
                            <?php echo $this->ion_auth->user()->row()->first_name . ' ' .$this->ion_auth->user()->row()->last_name ?>
                            <small>Member since <?php echo date('d F Y', strtotime($this->ion_auth->user()->row()->created_at)) ?></small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <?php echo anchor('auth/logout', 'Sign out', array('class' => 'btn btn-default btn-flat')); ?>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>