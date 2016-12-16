<html>
<head>
    
    <style>
        table#t01 {
            width: 100%;
            border: 5px solid white; text-align: center;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: center;
        }

        table#t01 tr:nth-child(even) {
            background-color: #eee;
        }

        table#t01 tr:nth-child(odd) {
            background-color: #fff;
        }

        table#t01 th {
            background-color: #3c8dcb;
            color: white;
        }
        #boxshadow {
            position: relative;
            -moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);
            -webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
            box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
            padding: 10px;
            background: white;
        }

        /* Make the image fit the box */
        #boxshadow table {
            width: 100%;
            border: 1px solid #8a4419;
            border-style: inset;
        }

        #boxshadow::after {
            content: '';
            position: absolute;
            z-index: -1; /* hide shadow behind image */
            -webkit-box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3);
            box-shadow: 0 15px 20px rgba(0, 0, 0, 0.3);
            width: 70%;
            left: 15%; /* one half of the remaining 30% */
            height: 100px;
            bottom: 0;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
        
        <div class="content-wrapper">
            <section class="container">
                <div class="col-sm-12">
                    <h4 class="col-lg-offset-4" style="margin-top: 2%; margin-bottom: 2%">খাতের তালিকা </h4>
                    <div class="col-lg-offset-1 col-sm-8 ">
                        <div id="boxshadow">
                            <table id="t01" style="width:100%">
                                <tr>
                                    <th>ক্রমিক নং</th>
                                    <th>খাত</th>
                                    <th>এডিট</th>
                                    <th>ডিলিট</th>


                                </tr>
                                <?php
                                $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", ":", ",");
                                $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", ":", ",");

                                $result = $this->project_model->get_all_sector();
                                $i = 1;
                                foreach ($result as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo str_replace($search_array,$replace_array, $i); ?></td>
                                        <td><?php echo $row->sector ?></td>
                                        <td>
                                            <a href='<?php echo base_url() ?>index.php/pages/edit_sector/<?php echo $row->sector; ?>'>
                                                &nbsp;&nbsp;Edit&nbsp;&nbsp;</a></td>
                                        <td>
                                            <?php
                                            echo anchor('pages/delete_sector/' . $row->sector, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>

                            </table>
                        </div>
                    </div>

                </div>

            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        
    </div>
</body>

</html>

