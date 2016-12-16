
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>index.php/pages/index" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>প্রকল্প</b> ব্যবস্থাপনা</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>প্রকল্প</b> ব্যবস্থাপনা</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url();?>uploads/<?php echo $this->session->userdata('id');?>.png" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $this->session->userdata('name');?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url();?>uploads/<?php echo $this->session->userdata('id');?>.png" class="img-circle"
                                 alt="User Image">
                            <p>
                                <?php echo $this->session->userdata('name');?> - <?php echo $this->session->userdata('designation');?>
                                <small>Member since Feb. 2016</small>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a  href="<?php echo base_url();?>index.php/profile/profile" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url();?>index.php/login/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
