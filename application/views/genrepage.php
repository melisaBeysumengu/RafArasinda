<!DOCTYPE html>
<html lang="en">


<?php
        require APPROOT . '/views/includes/head.php';
    ?>

<style>
html {

    background-image: url('../css/Background.png') no-repeat center center fixed;
    font-family: system-ui;
    -webkit-font-smoothing: antialiased;
    padding: 10px 0;

    background-size: cover;
    height: 100%;

}

header {
    font-size: 30px;
    margin: 0;
    text-align: center;
    color: rgb(253, 101, 0);
    border-style: solid;
    border-color: rgb(253, 101, 0);
    border-radius: 8px;
    margin-left: 313px;
    width: 46%;

}

.band {
    width: 90%;
    max-width: 540px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: auto;
    grid-gap: 20px;

    @media (min-width: 30em) {
        grid-template-columns: 1fr 1fr;
    }

    @media (min-width: 60em) {
        grid-template-columns: repeat(4, 1fr);
    }
}

.card {
    border-style: solid;
    border-color: rgb(253, 101, 0);
    text-align: center;
    background: white;
    text-decoration: none;
    color: #444;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    min-height: 90%;

    // sets up hover state
    position: relative;
    top: 0;
    transition: all .1s ease-in;

    &:hover {
        top: -2px;
        box-shadow: 0 4px 5px rgba(0, 0, 0, 0.2);
    }

    article {
        padding: 20px;
        flex: 1;

        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    h1 {
        font-size: 20px;
        margin: 0;
        text-align: center;
        color: #333;
    }

    p {
        flex: 1;
        line-height: 1.4;
    }

    span {
        font-size: 12px;
        font-weight: bold;
        color: #999;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin: 2em 0 0 0;
    }

    .thumb {
        padding-bottom: 60%;

        background-position: center center;
    }
}

.item-1 {
    @media (min-width: 60em) {
        grid-column: 1 / span 2;

        h1 {
            font-size: 24px;
        }
    }
}

.btn--block {
    align: center;
    display: block;
    width: 95%;
}

.btn {
    align: center;
    padding: 10px 30px;
    border: 0;
    background: rgb(253, 101, 0);
    font-weight: bold;
    cursor: pointer;
    border-radius: 12px;
}
</style>

<?php
        require APPROOT . '/views/includes/nav.php';
    ?>

<?php
    $count=1;
    foreach ($genre as $b) {
       if($count==1)
        {?>
<header><?php echo $b->genre_name ;?></header>
<?php $count++;
         }?>
<div class="band" method="POST">
    <div class="item-1">
        <a href="<?php echo base_url('Homepage/bookdata/'.$b->book_id);?>" class="card">
            </br>
            <div class="thumb" style="background-image"><img src="<?php echo $b->img; ?>" width="40%" heigth="%30">
            </div>
            <article>
                <h1><?php $title= $b->title; echo $title; ?></h1>
                <span><small><?php
                           $name= $b->first_name."\t".$b->second_name;
                           echo $name;
                            ?>
                    </small></span>
            </article>
            </br>
            <button class="btn btn--block card__btn">LEARN MORE!</button>
        </a>
    </div>

</div>
<?php } ?>

</body>

</html>