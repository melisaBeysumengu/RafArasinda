<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        require APPROOT . '/views/includes/head.php';
    ?>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/author.css">
    <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <style>

    html {

        background-image: url('../css/Background.png') no-repeat center center fixed;
        font-family: system-ui;
        -webkit-font-smoothing: antialiased;
        padding: 10px 0;

        background-size: cover;
        height: 100%;

    }
    </style>

</head>

<body>
    <?php
        require APPROOT . '/views/includes/nav.php';
    ?>


    <?php
        $control = false;
        foreach ($author as $a) {
            if (!$control) {
    ?>
    <div class="container">
        <header class="jumbotron">
            <h1><?php echo $a->first_name . " " . $a->second_name; ?></h1>
        </header>
        <main>
            <div class="row">
                <div class="thumbnail  pull-left">
                    <img src="<?php echo $a->author_img; ?>" class="img-responsive img-rounded">
                </div>
                <div id=main-text>
                    <h2>Who is <?php echo $a->first_name . " " . $a->second_name; ?>?</h2>
                    <p><?php echo $a->Biography; ?></p>
                </div>
            </div>
            <div class="flex-container">
                <?php foreach ($author as $a) { ?>
                <div>
                    <a href="<?php echo base_url('Homepage/bookdata/' . $a->book_id); ?>">
                        <img src="<?php echo $a->img; ?>" width="175px" height="250px">
                    </a>
                </div>
                <?php } ?>
            </div>
        </main>
    </div>
    <?php }
        $control = true;
    } ?>

</body>

</html>




