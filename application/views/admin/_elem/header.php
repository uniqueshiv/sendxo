<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $settings['site_name']; ?> - Admin panel">
        <meta name="author" content="Proxibolt">
        <meta name="keyword" content="">

        <title><?php echo $settings['site_name']; ?> - Admin Panel</title>

        <base href="<?php echo $settings['site_url'] ?>admin/">

        <link rel="shortcut icon" type="image/png" href="../<?php echo $settings['favicon_path']; ?>"/>

        <!-- Bootstrap core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- External css -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../assets/plugins/lineicons/style.css">

        <!-- Custom styles for this template -->
        <link href="../assets/css/admin/admin.css" rel="stylesheet">
        <link href="../assets/css/admin/admin-responsive.css" rel="stylesheet">

        <script src="../assets/plugins/chart-master/Chart.js"></script>
        <script src="../assets/js/admin/sortable.js"></script>

        <!-- Load jquery -->
        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>

        <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <section id="container">