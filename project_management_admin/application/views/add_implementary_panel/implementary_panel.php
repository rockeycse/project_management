<div class="content-wrapper">
    <section class="content">
        <div class="register-box">
            <h4 class="login-box-msg">বাস্তবায়নকারী কর্তৃপক্ষ টেবিল </h4>

            <div style="color: red">
                <?php echo validation_errors(); ?>
            </div>

            <form action="<?php echo base_url(); ?>index.php/pages/add_implementary_panel" method="post" >

                <div class="form-group has-feedback">
                    <input type="text" name="implementar" id="executive_authority_id" class="form-control" autocomplete="off" placeholder=" বাস্তবায়নকারি কর্তৃপক্ষ">
                </div>


                <div style="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">দাখিল করুন</button>
                </div><!-- /.col -->

            </form>
        </div>

    </section><!-- /.content -->
</div>

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
                            },
                    });
                },
        });
    });

</script>


