<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php/pages/index"><i class="fa fa-dashboard"></i> প্রোফাইল</a></li>
            
        </ol>
    </section>
    <div class="container">

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->

            <div class="row">

                <div class="col-md-10">
                    <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/profile/profile" method="POST">


                        <div class="box-header with-border">
                            <h3 class="box-title"> সাধারন তথ্য</h3>
                        </div>

                        <div class="box-body box box-info">


                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label"> নাম </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <input class=" fa-th form-control" name="name" id="inputEmail3" placeholder="নাম"
                                               type="text" value="<?php echo $profile['name']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">পদবী </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <input class=" fa-th form-control" name="designation" id="designation" placeholder="পদবী "
                                               type="text"  value="<?php echo $profile['designation'];?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">মোবাইল নম্বর</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <input class=" fa-th form-control" name="mobile" id="mobile" placeholder="মোবাইল নম্বর "
                                               type="text" value="<?php echo $profile['mobile'];?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">ইমেইল আইডি  </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <input class=" fa-th form-control" name="email" id="email" placeholder="ইমেইল আইডি "
                                               type="text" value="<?php echo $profile['email'];?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label"> জাতীয় পরিচয় পত্রের নম্বর </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <input class=" fa-th form-control" id="inputEmail3" placeholder="জাতীয় পরিচয় পত্রের নম্বর"
                                               type="text" name="nid" value="<?php echo $profile['nid'];?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">পাসওয়ার্ড </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <input class=" fa-th form-control" id="designation" placeholder="পাসওয়ার্ড "
                                               type="text" name="password" value="<?php echo $profile['password'];?>" >
                                    </div>
                                </div>
                            </div>



                        </div>





                        <div class="box-footer">
                            <a href="<?php echo base_url(); ?>pages/index" class="btn btn-danger">বাতিল করুন </a>
                            <button type="submit" class="btn btn-info pull-right">সংরক্ষণ করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->

            <div class="row">

                <div class="col-md-10">
        <?php echo form_open(base_url() . 'index.php/profile/upload_picture' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

        <div class="panel panel-primary" >

            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo 'upload_picture';?>
                </div>
            </div>

            <div class="panel-body">


                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo 'photo';?></label>

                    <div class="col-sm-9">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <img src="<?php echo base_url();?>uploads/<?php echo $this->session->userdata('id');?>.png" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                      <span class="btn btn-white btn-file">
                                          <span class="fileinput-new">Select image</span>
                                          <span class="fileinput-exists">Change</span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info"><?php echo 'upload';?></button>
                    </div>
                </div>

            </div>

        </div>

        <?php echo form_close();?>
                </div>
            </div>
        </section>

    </div>
</div>