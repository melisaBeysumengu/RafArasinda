<!DOCTYPE html>
<html lang="en">


<head>

    <?php
    require APPROOT . '/views/includes/head.php';
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bookStyle.css">
    <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <style>
        html {

            font-family: system-ui;
            -webkit-font-smoothing: antialiased;
            padding: 10px 0;
            background-size: cover;
            height: 100%;
        }

        .img-with-text {
            text-align: justify;
        }

        .img-with-text img {
            display: block;
            margin: 0 auto;
        }

        .button {
            display: inline-block;
            border-radius: 4px;
            background-color: #f4511e;
            border: none;
            color: #ffffff;
            text-align: center;
            font-size: 25px;
            padding: 10px;
            width: 200px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
            content: "\00bb";
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button:hover span {
            padding-right: 25px;
        }

        .button:hover span:after {
            opacity: 1;
            right: 0;
        }
    </style>

</head>

<body>

    <?php
    require APPROOT . '/views/includes/nav.php';
    ?>


    <!-- BOOK INFORMATION SECTION START -->
    <?php
    $control = false;
    foreach ($books as $b) {
        ///if it has more than one review
        if (!$control) {
            $avgRate = 0;
            if (property_exists($b, "rate")) {
                $comNum = 0;
                foreach ($books as $b) {
                    $rate = $b->rate;
                    $avgRate += $rate;
                    $comNum += 1;
                }
                $avgRate = $avgRate / $comNum;
            }
    ?>
            <div class="site" method="POST">
                <div class="img-with-text">
                    <p><?php for ($i = 0; $i < $avgRate; $i++) {
                            echo "<i class='fa fa-star' style='color:#f4511e; font-size:30px;'></i>";
                        }
                        for ($i = 0; $i < 5 - $avgRate; $i++) {
                            echo "<span class='fa fa-star' style='font-size:30px;'></span>";
                        } ?>
                        <a href="<?php echo $b->url ?>">
                            <button class="button" style="vertical-align:middle"><span>Purchase<i class="fa fa-shopping-cart"></i></span></button>
                        </a>
                    </p>

                    <img src="<?php echo $b->img; ?>" width="350px" height="500px" alt="sometext" />
                    <p><?php
                        echo "Publisher: " . $b->publisher_name . " (" . $b->publishedDate . ")";
                        ?></p>

                </div>
                <h1><?php echo $b->title; ?>
                    <smaller><?php echo $b->ratingcount ?><br></smaller>
                    <small>
                        <?php
                        echo $b->genre_name;
                        ?>
                        <br>
                        <a title="Click for author information." style="color: inherit;" href="<?php echo base_url('Homepage/authordata/' . $b->Author_ID); ?>">
                            <?php echo $b->first_name . " " . $b->second_name; ?>
                        </a>
                        <br></br>
                    </small>
                    <smaller><?php echo $b->sum; ?></smaller>
                </h1>
            </div>
    <?php }
        $control = true;
    } ?>
    <!-- BOOK INFORMATION SECTION END -->

    <div class="comment-row">
        <?php
        if ($this->session->userdata('user_id')) {
        ?>

            <form name="review-box" id="review-box" role="form" class=comment-box method="post" action="<?php echo site_url('Homepage/addReview/' . $this->uri->segment(3)); ?>">
                <div class="rating">
                    <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
                    <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
                    <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
                    <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
                    <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
                    <input type="hidden" name="rate" id="rate"></input>
                </div>
                <input type="hidden" name="rev" id="rev"></input>
                <textarea class="comment" rows="5" style="resize: vertical;" type="text" placeholder="Enter a comment..."></textarea>
                <button id="comment-button" name="comment-button" type="submit">leave a comment</button>
            </form>
        <?php } ?>
        <ul class="comments-list" <?php
                                    if (!$this->session->userdata('user_id')) {
                                        echo "style='margin-left:30%;'";
                                    }
                                    ?>>
            <?php
            foreach ($books as $b) {
                if (property_exists($b, 'user_uid')) {
            ?>
                    <li class="comment" <?php
                                        if ($b->user_id == $this->session->userdata('user_id')) {
                                            echo "style='background-color: #f87952;'";
                                        }
                                        ?>>
                        <p class="user" id="user0" <?php
                                                    if ($b->user_id == $this->session->userdata('user_id')) {
                                                        echo "style='color: white;'";
                                                    }
                                                    ?>><?php echo $b->user_uid; ?></p>
                        <p class="star">
                            <?php
                            $rate = $b->rate;
                            for ($i = 0; $i < $rate; $i++) {
                                echo "<i class='fa fa-star' style='color:#f4511e'></i>";
                            }
                            for ($i = 0; $i < 5 - $rate; $i++) {
                                echo "<span class='fa fa-star'></span>";
                            }
                            ?>
                        </p>
                        <p class="comment"><?php echo $b->review; ?></p>
                    </li>
            <?php }
            } ?>
        </ul>
    </div>

    <script>
        $(document).ready(function() {
            // Check Radio-box
            $(".rating input:radio").attr("checked", false);

            $('.rating input').click(function() {
                $(".rating span").removeClass('checked');
                $(this).parent().addClass('checked');
            });

            $('input:radio').change(
                function() {
                    userRating = this.value;
                    $("#rate").val(userRating);
                    //parent.location.hash = userRating;
                    //alert(userRating);
                });

            var $cbutton = $('#comment-button');
            var $textBox = $('textarea[class="comment"]');

            $cbutton.click(function() {
                var commentText = $textBox.val();
                if (commentText.length < 10) {
                    alert("Your comment must be at least 10 characters long.");
                    return false;
                } else if (commentText.length > 2000) {
                    alert("Your comment must be no longer than 1000 characters.");
                    return false;
                } else {
                    $("#rev").val(commentText);
                    $textBox.val("");
                    return true;
                }
            });
        });
    </script>



</body>

</html>