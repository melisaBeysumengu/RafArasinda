<!DOCTYPE html>
<html lang="en">

<?php
   require APPROOT . '/views/includes/head.php';
?>
<div class="navbar">
    <?php
       require APPROOT . '/views/hpage.php';
    ?>
</div>

<div class="form">
    <h2
        style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
    </h2>
    <form class="registerform" action="<?php echo base_url('register/signup');?>" method="POST">

        <input type="text" name="first" placeholder="first name"> </input>
        <br>
        <input type="text" name="last" placeholder="last name"> </input>
        <br>
        <input type="email" name="email" placeholder="email@gmail.com"> </input>
        <br>
        <input type="text" name="uid" placeholder="username"> </input>
        <br>
        <input type="password" name="pwd" placeholder="password"> </input>
        <br>
        <button type="submit" name="submit">Sign up</button>
        <p class="message">Already Registered! <a href="#">Log in</a>

        </p>

    </form>
    <form class="loginform" action="<?php echo base_url('Register/logincontrol');?>" method="POST">

        <input type="text" name="name" placeholder="username"> </input>

        <input type="password" name="password" placeholder="password"> </input>
        <button type="submit" name="login">Log in</button>

        <p class="message">You do not have an account? <a href="#">Sign up</a>
        </p>
        <?php echo @$passwordError;?>
        <?php echo @$usernameError;?>
        <?php echo @$loginfailed;?>
        <?php echo @$validation_error;?>
    </form>
    <?php echo @$alreadyregistered;?>
</div>
<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
<script>
$('.message a').click(function() {
    $('form').animate({
        height: "toggle",
        opacity: "toggle"
    }, "slow");
});
</script>