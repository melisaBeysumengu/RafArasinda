<!DOCTYPE html>
<html lang="en">

<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="wrapper">
    <div class="bar">
        <?php
            require APPROOT . '/views/includes/nav.php';
        ?>
        <div class="homapagetitle">
            <br />
            <h1 style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
                Travel Between Bookshelves</h1>
            <a href="<?php echo base_url('Homepage/browsePage');?>">
                <button type="button" class="btn"> EXPLORE </button></a>
        </div>
    </div>

</div>

</body>

</html>