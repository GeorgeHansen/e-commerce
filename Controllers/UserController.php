<?php 

include 'Models/Review.php';
include 'Database.php';
class UserController{

    // require_once('Database.php');
	private $db;
	//the get page.
	public function home()
	{

        //need to be able to look for a specific user. 
        //If one isn't set we should probably redirect to homepage.
        if(!isset($_GET["id"]))
        {
            echo 'homepage';
            // require_once();
        }
        else
        {

            
            $db = Database::getInstance();
            $userId = $_GET["id"];

            session_start();
            $_SESSION['userId'] = $userId;
            
            $userCount = $db->query("SELECT user_name FROM users where id=?", array($userId))->getCount();
            $username = $db->getResults();
            
            if($userCount > 0)
            {
                //don't want to retrieve more than 4 of the newest reviews.
                $reviewsResult = $db
                ->query("SELECT * FROM review where reviewed_userid = ? ORDER BY review_date DESC Limit 4 ",array($userId))
                ->getResults();

                $reviews = array();

                //looping through the reviews and finding the reviewer associated with them. 
                for($i = 0; $i < count($reviewsResult); $i++)
                {
                    
		  
		    $review = $reviewsResult[$i]->review;
                    $reviewDate = $reviewsResult[$i]->review_date;
                    $reviewerId = $reviewsResult[$i]->reviewer_userid;

                    $reviewer = $db->query("SELECT user_name FROM users where id=?", array($reviewerId))
                        ->getResults();
                    $reviewer = $reviewer[0]->user_name;
                    $reviewed = $username[0]->user_name;
                    $review = new Review($review, $reviewDate, $reviewer, $reviewed);
                    array_push($reviews, $review);

                }
                require_once('Views/user/userpage.html');
            }
            else{
                //user doesn't exist. Go to home page.
                echo 'home page';
            }
        }
    }

    public function error() 
    {
      require_once('Views/registration/error.php');
    }
    public function post()
    {
       	session_start();
      

        require_once('Validator.php');
    	$validate = new Validator();
    	//pass through each field you want checked, plus the rules.
        // print_r($_POST);
        //should possibly modify the validate here to check for 
    	$validator = $validate->check($_POST, array(
                'reviewText' => array(
                    'required' => true,
                )
    	));

    	if($validator->passed())
    	{
    		
            $db = Database::getInstance();

            $reviewPost = $_POST['reviewText'];
            $dateTime = date('Y-m-d H:i:s');
            //Need to get the data from whomever is logged in.
            $reviewer = 5;
            $reviewed =  $_SESSION['userId'];

            //database insert time.
            // Need to make sure to clean up the review.
            $db->query('INSERT INTO review (reviewer_userid, reviewed_userid, review,review_date) VALUES(?,?,?,?)', array($reviewer,$reviewed,$reviewPost, $dataTime));

            header("Location: ?controller=User&action=home&id=".$reviewed);
		}
    	else
    	{
    		//TODO: properly display error messages in the view. 
    		//Should be contained in the errors array in the validator. 
            $reviewed=$_SESSION['userid'];
    		header("Location: ?controller=User&action=home&id=".$reviewed);
    	}
        
		
    }

   	


}
 ?>
