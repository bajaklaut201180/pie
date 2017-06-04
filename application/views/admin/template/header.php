<!doctype HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="<?php echo base_url(), 'assets/images/icon/mox-icon.png'; ?>" type="image/gif" />
    <title><?php echo $title; ?></title>
    <script type="text/javascript" src="<?php echo base_url() ,'assets/js/jquery.min.js'; ?>"></script> 
    <script type="text/javascript" src="<?php echo base_url() ,'assets/js/bootstrap.min.js'; ?>"></script> 
    <script type="text/javascript" src="<?php echo base_url() ,'assets/js/sb-admin-2.min.js'; ?>"></script> 
    <script type="text/javascript" src="<?php echo base_url() ,'assets/js/metisMenu.min.js'; ?>"></script>
    <?php foreach($js as $script) echo '<script type="text/javascript" src="' ,base_url() ,'assets/js/' ,$script ,'.js"></script>' ; ?>
    
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ,'assets/css/bootstrap.min.css' ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ,'assets/css/sb-admin-2.css' ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ,'assets/css/font-awesome.min.css' ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ,'assets/css/metisMenu.min.css' ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ,'assets/css/admin/layout.css' ?>" />
    <?php foreach($css as $style) echo '<link rel="stylesheet" type="text/css" media="screen" href="' ,base_url() ,'assets/css/' ,$style ,'.css" />'; ?>
</head>
<body>
<div id="wrapper">