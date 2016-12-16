<div class="content-wrapper">
    <section class="content">
        <div class="register-box">
            <h3 class="login-box-msg">খাত সম্পাদন</h3>

            <div class="register-box-body">

                <div style="color: red">
                    <?php echo validation_errors(); ?>
                </div>

                <form action="<?php echo $action; ?>" method="post" autocomplete="on">
                    <div class="form-group has-feedback">

                        <input type="text" name="sector" class="form-control" value="<?php echo $sector; ?>">
                    </div>

                    <div style="col-xs-1">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">দাখিল করুন</button>
                    </div><!-- /.col -->
                </form>
            </div>
        </div>

    </section>
</div>

