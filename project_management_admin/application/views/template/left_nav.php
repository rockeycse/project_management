<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
               <img src="<?php echo base_url();?>uploads/<?php echo $this->session->userdata('id');?>.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('name');?></p>
            </div>
        </div>

        <ul class="sidebar-menu">

            <li><a href="<?php echo base_url(); ?>index.php/profile/profile"></i> প্রোফাইল </a></li>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>প্রশাসনিক এলাকা</span>
                    <span class="label label-primary pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <li style="margin-left: 2%"><a
                            href="<?php echo base_url(); ?>index.php/pages/union_pouroshova_list"></i>ইউনিয়ন/পৌরসভার
                            তালিকা</a></li>
                    <li style="margin-left: 2%"><a href="<?php echo base_url(); ?>index.php/pages/word_list"></i>
                            ওয়ার্ডেরতালিকা</a></li>
                    <li style="margin-left: 2%"><a
                            href="<?php echo base_url(); ?>index.php/pages/add_administrative_area"></i> নতুন তালিকা যোগ
                            করুন </a></li>
                </ul>
            </li>

            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>বাস্তবায়নকারী কতৃপক্ষ</span>
                    <span class="label label-primary pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <li style="margin-left: 2%"><a href="<?php echo base_url(); ?>index.php/pages/implementar_list"></i>
                            বাস্তবায়নকারীর
                            তালিকা</a></li>
                    <li style="margin-left: 2%"><a
                            href="<?php echo base_url(); ?>index.php/pages/add_implementary_panel"></i> নতুন
                            বাস্তবায়নকারী যোগ করুন </a></li>
                </ul>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>খাত</span>
                    <span class="label label-primary pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <li style="margin-left: 2%"><a href="<?php echo base_url(); ?>index.php/pages/sector_list"></i>খাতের
                            তালিকা</a></li>
                    <li style="margin-left: 2%"><a href="<?php echo base_url(); ?>index.php/pages/add_sector"></i> নতুন
                            খাত যোগ করুন </a></li>
                </ul>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>নতুন প্রকল্প তৈরি করুন</span>
                    <span class="label label-primary pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <li style="margin-left: 2%"><a
                            href="<?php echo base_url(); ?>index.php/pages/create_new_project"></i> নতুন প্রকল্প তৈরি
                            করুন </a>
                </ul>
            </li>


            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>প্রকল্প খোঁজ করুন   </span>
                    <span class="label label-primary pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <li style="margin-left: 2%"><a href="<?php echo base_url(); ?>index.php/pages/search_project"></i>
                            প্রকল্প খোজ করুন </a>
                    </li>
                    <li style="margin-left: 2%"><a
                            href="<?php echo base_url(); ?>index.php/pages/search_by_union_pouroshova"></i>
                            ইউনিয়ন/পৌরসভা
                            <br>
                            ভিত্তিক খোঁজ করুন </a></li>
                    <li style="margin-left: 2%"><a
                            href="<?php echo base_url(); ?>index.php/pages/search_by_implementar"></i> বাস্তবায়নকারী
                            কর্তৃপক্ষ<br> ভিত্তিক খোঁজ করুন </a></li>
                    <li style="margin-left: 2%"><a
                            href="<?php echo base_url(); ?>index.php/pages/search_by_economical_year"></i> অর্থ বছর
                            ভিত্তিক খোঁজ করুন </a></li>
                    <li style="margin-left: 2%"><a href="<?php echo base_url(); ?>index.php/pages/search_by_sector"></i>
                            খাত ভিত্তিক খোঁজ
                            করুন </a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
