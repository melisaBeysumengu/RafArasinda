<!DOCTYPE html>
<html lang="en">
<html>

<head>

    <?php
        require APPROOT . '/views/includes/head.php';
    ?>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
    <link href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <style type="text/css">

    html {

        background-image: url('../css/Background.png') no-repeat center center fixed;
        font-family: system-ui;
        -webkit-font-smoothing: antialiased;
        padding: 10px 0;
        background-size: cover;
        height: 100%;
    }

    .main-body {
        padding: 15px;
    }

    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3,
    .mb-0 {
        font-size: 18px;
        margin-bottom: 1rem !important;
    }

    .mt-3 {
        font-size: 40px;
        top: 5px;
        right: 16px;
    }

    .user-links {
        position: absolute;
        top: 8px;
        right: 16px;
        font-size: 18px;

    }


    .back-button a button {
        display: inline-block;
        font-size: 18px;
        cursor: pointer;
        text-align: center;
        color: black;
        border-radius: 4px;
        text-transform: uppercase;
        width: 100px;
        position: absolute;
        right: 30px;
        background-color: rgb(253, 101, 0);
        border-radius: 10px;
        top: 8px;
        padding: 10px 20px;
        border: 0;

    }

    .back-button a button:hover {
        background-color: rgb(255, 140, 64);
    }

    .sections ul {
        display: inline;

        margin-left: 10px;
        padding-top: 80%;


    }

    .sections ul li {

        list-style: none;
        display: inline-block;
        position: fixed;
        top: 55px;


    }

    .sections ul a {
        color: rgb(253, 101, 0);
        text-decoration: none;
        font-size: 20px;
        text-transform: uppercase;

        padding: 3px 60px;
    }

    .sections ul li::after {
        content: '';
        width: 0;
        height: 2px;
        background: rgb(253, 101, 0);
        display: block;
        margin: auto;
        transition: .5s;
    }

    .sections ul li:hover:after {

        width: 100%;
        height: 2px;
        background: rgb(255, 140, 64);
        display: block;
        margin: auto;
    }
    </style>
</head>

<body>
    <?php
        require APPROOT . '/views/includes/nav.php';
    ?>

    <div class="back-button">

        <a href="<?php echo base_url('Homepage/browsePage');?>">
            <button type="back"> BACK</button>
        </a>
    </div>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="<?php echo base_url('css/user-icon.png') ?>">
                                <div class="user-links">
                                    <?php echo anchor('Register/changepwd','Change Password')?><br />
                                    <?php echo anchor('Register/delete','Delete your account')?><br />
                                </div>
                                <div class="mt-3">
                                    <h4><?php echo $user->user_uid ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">First Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $user->user_first ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Last Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $user->user_last ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $user->user_email ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">UserName</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $user->user_uid ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $user->user_pwd?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>