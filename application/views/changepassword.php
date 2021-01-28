<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <link href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style type="text/css">
    .pass_show {
        position: relative
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
        height: 50px;
        position: absolute;
        right: 300px;
        background-color: rgb(253, 101, 0);
        border-radius: 10px;
        top: 262px;
        padding: 10px 20px;
        border: 0;

    }

    .back-button a button:hover {
        background-color: rgb(255, 140, 64);
    }

    .col-sm-4 button {
        display: inline-block;
        font-size: 18px;
        cursor: pointer;
        text-align: center;
        color: black;
        border-radius: 4px;
        text-transform: uppercase;
        width: 100px;
        height: 50px;
        right: 100px;
        background-color: rgb(253, 101, 0);
        border-radius: 10px;
        top: 8px;
        padding: 10px 20px;
        border: 0;

    }

    .col-sm-4 button:hover {
        background-color: rgb(255, 140, 64);
    }


    .pass_show .ptxt {

        position: absolute;
        top: 50%;
        right: 10px;
        z-index: 1;
        color: #f36c01;
        margin-top: -10px;
        cursor: pointer;
        transition: .3s ease all;
    }

    .pass_show .ptxt:hover {
        color: #333333;
    }



    .container {

        position: relative;


    }

    .row .col-sm-4 {

        position: absolute;
        top: 80%;
        left: 50%;


    }

    .logo {
        position: relative;
        top: 50%;
        left: 30%
    }
    </style>
</head>

<body>
    <div class="logo">
        </br>
        <img src="<?php echo base_url('css/logo.png') ?>" width="%50" height="134px" alt="logo">
    </div>



    <div class="container" method="POST">
        <div class="row" method="POST">
            <form action="<?php echo base_url('Register/changePassword');?>" method="POST" role="form"
                class="form-horizontal">
                <div class="col-sm-4">

                    <label>Current Password</label>
                    <div class="form-group pass_show" method="POST">
                        <input type="password" name="curr_pwd" method="POST" class="form-control"
                            placeholder="Current Password"></input>
                    </div>
                    <label>New Password</label>
                    <div class="form-group pass_show">
                        <input type="password" name="new_pwd" method="POST" class="form-control"
                            placeholder="New Password"></input>
                    </div>
                    <label>Confirm Password</label>
                    <div class="form-group pass_show">
                        <input type="password" name="conf_pwd" method="POST" class="form-control"
                            placeholder="Confirm Password"></input>
                    </div>
                    <button type="submit" onclick="location.href='<?php echo base_url('Register/changePassword');?>'"
                        class="btn btn-primary mb-4">SUBMIT</button>
                        <br>
                        <b><?php echo @$passwordError;?></b>

                </div>
            </form>

            <div class="back-button">
                <a href="<?php echo base_url('Register/myprofile');?>">
                    <button type="back">BACK</button>
                </a>

            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('.pass_show').append('<span class="ptxt">Show</span>');
    });
    $(document).on('click', '.pass_show .ptxt', function() {
        $(this).text($(this).text() == "Show" ? "Hide" : "Show");
        $(this).prev().attr('type', function(index, attr) {
            return attr == 'password' ? 'text' : 'password';
        });
    });
    </script>
</body>
</html>

