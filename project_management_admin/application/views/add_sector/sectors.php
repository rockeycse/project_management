<div class="content-wrapper">
    <section class="content">
        <div class="register-box">
            <h3 class="login-box-msg">খাত টেবিল </h3>


            <div class="register-box-body">

                <div style="color: red">
                    <?php echo validation_errors(); ?>
                </div>

                <form action="<?php echo base_url(); ?>index.php/pages/add_sector" method="post">

                    <div class="form-group has-feedback">
                        <input type="text" name="sector" id="sector_id" autocomplete="off" class="form-control" placeholder="খাত">
                    </div>


                    <div style="col-sm-2">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">দাখিল করুন</button>
                    </div><!-- /.col -->

                </form>
            </div>

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    console.log('Out of method sector');
    $(this).ready(function () {
        $("#sector_id").autocomplete({

            minLength: 1,
            source: function (req, add) {
                console.log('Inside function source()');
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/pages/sector_autocomplete",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success: function (data) {
                        console.log('Inside function success()');
                        if (data.response == "true") {
                            add(data.message);
                            console.log(data.message);
                        }
                    },
                });
            },

        });
    });

</script>
