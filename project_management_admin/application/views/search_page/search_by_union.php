<section class="container" style="padding-top: 2%">
    <div class="row">
        <div class="col-sm-9 col-lg-offset-3">

            <form action="<?php echo base_url(); ?>index.php/pages/search_by_union_pouroshova" method="POST">

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

                </br>
                <div class="col-sm-12s">
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
