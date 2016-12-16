<section class="container" style="padding-top: 2%">
    <div class="row">
        <div class="col-sm-10">
            <form action="<?php echo base_url(); ?>index.php/pages/search_project" method="POST">

                <div style="color: #ff0000">
                    <?php echo validation_errors(); ?>
                </div>


                <div class="col-sm-3">
                    <div class="form-group has-feedback">
                        ইউনিয়ন পরিষদ/পৌরসভা:
                        <select name="union_pouroshova" id="union_pouroshova_id"
                                class="form-control">
                            <option value=""></option>
                            <?php
                            $result = $this->project_model->get_all_union_pouroshova();
                            foreach ($result as $row) {
                                //echo "<option value='" . $row->union_pouroshova . "'  selected=\"selected \">" . $row->union_pouroshova . "</option>";
                                echo "<option value='" . $row->union_pouroshova . "'>" . $row->union_pouroshova . "</option>";
                            }

                            ?>
                        </select>
                    </div>
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
                <div class="col-sm-3">
                    <div class="form-group has-feedback">
                        বাস্তবায়নকারী কর্তৃপক্ষ:<select name="implementar" id="implementar_id" class="form-control">
                            <option value=""></option>
                            <?php
                            $result = $this->project_model->get_all_implementar();
                            foreach ($result as $row) {

                                echo "<option value='" . $row->implementar . "'>" . $row->implementar . "</option>";

                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group has-feedback">
                        খাত:<select name="sector" id="sector_id" class="form-control">
                            <option value=""></option>
                            <?php
                            $result = $this->project_model->get_all_sector();
                            foreach ($result as $row) {
                                echo "<option value='" . $row->sector . "'>" . $row->sector . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12s">
                    <div class="button-control">
                        <div class=" col-lg-offset-5 col-md-4">
                            <button class="btn btn-primary btn-block btn-flat">খোঁজ করুন</button>
                        </div>
                    </div>
                </div>
                </br>
            </form>
        </div>
    </div>

</section>
