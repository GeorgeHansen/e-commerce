<?php 

include 'Models/Review.php';
class UserController{

	private $db;
	//the get page.
	public function home()
	{
        
        //need to be able to look for a specific user. 
        //If one isn't set we should probably redirect to homepage.
        
        if(!isset($_GET["id"]))
        {
            echo 'error page';
            // require_once();
        }
        else
        {

            require_once('Database.php');
            $db = Database::getInstance();
            $userId = $_GET["id"];

            $count = $db->query("SELECT user_name FROM users where id=?", array($userId))->count();
            $username = $db->getResults();
            
            if($count > 0)
            {
              
                //will need to get the id from somewhere else.
                //don't want to retrieve more than 4 of the newest reviews.
                $reviewsResult = $db
                ->query("SELECT * FROM reviews where reviewed_userid = ? ORDER BY review_date DESC Limit 4 ",array($userId))
                ->getResults();

                $reviews = array();

                 for($i = 0; $i < count($reviewsResult); $i++)
                {

                    $review = $reviewsResult[$i]->review;
                    $reviewDate = $reviewsResult[$i]->review_date;
                    $reviewerId = $reviewsResult[$i]->reviewer_userid;

                    // echo $reviewerId."<br>";
                    // echo $userId."<br>";
                    $reviewer = $db->query("SELECT user_name FROM users where id=?", array($reviewerId))
                        ->getResults();
                    $reviewer = $reviewer[0]->user_name;
                   
                    $reviewed = $db->query("SELECT user_name FROM users where id=?", array($userId))
                        ->getResults();
                    $reviewed = $reviewed[0]->user_name;
                    
                    $review = new Review($review, $reviewDate, $reviewer, $reviewed);
                    array_push($reviews, $review);

                    
                
                }
                require_once('views/user/userpage.html');
            }
            else{
                echo 'home page';
            }
            
    

            

        }

        



        

       
   
        // print_r($db);
      //TODO: get reviews
      //TODO: get user info like country username,rating.
      // 
    }

    public function error() 
    {
      require_once('views/registration/error.php');
    }
    public function post()
    {
       	
        require_once('Validator.php');
    	$validate = new Validator();
    	//pass through each field you want checked, plus the rules.
    	$validator = $validate->check($_POST, array(
    
    	));

    	if($validator->passed())
    	{
    		
		}
    	else
    	{
    		//TODO: properly display error messages in the view. 
    		//Should be contained in the errors array in the validator. 
    		require_once("views/user/userpage.php");
    	}
		
    }

   	


}
 ?>