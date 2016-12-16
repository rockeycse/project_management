<section class="container">
    <div class="col-sm-12">
        <h4 class="col-lg-offset-4" style="margin-top: 2%; margin-bottom: 2%">প্রকল্পের তালিকা </h4>

        <div class=" col-sm-11 ">
            <?php echo $links; ?>
            <div id="boxshadow">
                <table id="t01" style="width:100%" class="table-responsive">

                    <tr>
                        <th><strong>ক্রমিক নং</strong></th>
                        <th><strong>প্রকল্পের নাম</strong></th>
                        <th><strong>বরাদ্ধ (টাকা)</strong></th>
                        <th><strong>বরাদ্ধ (খাদ্য)</strong></th>
                        <th><strong>বাস্তবায়নকারী কর্তিপক্ষ</strong></th>
                        <th><strong>খাত </strong></th>
                        <th><strong>অগ্রগতির হার</strong></th>
                        <th><strong>অর্থ বছর</strong></th>
                        <th><strong>প্রকল্পের ছবি </strong></th>

                    </tr>
                    <?php
                    if (isset($search_result)) {
                        $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", ":", ",");
                        $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", ":", ",");

                        foreach ($search_result as $result) {
                            ++$page;
                            ?>
                            <tr>
                                <td><?php echo str_replace($search_array, $replace_array, $page); ?></td>
                                <td><?php echo $result->project_name; ?></td>
                                <td><?php echo $result->alloted_taka; ?></td>
                                <td><?php echo $result->alloted_food; ?></td>
                                <td><?php echo $result->executive_authority; ?></td>
                                <td><?php echo $result->sector; ?></td>
                                <td><?php echo $result->rate ?></td>
                                <td><?php echo $result->economical_year; ?></td>
                                <td>

                                    <a id="example2"
                                       href="http://localhost/project_management_admin/uploads/<?php echo $result->project_photo; ?>">

                                        <img
                                            src="http://localhost/project_management_admin/uploads/<?php echo $result->project_photo; ?>"
                                            width="100" height="100">
                                    </a>
                                </td>

                            </tr>

                            <?php

                        }
                    }

                    ?>


                </table>


            </div>
        </div>
    </div>

</section>
<script type="text/javascript">
    $(document).ready(function () {
        /*
         *   Examples - images
         */

        $("a#example2").fancybox({
            'overlayShow': false,
            'transitionIn': 'elastic',
            'transitionOut': 'elastic'
        });


        $("a[rel=example_group]").fancybox({
            'transitionIn': 'none',
            'transitionOut': 'none',
            'titlePosition': 'over',
            'titleFormat': function (title, currentArray, currentIndex, currentOpts) {
                return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
            }
        });

        /*
         *   Examples - various
         */

        $("#various3").fancybox({
            'width': '75%',
            'height': '75%',
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'iframe'
        });

        $("#various4").fancybox({
            'padding': 0,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none'
        });
    });
</script>