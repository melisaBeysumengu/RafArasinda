<!DOCTYPE html>
<html lang="en">



<?php
require APPROOT . '/views/includes/head.php';
?>


<style>
    html {

        background-image: url('../css/Background.png');
        font-family: system-ui;
        -webkit-font-smoothing: antialiased;
        padding: 10px 0;
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

<header>
    ALL BOOKS
</header>
<?php
foreach ($books as $b) {
?>
    <div class="band" method="POST">
        <div class="item-1">
            <a href="<?php echo base_url('Homepage/bookdata/' . $b->book_id); ?>" class="card">
                </br>
                <div class="thumb" style="background-image"><img src="<?php echo $b->img; ?>" width="40%" heigth="%30">
                </div>
                <article>
                    <h1><?php $title = $b->title;
                        echo $title; ?></h1>
                    <span><small><?php
                                    $name = $b->first_name . "\t" . $b->second_name;
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
<script>
    $(document).ready(function() {
        var id;
        var sample_data = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '<?php echo base_url(); ?>Homepage/fetch',
            remote: {
                url: '<?php echo base_url(); ?>Homepage/fetch/%QUERY',
                wildcard: '%QUERY',
            }
        });



        $('#prefetch .typeahead').typeahead(null, {
            name: 'sample_data',
            display: 'id',
            source: sample_data,
            limit: 10,
            templates: {
                suggestion: Handlebars.compile(
                    '<div class="row"><div class="col-md-2" style="padding-right:5px; padding-left:5px;"><img src="{{img}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="padding-right:5px; padding-left:5px;">{{name}}</div></div>'
                )
            }

        });


        $('input.typeahead').bind("typeahead:selected", function() {

            // console.log(id);
            // window.location.href="bookPage/"+id;
            var str = $("#search_box").val();
            window.location.href = "bookdata/" + str;

        });
    });
</script>


</html>