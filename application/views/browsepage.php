<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        require APPROOT . '/views/includes/head.php';
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://twitter.github.io/typeahead.js/css/examples.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>

    <style>
    .box {
        width: 100%;
        max-width: 650px;
        margin: 0 auto;
    }

    .genre button {
        background: rgb(253, 101, 0);

    }

    .genre button:hover {
        background: rgb(255, 140, 64);
    }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="bar">
            <div class="search-container">
                <?php
                    require APPROOT . '/views/includes/nav.php';
                ?>

                <h1>
                    <a href="<?php echo base_url('Homepage/showhome'); ?>">
                        <button type="back"> Back</button>
                    </a>
                </h1>


                <div class="container">
                    <div id="prefetch">
                        <input type="text" name="search_box" id="search_box" placeholder="Browse between the shelves."
                            method="POST" class="form-control input-lg typeahead" />
                        </input>
                    </div>
                </div>

                <div class="genre">

                    <br>
                    <a onclick="location.href='<?php echo base_url('Homepage/genredata/2');?>'">
                        <button type="button" class="genre">ROMANCE</button>
                    </a>
                    <button>COMICS</button>
                    <a onclick="location.href='<?php echo base_url('Homepage/genredata/4');?>'">
                        <button type="genres">YOUNG-ADULT & TEEN</button>
                    </a>

                    <a onclick="location.href='<?php echo base_url('Homepage/genredata/5');?>'">
                        <button type="genres">CLASSICS</button>
                    </a>

                    <a onclick="location.href='<?php echo base_url('Homepage/genredata/3');?>'">
                        <button type="genres">CRIME</button>
                    </a>
                    <br>
                    <br>
                    <a onclick="location.href='<?php echo base_url('Homepage/genredata/1');?>'">
                        <button type="genres">ART & PHOTOGRAPHY</button>
                    </a>

                    <button type="genres">PSYCHOLOGY</button>
                    <button type="genres">CHILDRENS</button>
                    <button type="genres">MYSTERY</button>

                    <br>
                    <br>
                    <button type="genres">HISTORY</button>
                    <button type="genres">FICTION</button>
                    <button type="genres">FANTASY</button>
                    <button type="genres">THRILLER</button>
                    <button type="genres">SCIENCE</button>
                </div>
            </div>


        </div>

    </div>
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


</body>

</html>