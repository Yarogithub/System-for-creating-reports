<!doctype html>
<html>
<head>
	<title><?=(isset($this->title)) ? $this->title : 'Report'; ?></title>
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
	<script type="text/javascript" src="<?php //echo URL; ?>public/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/custom.js"></script>


</head>
<body>

<?php Session::init(); ?>

<div id="header">
    <h3 id="title">Reports</h3>
    <br />
    <?php if (Session::get('loggedIn') == false):?>
    <a href="<?php echo URL; ?>index">Index</a>
    <?php endif; ?>
    <?php if (Session::get('loggedIn') == true):?>
        <a href="<?php echo URL; ?>Report">Reports</a>
        <?php if (Session::get('role') == 'admin'):?>
            <a href="<?php echo URL; ?>User">Users</a>
        <?php endif; ?>
        <a href="<?php echo URL; ?>Report/logout">Logout</a>
    <?php else: ?>
        <a href="<?php echo URL; ?>login">Login</a>
    <?php endif; ?>
</div>
	
<div id="content">
	
	