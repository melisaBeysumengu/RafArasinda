<div class="sections">

    </br>
    <img src="<?php echo base_url('css/logo.png') ?>" width="%100" height="134px" alt="logo">


    <ul>

        <a href="<?php echo base_url('Homepage/showhome');?>">
            <li>HOME</li>
        </a>

        <a href="<?php echo base_url('Homepage/bookPage');?>">
            <li>BOOKS</li>
        </a>

        <a href="<?php echo base_url('Homepage/browsePage');?>">
            <li>EXPLORE</li>
        </a>

        <?php if($this->session->has_userdata('user_id')) : ?>
        <a href="<?php echo base_url('Homepage/loggedout');?>">

            <li> LOGOUT</li>
        </a>
        <a href="<?php echo base_url('Register/myprofile');?>">
            <li> MYPROFILE</li>
        </a>

        <?php endif ;?>

    </ul>
</div>