<div class="content-wrapper">
    <section class="content">
        <div class="register-box">
            <h3 class="login-box-msg">নতুন প্রকল্প টেবিল </h3>

            <div class="register-box-body">

                <div style="color: red">
                    <?php echo validation_errors(); ?>
                </div>

                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" autocomplete="on">
                    <div class="form-group has-feedback">
                        ইউনিয়ন পরিষদ/পৌরসভা:
                        <select name="union_pouroshova" class="form-control" style="width:100%;"
                                onchange="return get_class_subject(this.value)">
                            <option value="<?php echo $project['union_pouroshova'];?>" selected="selected" ><?php echo $project['union_pouroshova'];?></option>
                            <?php
                            $classes = $this->project_model->get_all_union_pouroshova();
                            foreach($classes as $row):
                                ?>
                                <option value="<?php echo $row->union_pouroshova;?>"  ><?php echo $row->union_pouroshova;?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <div class="form-group has-feedback">
                        ওয়ার্ড:

                        <select name="word" class="form-control" style="width:100%;" id="subject_selection_holder">
                            <option value="<?php echo $project['word'];?>" selected="selected" ><?php echo $project['word'];?></option>

                        </select>



                    </div>



                    <div class="form-group has-feedback">
                        প্রকল্পের নাম:
                        <input type="text" name="project_name" class="form-control" placeholder=" "
                               value="<?php echo $project['project_name']; ?>">
                        </input>

                    </div>

                    <div class="form-group has-feedback">
                        বরাদ্ধ (লক্ষ্য টাকা):
                        <input type="text" name="alloted_taka" class="form-control" placeholder=""
                               value="<?php echo $project['alloted_taka']; ?>">

                    </div>

                    <div class="form-group has-feedback">
                        বরাদ্ধ (মেঃ টন  খাদ্য শস্য):
                        <input type="text" name="alloted_food" class="form-control"
                               placeholder="" value="<?php echo $project['alloted_food']; ?>">

                    </div>

                    <div class="form-group has-feedback">
                        বাস্তবায়নকারী কর্তৃপক্ষ:
                        <input type="text" name="executive_authority" id="executive_authority_id"  class="form-control"
                               value="<?php echo $project['executive_authority']; ?>" autocomplete="on" >
                    </div>


                    <div class="form-group has-feedback">
                        খাত:
                        <input type="text" name="sector" id="sector_id" autocomplete="off" class="form-control"
                               value="<?php echo $project['sector']; ?>">
                    </div>

                    <div class="form-group has-feedback">
                        অগ্রগতির হার:
                        <input type="text" name="rate" class="form-control" placeholder=""
                               value="<?php echo $project['rate']; ?>">

                    </div>

                    <div class="form-group has-feedback">
                        অর্থ বছর:
                        <input type="text" name="economical_year" class="form-control" placeholder=""
                               value="<?php echo $project['economical_year']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="project_photo">ফটো ১ যোগ করুন </label>
                        <input type="file" name="project_photo"  />
                    </div>

                    <div class="form-group">
                        <label for="project_photo">ফটো ২ যোগ করুন </label>
                        <input type="file" name="project_photo2"  />
                    </div>

                    <div style="col-xs-1">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">দাখিল করুন</button>
                    </div><!-- /.col -->

                </form>
            </div>
        </div>

    </section>
</div>

<!--<script src="<?php /*echo base_url();*/?>assets/js/jquery-1.11.0.min.js"></script>-->
<script type="text/javascript">
    function get_class_subject(union_pouroshova) {
        $.ajax({
            url: '<?php echo base_url();?>index.php/pages/get_words_by_union/' + union_pouroshova ,
            success: function(response)
            {
                jQuery('#subject_selection_holder').html(response);
            }
        });
    }
</script>


<script type="text/javascript">
    console.log('Out of method executive_authority');
    $(this).ready( function() {
        $("#executive_authority_id").autocomplete({

            minLength: 1,
            source:
                function(req, add){
                    console.log('Inside function source()');
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/pages/executive_authority_autocomplete",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                            function(data){
                                console.log('Inside function success()');
                                if(data.response =="true"){
                                    add(data.message);
                                    console.log(data.message);
                                }
                            }
                    });
                }

        });


    });

    $(this).ready( function() {
        $("#sector_id").autocomplete({

            minLength: 1,
            source:
                function(req, add){
                    console.log('Inside function source()');
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/pages/sector_autocomplete",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                            function(data){
                                console.log('Inside function success()');
                                if(data.response =="true"){
                                    add(data.message);
                                    console.log(data.message);
                                }
                            },
                    });
                },

        });


    });

</script>
