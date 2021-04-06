<?php
session_start();
$username = "none";
$email = "none";
if(isset($_SESSION["uid"])){
	$username = $_SESSION["first_name"];

	$email = $_SESSION["email"];
}//	echo $username;
//	echo $email;
//}else echo "Not found";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Chesta Boutique</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex toggled" id="wrapper" style="background-image: url('background_texture.jpg');">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Chesta's Boutique</div>
      <div class="list-group list-group-flush">
         <a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#contact_us-modal">Contact Us</a>
        <a href="#" class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#change-modal"<?php if($username == "none")echo "hidden";?>>My Profile</a>
		<a  class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#signup-modal" <?php if($username != "none")echo "hidden";?>>Signup</a>
 <a  class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#login-modal" <?php if($username != "none")echo "hidden";?>>SignIN</a>
	<a  class="list-group-item list-group-item-action bg-light" data-toggle="modal" data-target="#wishlist-modal" <?php if($username == "none")echo "hidden";?>>Wishlist</a>        
<a class="list-group-item list-group-item-action bg-light" onclick="showCart()" <?php if($username == "none")echo "hidden";?>>View Cart</a>
        <a class="list-group-item list-group-item-action bg-light" href="#" onclick="logoutRequest()" <?php if($username == "none")echo "hidden";?>>Logout</a>      
</div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"> <i class="fa fa-bars" aria-hidden="true"></i></button>
        <div style="margin-left:90px;"><h3> Welcome to our local and woman owned boutique</h3></div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          
            <li class="nav-item">
              <a  class="nav-link" data-toggle="modal" data-target="#signup-modal" <?php if($username != "none")echo "hidden";?>>Signup</a>
            </li>
  <li class="nav-item">
 <a  class="nav-link" data-toggle="modal" data-target="#login-modal" <?php if($username != "none")echo "hidden";?>>Sign-in</a>
  </li>
             <li class="nav-item dropdown"  <?php if($username == "none")echo "hidden";?>>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hi, <?php echo $username; ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                
                <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#contact_us-modal">Contact Us</a>
                <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#change-modal" <?php if($username == "none")echo "hidden";?>>My Profile</a>
		 <a  class="dropdown-item" data-toggle="modal" data-target="#login-modal" <?php if($username != "none")echo "hidden";?>>Sign-in</a>
		<a  class="dropdown-item" data-toggle="modal" data-target="#wishlist-modal" <?php if($username == "none")echo "hidden";?>>Wishlist</a> 
  <a  class="dropdown-item" data-toggle="modal" data-target="#delete_profile-modal" <?php if($username == "none")echo "hidden";?>>Delete My Profile</a>
		  <a class="dropdown-item" onclick="showCart()" <?php if($username == "none")echo "hidden";?>>View Cart</a>
		<a class="dropdown-item" href="#" onclick="logoutRequest()" <?php if($username == "none")echo "hidden";?>>Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <br>
      <div class="container-fluid">

        <div class="section" id="products_modal">

         <div class="container" id="products_container">
          <!-- all products come here-->

        </div>
      </div>


	<section id="cart-modal" style="display:none;background-color:white;">

  <!--Grid row-->
  <div class="row">

    <!--Grid column-->
    <div class="col-lg-8">

      <!-- Card -->
      <div class="mb-3">
      	 <div class="modal-header">
<button class="btn" onclick="showCart()"><i class="fa fa-arrow-left"></i></button>
          <h4 class="modal-title align-right">Products in your Cart....</h4>
          <button type="button" class="close" onclick="showCart()">&times;</button>
        </div>
        <div class="pt-4 wish-list" id="cart-container">


        	<!-- cart products come here-->
        

        </div>
      </div>
      <!-- Card -->
      <div class="mb-3">
        <div class="pt-4">

          <h5 class="mb-4">We accept</h5>

          <img class="mr-2" width="45px"
            src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
            alt="Visa">
          <img class="mr-2" width="45px"
            src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
            alt="American Express">
          <img class="mr-2" width="45px"
            src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
            alt="Mastercard">
          <img class="mr-2" width="45px"
            src="https://mdbootstrap.com/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png"
            alt="PayPal acceptance mark">
        </div>
      </div>
      <!-- Card -->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-4">

      <!-- Card -->
      <div class="mb-3 mr-4">
        <div class="pt-4">
          <h5 class="mb-3">The total amount of</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
              Total Price : 
              <span id="cart_total">$0</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
              Shipping
              <span></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
              <div>
                <strong>The total amount of</strong>
                <strong>
                  <p class="mb-0">(including VAT 15%)</p>
                </strong>
              </div>
              <span><strong id="cart_total_final">$0</strong></span>
            </li>
          </ul>

          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#place_order-modal">go to checkout</button>

        </div>
      </div>
    </div>
    <!--Grid column-->

  </div>
  <!-- Grid row -->

</section>


 <div class="toast" id="myToast" style="position: absolute; top: 100px; right: 0; min-width: 300px;">
  <div class="toast-header" >
     <strong class="mr-auto" id="toast_header">Toast Header</strong>
      <small>Just Now</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="toast-body" id="toast_body">
    Some text inside the toast body
  </div>
</div>



    </div>
    <!-- /#page-content-wrapper -->


 </div>
<!--change profile -->


  <div class="modal fade" id="change-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title align-right">User Profile</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

         <form>

<div class="alert alert-success" role="alert" id="done_change" style="display:none">
  Changes Saved
</div>

<div class="alert alert-danger" role="alert" id="wrong_change" style="display:none">
  This is a danger alert—check it out!
</div>
            
            <div class="form-group row">
              <div class="col">

                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>
                  <input type="text" class="form-control" id="change_firstname" placeholder="First name"  disabled>
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>
                  <input type="text" class="form-control" id="change_lastname" placeholder="Last name" disabled>
                </div>
              </div>
            </div>

            <div class="form-group row" >
              <div class=" col" hidden>

               <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" id="change_password" placeholder="New Password">
              </div>
            </div>

            <div class="col" hidden>
             <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-lock"></i></div>
              </div>
              <input type="password" class="form-control" id="change_password_confirm" placeholder="Confirm New Password">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Phone Number</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-phone"></i></div>
            </div>
            <input type="number" class="form-control" id="change_phone-number" placeholder="Phone Number" disabled>
          </div>
        </div>
<div class="form-check ml-4">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
  <label class="form-check-label" for="flexCheckChecked">
    Subscribe To Mailing List
  </label>
</div>May not work because cs.tru.ca doesnt support PHPMailer<br>
	<div id="change_modal_address">
<label>Addresses</label>
                <div class="form-group">
              <div class="input-group mb-2">
                
</div></div>
</div>
                <div class="form-group text-center"><a class="btn" onclick="addAnotherAddress('change_modal_address')">Add More Address? <i class="fa fa-plus"></i></a></div>

        <div class="form-group text-center">
          <a class="btn btn-primary" onclick="change_request()" hidden>Save Changes</a>
        </div>

      </form>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>


  <!-- /#wrapper -->
   <div class="modal fade" id="wishlist-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title align-right">Your Wishlist</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
  <table class="table">
    <thead>
      <tr>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Add to Cart?</th>
      </tr>
    </thead>
    <tbody id="wishlist_table_body">


    </tbody>
  </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  </div>
  <!-- /#wrapper -->

 <div class="modal fade" id="delete_profile-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title align-right">Delete Profile</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


          <form>
<label>Sorry that you feel this way, Please specify why leaving ?</label>
<div class="alert alert-warning" id="done_delete_profile" role="alert" >
 Warning : This can't be Undone
</div>


<div class="form-group">
              <div class="input-group mb-2">
                
  <textarea class="form-group form-control" rows="5" id="comment_delete_profile" placeholder= "Please specify Any reason :-(  (Optional)"></textarea>

</div></div>         

            <div class="form-group text-center">
              <a class="btn btn-primary" onclick="delete_profile()" >Submit</a>
            </div>

          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- contanct us -->

 <div class="modal fade" id="contact_us-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title align-right">Contact Us</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


          <form>
<div class="alert alert-danger" id="wrong_contact_us" role="alert" style="display:none">
  Enter Something  
</div>
<div class="alert alert-success" id="done_contact_us" role="alert" style="display:none">
  Thanks for Contacting us!, Will reply soon  
</div>
            <div class="form-group">
              <label>Query Type</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">@</div>
                </div>
<select class="form-select form-control" aria-label="Default select example">
  <option value="1">Product Query</option>
  <option value="2">Payment Query</option>
  <option value="3">Website Defect</option>
</select>
</div></div>

<div class="form-group">
              <div class="input-group mb-2">
                
  <textarea class="form-group form-control" rows="5" id="comment_contact" placeholder= "Fire up your queries here! :-)"></textarea>

</div></div>         

            <div class="form-group text-center">
              <a class="btn btn-primary" onclick="submit_query()" >Submit</a>
            </div>

          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<!-- PLACE ADDRESS modal -->



<div class="modal fade" id="place_order-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title align-right">Finalize Payment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


          <form>
<div class="alert alert-danger" id="wrong_order_us" role="alert" style="display:none">
 Payment Failed !
</div>
<div class="alert alert-success" id="done_order_us" role="alert" style="display:none">
  Thanks for Shopping with us! :-)  
</div>
            <div class="form-group">
              <label>Select From Your Addresses</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-address-card"></i></div>
                </div>
<select class="form-select form-control" id="address_selector" aria-label="Default select example">

  
</select>
</div></div>

<div class="form-group">
 <label>Select Bank</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-credit-card"></i></div>
                </div>
 <select class="form-select form-control"  aria-label="Default select example">

<option value="1">Canadian Imperial Bank of Commerce (CIBC)</option>
<option value="1">Bank of Montreal (BMO)</option>
<option value="1">Bank of Nova Scotia (Scotiabank)</option>
<option value="1">Royal Bank of Canada (RBC)</option>
<option value="1">Toronto-Dominion Bank (TD) </option>  
</select>



</div></div>         
<h5>Total Amount of :<span id="cart_total_final_bank"></span></h5><br><br>


            <div class="form-group text-center">
              <a class="btn btn-primary" onclick='document.getElementById("done_order_us").style.display="block";' >Submit</a>
            </div>

          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>




<!-- PLACE ADDRESS END -->

  <!-- Modal -->
  <div class="modal fade" id="signup-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title align-right">New user? Please Signup....</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <div id="signup-form"></div>

          <form >

<div class="alert alert-danger" role="alert" id="wrong_signup" style="display:none">
  This is a danger alert—check it out!
</div>
            <div class="form-group">
              <label>Email address</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">@</div>
                </div>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
              </div>
            </div>

            <div class="form-group row">
              <div class="col">

                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>
                  <input type="text" class="form-control" id="firstname" placeholder="First name">
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                  </div>
                  <input type="text" class="form-control" id="lastname" placeholder="Last name">
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class=" col">

               <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" id="password" placeholder="Password">
              </div>
            </div>

            <div class="col">
             <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-lock"></i></div>
              </div>
              <input type="password" class="form-control" id="password_confirm" placeholder="Confirm Password">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Phone Number</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-phone"></i></div>
            </div>
            <input type="number" class="form-control" id="phone-number" placeholder="Phone Number">
          </div>
        </div>

<div class="form-check ml-4">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
  <label class="form-check-label" for="flexCheckChecked">
    Subscribe To Mailing List
  </label>
</div><br>
	<div id="signup_modal_address">
<label>Addresses</label>
		<div class="form-group">
              <div class="input-group mb-2">
                
  <textarea class="form-group form-control" rows="2" name="new_address" placeholder= "Enter Address"></textarea>
</div></div>
</div>
		<div class="form-group text-center"><a class="btn" onclick="addAnotherAddress('signup_modal_address')">Add More Address? <i class="fa fa-plus"></i></a></div>
        <div class="form-group text-center">
          <a class="btn btn-primary" onclick="signup_request()" >Sign Up</button>
          <a href="#" class="btn ml-0 pl-0" data-toggle="modal" data-target="#login-modal" style="color:blue;"id="signin_switch" data-dismiss="modal">or Sign in </a>
        </div>

      </form>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>

 <div class="modal fade" id="login-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title align-right">Welcome Back? Please Login....</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


          <form>

<div class="alert alert-danger" id="wrong_login" role="alert" style="display:none">
  Incorrent Login or Password
</div>
            <div class="form-group">
              <label>Email address</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">@</div>
                </div>
                <input type="email" class="form-control" id="email_login" placeholder="Enter email">
              </div>
            </div>

            <div class="form-group">
              <label>Password</label>
               <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" id="password_login" placeholder="Password">
              </div>


            <div class="form-group text-center">
              <a class="btn btn-primary" onclick="login_request()" >Login</a>
              <a href="#" class="btn ml-0 pl-0" data-toggle="modal" data-target="#signup-modal" style="color:blue;"id="signin_switch" data-dismiss="modal">or Sign up </a>
            </div>

          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<!-- Bootstrap core JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="/~tanyaw21/boutique/index_boutique.js"></script>


</body>

</html>

