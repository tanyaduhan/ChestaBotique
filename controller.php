<?php
error_reporting(0);
session_start();
if (empty($_POST['page'])) {  // When no page is sent from the client; The initial display
                                // You may use if (!isset($_POST['page'])) instead of empty(...).
    $display_modal_window = 'no-modal';  // This variable will be used in 'view_startpage.php'.
                              // It will display the start page without any box, i.e., no LogIn box, no Join box, ...
    include('index.php');
    exit();
}


require('model.php');
header('Content-Type: application/json');
//header('Access-Control-Allow-Headers : *');
if($_POST['page'] == 'users'){
	$command = $_POST['command'];
	switch($command) {  
                case 'getAllUsers' :
                        echo toJson(getAllUsers());          
                break;
		case 'adduser' : 
			 $uid=generateRandomString(20);
				$myObj=new \stdClass();
				if(signup_a_new_user($uid, $_POST['name'], $_POST['email'], $_POST['phone_number'], $_POST['password'], $_POST['first_name'], $_POST['address'])==false){
					$myObj->result = "Already Exists";
					echo json_encode($myObj);
				}else{
					$myObj->result = "Added";
					echo json_encode($myObj);
					$user_object=check_user_validity( $_POST['email'],  $_POST['password']);
					$jsonObj= toJson($user_object); 
					$_SESSION["uid"]=json_decode($jsonObj)[0]->uid;
	                                $_SESSION["name"]=json_decode($jsonObj)[0]->name;
        	                        $_SESSION["first_name"]=json_decode($jsonObj)[0]->first_name;
                	                $_SESSION["email"]=json_decode($jsonObj)[0]->email;
				}
		break;
		case 'login' : 
			$user_object=check_user_validity( $_POST['email'],  $_POST['password']);

			if (mysqli_num_rows($user_object) > 0){
				$jsonObj= toJson($user_object);	
				echo  $jsonObj;			
//				echo json_decode($jsonObj)[0]->uid;				

				$_SESSION["uid"]=json_decode($jsonObj)[0]->uid;
				$_SESSION["name"]=json_decode($jsonObj)[0]->name;
				$_SESSION["first_name"]=json_decode($jsonObj)[0]->first_name;
				$_SESSION["email"]=json_decode($jsonObj)[0]->email;
			}
			else{
				$myObj=new \stdClass();
				$myObj->result = "Access Denied";
				echo json_encode($myObj);
			}
		break;		
		case 'logout' : 
			session_unset();
			session_destroy();		
			echo '{"status" : "Session Over"}';
		break;
		case 'get_my_cart' :
			$user_cart=getMyCart($_SESSION["uid"]);
		 if (mysqli_num_rows($user_cart) > 0){
			echo toJson($user_cart);	
		}else {
			$myObj=new \stdClass();
                                $myObj->result = "Cart Empty";
                                echo json_encode($myObj);
		} 
		break;
		case 'add_to_cart' :
		//echo $_POST["pid"];

		if(!isset($_SESSION["uid"])){

		 $myObj->result = "Denied";
                                echo json_encode($myObj);
		} else{
		//echo $_SESSION["uid"];
		$result=addToCart($_SESSION["uid"],$_POST["pid"]);
		//echo $_POST["pid"];		
		$myObj->result = "Added";
                                echo json_encode($myObj);
		}
		break;
		  case 'remove_from_cart' :
                //echo $_POST["pid"]; 
                //echo $_SESSION["uid"];
                $result=removeFromCart($_SESSION["uid"],$_POST["pid"]);
                //echo $_POST["pid"];           
                $myObj->result = "Removed";
                                echo json_encode($myObj);
		break;

		case 'add_to_wishlist' :
		  if(!isset($_SESSION["uid"])){

                 $myObj->result = "Denied";
                                echo json_encode($myObj);
                } else{
                //echo $_SESSION["uid"];
                $result=addToWishlist($_SESSION["uid"],$_POST["pid"]);
                //echo $_POST["pid"];           
                $myObj->result = "Added";
                                echo json_encode($myObj);
                }
 
		break;
		case 'get_all_from_wishlist' : 
		$user_wishlist=getMyWishlist($_SESSION["uid"]);
                 if (mysqli_num_rows($user_wishlist) > 0){
                        echo toJson($user_wishlist);        
                }else {
                        $myObj=new \stdClass();
                                $myObj->result = "Wishlist Empty";
                                echo json_encode($myObj);
                } 

		break;
		case 'remove_from_wishlist' : 
		removeFromWishlist($_SESSION["uid"], $_POST["pid"]);
				  $myObj=new \stdClass();
                                $myObj->result = "Removed From Wishlist";
                                echo json_encode($myObj);
		
		break;
		case 'get_myself':
		if(!isset($_SESSION["uid"])){
			  $myObj=new \stdClass();
                                $myObj->result = "Access Denied";
                                echo json_encode($myObj);
		}else{
		$user_myself=getMyself($_SESSION["uid"]);
		//echo "jo";		
		echo toJson($user_myself);}
		break;
		case 'delete_profile':
		deleteProfile($_SESSION["uid"]);
		$myObj=new \stdClass();
			session_unset();
                        session_destroy();   
                                $myObj->result = "Profile Deleted";
                                echo json_encode($myObj);
		break;
        }
}


if ($_POST['page'] == 'StartPage')
{
      $command = $_POST['command'];
	switch($command) {  
    		case 'getAllProducts' :
			echo toJson(getAllProducts());		
		break;
	}
}
if ($_POST['page'] =='adminRequest'){
	//echo "gotrequest";
	
	$product_id=generateRandomString(20);
	 $file_name = $_FILES['image']['name'];
	$file_tmp=$_FILES['image']['tmp_name'];
	addProduct($product_id, $_POST['name'], $_POST['price'], $_POST['fabric_type'],$_POST['discount_price'],$_POST['category']);	
echo move_uploaded_file($file_tmp,"product_images/".$product_id.".jpg");


	echo $file_name;
	
}

if($_POST['page'] =='check_session'){
echo "ID:".$_SESSION["uid"];
}
function toJson($result){

		 while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $myArray[] = $row;
                 }
		if($myArray==NULL)
		return "{'status' : 'denied'}";
		else
                return json_encode($myArray);

}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
