<section class="container" style="padding-top: 2%">
    <div class="row">
        <div class="col-sm-9 col-lg-offset-3">

            <form action="<?php echo base_url(); ?>index.php/pages/search_by_economical_year" method="POST">

                <div style="color: #ff0000">
                    <?php echo validation_errors(); ?>
                </div>

                <div class="col-sm-3">
                    <div class="form-group has-feedback">
                        অর্থ বছর:<select name="economical_year" id="word_id" class="form-control">
                            <option value=""></option>
                            <?php
                            $result = $this->project_model->get_all_budget_year();
                            foreach ($result as $row) {

                                echo "<option value=$row->economical_year>$row->economical_year </option>";
                            }
                            ?>

                        </select>

                    </div>

                </div>

                </br>

                <div class="col-sm-12s" >
                    <div class="button-control">
                        <div class="col-sm-3 ">
                            <button class="btn btn-primary btn-block btn-flat">খোঁজ করুন</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
