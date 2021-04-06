<?php

$conn = mysqli_connect("localhost", "tanyaw21", "tanyaw21136", "C354_tanyaw21");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

function getMyself($uid){
	global $conn;
  $sql = "select * from users_boutique where uid = '$uid'";
    $result = mysqli_query($conn, $sql);

    return $result;
}
function deleteProfile($uid){

 global $conn;
$sql = "delete from users_boutique where uid = '$uid'";

$result = mysqli_query($conn, $sql);

    return $result;
}
function getAllProducts() 
{
    global $conn;
    
    $sql = "select * from products_boutique";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function getMyCart($uid){
global $conn;
    
    $sql = "select * from cart_boutique where uid = '$uid'";
    $result = mysqli_query($conn, $sql);

    return $result;

}

function getMyWishlist($uid){

global $conn;
    
    $sql = "select * from wishlist_boutique where uid = '$uid'";
    $result = mysqli_query($conn, $sql);


    return $result;

}
function addToCart($uid, $pid){
global $conn;
	$product=json_decode(toJson(getProduct($pid)));
	$price=$product[0]->price;
	$name=$product[0]->name;
		$sql = "insert into cart_boutique (uid, pid, name, price, quantity) values('$uid', '$pid', '$name', '$price', '1')";
	//echo $sql;
	if(checkInCart($uid, $pid)){
		$result = incrementValue($uid, $pid);
		//echo "Incremented";
	}
	else{
    		$result = mysqli_query($conn, $sql);
		//echo "Added";
	}
}
function addToWishlist($uid, $pid){
global $conn; 
//$sql = "insert into wishlist_boutique (uid, pid, name) values('$uid', '$pid', '$name')";
 $product=json_decode(toJson(getProduct($pid)));
        $price=$product[0]->price;
        $name=$product[0]->name;
$sql = "insert into wishlist_boutique (uid, pid, name) values('$uid', '$pid', '$name')";
	 if(!checkInWishlist($uid, $pid)){
		$result = mysqli_query($conn, $sql);
	}
}
function removeFromCart($uid, $pid){
global $conn;
        $product=json_decode(toJson(getProduct($pid)));
        $price=$product[0]->price;
        $name=$product[0]->name;
                $sql = "delete from cart_boutique where uid = '$uid' && pid = '$pid'";
        //echo $sql;
        if(checkOneInCart($uid, $pid)){
                $result = decrementValue($uid, $pid);
                //echo "Incremented";
        }
        else{
                $result = mysqli_query($conn, $sql);
                //echo "Added";
        }
}
function removeFromWishlist($uid, $pid){

global $conn;

 $sql = "delete from wishlist_boutique where uid = '$uid' && pid = '$pid'";
 $result = mysqli_query($conn, $sql);

	
}
function decrementValue($uid, $pid){
 global $conn;
        $sql = "update cart_boutique set quantity=quantity-1 where uid = '$uid' && pid = '$pid'";

        $result = mysqli_query($conn, $sql);

}
function incrementValue($uid, $pid){
 global $conn;
        $sql = "update cart_boutique set quantity=quantity+1 where uid = '$uid' && pid = '$pid'";

        $result = mysqli_query($conn, $sql);

}
function checkInCart($uid, $pid){
	global $conn;
	$sql = "select * from cart_boutique where uid = '$uid' && pid = '$pid'";
//echo $sql;	
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0)
return true;
else
return false;

}
function checkInWishlist($uid, $pid){
        global $conn;
        $sql = "select * from wishlist_boutique where uid = '$uid' && pid = '$pid'";
//echo $sql;    
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0)
return true;
else
return false;

}


function checkOneInCart($uid, $pid){
        global $conn;
        $sql = "select * from cart_boutique where uid = '$uid' && pid = '$pid' && quantity = 1";
//echo $sql;    
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0)
return false;
else
return true;

}
function getProduct($pid){
global $conn;
    
    $sql = "select * from products_boutique where pid = '$pid'";
    $result = mysqli_query($conn, $sql);

    return $result;

}
function addProduct($pid, $name, $price, $fabric_type, $discount_price, $category ){

global $conn;
$sql = "insert into products_boutique (pid, name, price, fabric_type, discount_price, category) values('$pid','$name','$price','$fabric_type','$discount_price','$category')";
    $result = mysqli_query($conn, $sql);
	
}


function check_user_existence($username) 
{
    global $conn;
    
    $sql = "select * from users_boutique where email = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function check_user_validity($username, $password) 
{
    global $conn;
    
    $sql = "select * from users_boutique where email = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    
        return $result;
  
}

function signup_a_new_user($uid, $username,$email, $phone_number,  $password , $first_name, $address) 
{
    global $conn;
    
    if (check_user_existence($email))
        return false;
    
//    $current_date = date("Ymd");
    $sql = "insert into users_boutique values ('$uid', '$username', '$email', '$phone_number', '$password', '$first_name', '$address')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

/*function toJson($result){

                 while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $myArray[] = $row;
                 }
                if($myArray==NULL)
                return "{'status' : 'denied'}";
                else
                return json_encode($myArray);

}
*/
