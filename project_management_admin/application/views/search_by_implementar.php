<!DOCTYPE html>
<html>
<head>
    <?php include 'template/head.php'; ?>
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
    <?php include 'template/header.php'; ?>
    <?php include 'template/left_nav.php'; ?>
    <div class="content-wrapper">
        <?php include 'search_page/search_by_executor.php'; ?>
        <br>
        <?php include 'search_page/search_result_page.php'; ?>
    </div><!-- /.register-box -->
    <?php include 'template/footer.php'; ?>
</div>
</body>
</html>
