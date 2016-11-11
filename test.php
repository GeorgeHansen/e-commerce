<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js">
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<br>

<div class="container">

<!-- display max 4 items on the page. -->
<?php 

  $names = [
        "sam",
        "bob",
        "craig",
        "samuel"

    ];
    // TODO: Loop through each product. Make sure to limit the number of products to 4.
    // We need: product [name: description: picture: price ] user[ user_name ]
    foreach($names as $name){ 

?>
    <!-- Template for all products -->
    <div class="thumbnail">
        <!-- Image -->
        <div class="col-sm-3 col-md-3 col-lg-3">
            <div class="row">
                <img src="http://placehold.it/200x200">
            </div>
        </div>
        <!-- Product name - description -->
        <div class="col-sm-8 col-md-8 col-lg-8">
            <div class="row"> 
                <div class="caption ">
                    <h3><a href="#product-page">Best Product </a><small><a href="#author-page">- <?php echo $name ?></a></small></h3>
                    <!-- TODO: we'll need to limit the text to about this much. -->
                    <p>Agreed, super product, buy it twice. What else can we say about this? It's really nice. So what are you waiting for? Head on to your local kmart today! No kmart in your country? That's not an excuse! Email us your country and we'll personally provide a kmart for you. At no cost to you!</p>
                </div>
            </div>
            <div class="row">
                    <div class="caption">
                        <h4>Price: <medium class="text-danger"data-toggle="tooltip" title="too much for you!">1334</medium></h4>
                    </div>
            </div>
        </div>
        <div class="row"> <!-- magic row -->
    </div><!-- /thumbnail -->

</div>
<?php } ?>

