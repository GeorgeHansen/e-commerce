
<style type="text/css">
/*I suppose at one point we should actually define style sheets. Not today though. */
    body{
        background-color: #f1f1f1;
    }
    .jumbotron {
        background-color:#C0C0C0 !important; 
        
    }
    img{
    background-color: #999999;
    -moz-border-radius: 10px;
    border-radius: 10px;
}

</style>

<div class="container">
    <div class="jumbotron">
       <h1>Millionaire maker</h1>
       <p>Without wanting to brag or boast, we can humbly say that we have the capacity to enable you to become a millionaire! Now who doesn't want to make a million??? Not you!!! <a href="#">$ Start Here $</a> </p>
   </div>


   <!-- display max 4 items on the page. -->
   <?php 

// Temp list of names just to see how we might use them in the generated products.
   $names = [
   "sam",
   "bob",
   "craig",
   "samuel"
   ];
    // TODO: Loop through each product. Make sure to limit the number of products to 4.
    // We need: product [name: description: picture: price ] user[ user_name ]
   
   for($i = 0; $i< count($productList); $i++){ 

    ?>
    <!-- Template for all products -->
    <div class="thumbnail" style="border-radius: 10px;">
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
                    <h3><a href="#product-page"><?php 
                    if(isset($products)){
                        echo htmlspecialchars($productList[$i]->getName(), ENT_QUOTES, 'UTF-8'); 
                    ?> 
                    </a><small><a href=<?php echo "?controller=user&action=home&id=". htmlspecialchars($productList[$i]->getOwnerId(), ENT_QUOTES, 'UTF-8') ?>>- <?php  echo htmlspecialchars($productList[$i]->getOwner(), ENT_QUOTES, 'UTF-8');  ?></a></small></h3>
                    <!-- TODO: we'll need to limit the text to about this much. -->
                    <p><?php echo  htmlspecialchars($productList[$i]->getDescription(), ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="caption">
                    <h4>Price: <medium class="text-danger"data-toggle="tooltip" title="too much for you!">
                        <?php echo htmlspecialchars($productList[$i]->getPrice(), ENT_QUOTES, 'UTF-8'); ?>
                    </medium></h4>
                </div>
            </div>
        </div>
        <div class="row"> <!-- magic row -->
        </div><!-- /thumbnail -->

    </div>
    <?php   }
        } ?>