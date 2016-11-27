<?php 

class HomepageController{



	//the get page.
	public function home()
	{
		require_once('Database.php');
		require_once('Models/Product.php');

		//TODO: List of 4 most recent products. We need product name, product description, price, product owner.
		$db = Database::getInstance();

		$productCount = $db
		->query(
			"SELECT id, product_name, product_description, product_picture,product_price, owner_userid
			FROM product
			ORDER BY product_date
			DESC Limit 4")->getCount();

		$products = $db->getResults();
		$productList = array();
		// echo $productCount;
		if($productCount > 0)
		{

			for($i=0; $i < $productCount; $i++)
			{
				$productId = $products[$i]->id;
				$product_name = $products[$i]->product_name;
				$product_description = $products[$i]->product_description;
				$product_price = $products[$i]->product_price;
				$ownerId = $products[$i]->owner_userid;

				// echo $product_price;
				$user_name = $db->query("SELECT user_name FROM users where id=?",array($ownerId))->getResults();
				$user_name = $user_name[0]->user_name;
				$product = new Product($productId,$product_name,$product_description,$product_price,$ownerId, $user_name);

				// echo $product->getPrice();
				array_push($productList, $product);
				//create product.
			}
		}

		// print_r($productList);


    	require_once('Views/homepage/homepage.php');
    }

}
