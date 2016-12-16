<?php echo $links?>

<table width="1000" align="center" >

    <tr>
        <th width="150" style="border-right: 1%; border-right-color: white"><strong>ক্রমিক নং</strong></th>
        <th style="border-right: 1%; border-right-color: white"><strong>প্রকল্পের নাম</strong></th>
        <th style="border-right: 1%; border-right-color: white"><strong>বরাদ্ধ (টাকা)</strong></th>
        <th style="border-right: 1%; border-right-color: white"><strong>বরাদ্ধ (খাদ্য)</strong></th>
        <th style="border-right: 1%; border-right-color: white"><strong>বাস্তবায়নকারী কর্তিপক্ষ</strong></th>
        <th style="border-right: 1%; border-right-color: white"><strong>খাত </strong></th>
        <th style="border-right: 1%; border-right-color: white"><strong>অগ্রগতির হার</strong></th>
        <th style="border-right: 1%; border-right-color: white"><strong>অর্থ বছর</strong></th>
        <th style="border-right: 1%; border-right-color: white">&nbsp;&nbsp;সম্পাদন করুন&nbsp;&nbsp;</th>
        <th > মুছুন  </th>
    </tr>
    <?php
    if(isset($search_result)) {
        $i=1;
        foreach ($search_result as $result) {

            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result->project_name; ?></td>
                <td><?php echo $result->alloted_taka; ?></td>
                <td><?php echo $result->alloted_food; ?></td>
                <td><?php echo $result->executive_authority; ?></td>
                <td><?php echo $result->sector; ?></td>
                <td><?php echo $result->rate ?></td>
                <td><?php echo $result->economical_year; ?></td>
                <td><a href='edit_project/<?php echo $result->id; ?>'>&nbsp;&nbsp;সম্পাদন করুন&nbsp;&nbsp;</a></td>
                <td>
                    <?php
                    echo anchor('pages/delete_project/' . $result->id, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                    ?>
                </td>

            </tr>
            <?php
            $i++;
        }
    }
    ?>

