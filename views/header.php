<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

	<title><?=(isset($this->title)) ? $this->title : 'Report'; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">

<!--	<script type="text/javascript" src="--><?php //echo URL; ?><!--public/js/jquery.js"></script>-->
<!--	<script type="text/javascript" src="--><?php //echo URL; ?><!--public/js/custom.js"></script>-->


</head>
<body>
<?php Session::init(); ?>

    <header>

        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">

            <a class="navbar-brand" href="<?php echo URL; ?>index" >Reports</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Nav Switch">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainmenu">

                <ul class="navbar-nav mr-auto">

                    <?php if (Session::get('loggedIn') == false):?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL; ?>index">Index</a>
                        </li>

                    <?php endif; ?>
                    <?php if (Session::get('loggedIn') == true):?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL; ?>index">Index</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL; ?>Report">Reports</a>
                        </li>

                        <?php if (Session::get('role') == 'admin'):?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL; ?>User">Users</a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL; ?>Report/logout">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL; ?>login">Login</a>
                        </li>
                    <?php endif; ?>

                </ul>



            </div>



        </nav>


    </header>

    <main>
        <section class="reports">

            <div class="container">



