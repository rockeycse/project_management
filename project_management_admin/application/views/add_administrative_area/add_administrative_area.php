 <script type="text/javascript">
    console.log('Out of method get_union_pouroshova()');
    $(this).ready( function() {
        $("#union_fields_id").autocomplete({

            minLength: 1,
            source:
                function(req, add){
                    console.log('Inside function source()');
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/pages/union_autocomplete",
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

    $(this).ready( function() {
        $("#word_fields_id").autocomplete({

            minLength: 1,
            source:
                function(req, add){
                    console.log('Inside function source()');
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/pages/word_autocomplete",
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

<div class="content-wrapper">
    <section class="content">
        <div class="register-box">
            <h4 class="login-box-msg">প্রশাসনিক এলাকা টেবিল </h4>

            <div class="register-box-body">

                <div style="color: red">
                    <?php echo validation_errors(); ?>
                </div>

                <form action="<?php echo base_url(); ?>index.php/pages/add_administrative_area" method="post">

                    <div class="form-group has-feedback">
                        <input type="text" name="union_pouroshova" id='union_fields_id'  class="form-control" placeholder="ইউনিয়ন/ পৌরসভা ">
                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" name="word" id='word_fields_id' class="form-control" placeholder="ওয়ার্ড ">
                    </div>

                    <div style="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">দাখিল করুন </button>
                    </div><!-- /.col -->

                </form>
            </div>

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->





