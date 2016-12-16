<section class="container" style="padding-top: 2%">

    <div class="row">
        <div class="col-sm-9 col-lg-offset-3">

            <form action="<?php echo base_url(); ?>index.php/pages/search_by_implementar" method="POST">

                <div style="color: #ff0000">
                    <?php echo validation_errors(); ?>
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

                </br>

                <div class="col-sm-12s">
                    <div class="button-control">
                        <div class="col-sm-3">
                            <button class="btn btn-primary btn-block btn-flat">খোঁজ করুন</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
