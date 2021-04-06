
  var product_maker_string='<div class="col-sm-3 mt-2" style="max-width:500px; min-width:200px;"><div class="card" ><img src="/~tanyaw21/boutique/product_images/{pid}.jpg" class="card-img-top" alt="..." style="max-height:250px"><div class="card-body text-center"><h5>{name}</h5><p class="small text-muted text-uppercase mb-2">{category}</p><hr><h6 class="mb-3"><span class="text-danger mr-1">${price}</span><span class="text-grey"><s>${discount_price}</s></span></h6><button type="button" id="{pid}" class="btn btn-primary btn-sm mr-1 mb-2" onclick="addToCart(this.id)"> <i class="fa fa-shopping-cart pr-2"></i>Add to cart</button><button type="button" class="btn btn-light btn-sm mr-1 mb-2" id="{pid}", onclick="addToWishlist(this.id)"><i class="fa fa-info-circle pr-2"></i>Add to Wishlist</button> </div></div></div>'
  var cart_item_string='<!--starting row of cart -->   <div class="row mb-4"><div class="col-md-6 col-lg-3 col-xl-3"> <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0"><img class="img-fluid w-50" src="/~tanyaw21/boutique/product_images/{pid}.jpg" alt="Sample"></div> </div> <div class="col-md-7 col-lg-9 col-xl-9"><div><div class="d-flex justify-content-between"> <div><h5>{name}</h5>	<h6>Category : Casual Wear</h6><h6>Price Per Piece : ${price}</h6></div><div><div class="def-number-input number-input safari_only mb-0 w-100"><button onclick="this.parentNode.querySelector(\'input[type=number]\').stepDown();removeFromCart(this.id);" id="{pid}" class="minus decrease"><i class="fa fa-minus"></i></button> <input class="quantity" min="0" name="quantity" id="{pid}-inpu" value="{quantity}" type="number"><button onclick="this.parentNode.querySelector(\'input[type=number]\').stepUp();addToCart(this.id)" class="plus" id="{pid}"><i class="fa fa-plus"></i></button> </div>  <small id="passwordHelpBlock" class="form-text text-muted text-center"> (Enter Quantity) </small> </div>  </div> <div class="d-flex justify-content-between align-items-center">  <div>  <a href="#!" type="button" class="card-link-secondary small text-uppercase" id="{pid}" onclick="addToWishlist(this.id)"><i  class="fas fa-heart mr-1"></i> Move to wish list </a> </div> <p class="mb-0"><span><strong id="summary">${total_price}</strong></span></p class="mb-0"> </div> </div> </div> </div>  <hr class="mb-4">  <!--ending row of cart -->'
 var wishlist_table_string='<tr><td><img style="width:40px;height:40px;" src="product_images/{pid}.jpg"></img></td><td>{name}</td><td><button id="{pid}" class="btn btn-primary" onclick="removeFromWishlist(this.id);addToCart(this.id);">Move To Cart</button></td><td><button type="button" class="close" id="{pid}" onclick="removeFromWishlist(this.id)">&times;</button></td></tr>'
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });

  $.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"StartPage", "command":"getAllProducts"}, 
    success: function(response) {  
       // alert(response);  
       makeProductTabs(response)
       console.log(response[0])
       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });

  function login_request(){
  		var email=$('#email_login').val();
  		var password=$('#password_login').val();

  		console.log("Sending Login Request" + email+ ", " + password);

  		$.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"login", "email" :email,"password" :password}, 
    success: function(response) {  

       console.log(response)
	if(response.result=="Access Denied"){
$("#myToast").toast({delay : 2000});
$('#toast_header').html("Login Failed")
$('#toast_body').html("Username Or Password Incorrect");
$("#myToast").toast('show');
	document.getElementById('wrong_login').style.display='block';
}
else
	location.reload();
       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });

  }


  function signup_request(){
  		var email=$('#email').val();
  		var username=$('#firstname').val()+$('#lastname').val()
  		var password=$('#password').val();
  		var password_confirm=$('#password_confirm').val();
  		var phone_number=$('#phone-number').val();
		var first_name=$('#firstname').val();
  		var address=document.getElementsByName('new_address');
	var finalAddressString="";
	console.log(address);
	
	for (x in address){
		console.log(address[x].value);		
		if(address[x].value!=undefined)	
	finalAddressString=finalAddressString+address[x].value+":";
	}

	console.log(finalAddressString);		
		
	console.log("Sending Signup Request : " + email+ ", " + password);

	if(password!=password_confirm){
		 document.getElementById("wrong_signup").style.display = "block";
                $("#wrong_signup").html("Passwords Doesn't match");
	}else if(!email.includes('@')||!email.includes('.')){
		document.getElementById("wrong_signup").style.display = "block";
                $("#wrong_signup").html("Invalid Email");
	}else if(password.length<6){
		 document.getElementById("wrong_signup").style.display = "block";
                $("#wrong_signup").html("Password Must be atleast 6 Characters Long");
	}else if(phone_number.length<10){
		 document.getElementById("wrong_signup").style.display = "block";
                $("#wrong_signup").html("Invalid Phone Number");
	}else if(first_name.length<2){
		 document.getElementById("wrong_signup").style.display = "block";
                $("#wrong_signup").html("Enter Valid First Name");
	}else if(finalAddressString.lenght<2){
			 document.getElementById("wrong_signup").style.display = "block";
                $("#wrong_signup").html("Enter Atleast one Address");
	}else{
  		$.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"adduser", "email" :email,"password" :password, "name" : username, "phone_number" : phone_number, 'first_name' : first_name, "address": finalAddressString}, 
    success: function(response) {  

       console.log(response)
	if(response.result=="Added")
		location.reload();
	else{
		document.getElementById("wrong_signup").style.display = "block";
		$("#wrong_signup").html("Email Already Exists");
	}

       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });
	}
 }

  function makeProductTabs(products){
    var i=0;

    for(x in products){
      if(i%4==0)
        $('#products_container').append(' <div class="row"></div>')

      console.log("Found" + products[x].name)
      $('#products_container').children().last().append(generateProductTab(products[x], product_maker_string))
      i++;
    }

  }
  function generateProductTab(product, string_to_make){
   var thiString=string_to_make.slice();
   thiString=thiString.replace("{name}", product.name)
   thiString=thiString.replace("{price}", product.price)
   thiString=thiString.replace("{discount_price}", product.discount_price)
  // thiString=thiString.replace("{pid}", product.pid)
thiString=thiString.replace("{quantity}", product.quantity)
  // thiString=thiString.replace("{pid}", product.pid)
   thiString=thiString.replaceAll("{pid}", product.pid)
   thiString=thiString.replace("{category}", product.category)
   thiString=thiString.replace("{total_price}", product.total_price)
   return thiString;
 }

	function logoutRequest(){
  $.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"logout"}, 
    success: function(response) {  

       console.log(response)
       location.reload();

       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });

 }

	function addToCart(button_id){
//console.log("clicked")
console.log(button_id);
  $.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"add_to_cart", "pid": button_id}, 
    success: function(response) {  

       console.log(response)
//       location.reload();
if(response.result=="Denied"){


$("#myToast").toast({delay : 2000});
$('#toast_header').html("Please Login To Continue")
$('#toast_body').html(" <a href='#'' class='btn ml-0 pl-0' data-toggle='modal' data-target='#login-modal' style='color:blue;'id='signin_switch' data-dismiss='modal'> Sign in </a>")
$("#myToast").toast('show');

}else
{
$("#myToast").toast({delay : 2000});
$('#toast_header').html("Product Added to Cart")
$('#toast_body').html("<a class='dropdown-item' onclick='showCart()'' >View Cart</a>")
$("#myToast").toast('show');


}

  getAllFromCart();
       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });

 }


function addToWishlist(button_id){

console.log(button_id);
  $.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"add_to_wishlist", "pid": button_id}, 
    success: function(response) {  


if(response.result=="Denied"){


$("#myToast").toast({delay : 2000});
$('#toast_header').html("Please Login To Continue")
$('#toast_body').html(" <a href='#'' class='btn ml-0 pl-0' data-toggle='modal' data-target='#login-modal' style='color:blue;'id='signin_switch' data-dismiss='modal'> Sign in </a>")
$("#myToast").toast('show');

}else
{
$("#myToast").toast({delay : 2000});
$('#toast_header').html("Product Added to Wishlist")
$('#toast_body').html("<a class='dropdown-item'  data-toggle='modal' data-target='#wishlist-modal' >View Wishlist</a>")
$("#myToast").toast('show');

getAllFromWishlist();
}

       console.log(response)

       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });



}

function removeFromCart(button_id){
//console.log("clicked")
console.log(button_id);
  $.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"remove_from_cart", "pid": button_id}, 
    success: function(response) {  

       console.log(response)
//       location.reload();
//	console.log($("#"+button_id+"-inpu").val());
//	if($("#"+button_id+"-inpu").val()==0){
//		console.log("Found");
//		getAllFromCart();
//	}
	getAllFromCart();
       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });

 }

function removeFromWishlist(button_id){


  $.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"remove_from_wishlist", "pid": button_id}, 
    success: function(response) {  

       console.log(response)

        getAllFromWishlist();
       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });


}
 function showCart() {
  var x = document.getElementById("cart-modal");
  if (x.style.display === "none") {
    document.getElementById("products_modal").style.display = "none";
    $('#cart-modal').css({
    "opacity":"0",
    "display":"block",
}).show().animate({opacity:1})
    //x.style.display = "block";
  } else {
    x.style.display = "none";
 //   document.getElementById("products_modal").style.display = "block";
     $('#products_modal').css({
    "opacity":"0",
    "display":"block",
}).show().animate({opacity:1})
  }
}
function getAllFromWishlist(){
$.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"get_all_from_wishlist"}, 
    success: function(response) {  
		console.log("Wishlist")
       console.log(response)
	$('#wishlist_table_body').empty();
	if(response.result=="Wishlist Empty"){
	$('#wishlist_table_body').append("<td></td><td><h4>Wishlist is Empty</h4></td>");
	}else
	for(x in response){
	 $('#wishlist_table_body').append(generateProductTab(response[x], wishlist_table_string))
	}

	if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });




}
function getAllFromCart(){
 $.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"get_my_cart"}, 
    success: function(response) {  
	console.log("cart");
       console.log(response)
//       location.reload();
$('#cart-container').empty();
var TotalPrice=0;
if(response.result=="Cart Empty"){
	 $('#cart-container').append("<h4>Cart Empty<h4>");
}else	
for(x in response){
		TotalPrice=TotalPrice+response[x].price*response[x].quantity;
		response[x].total_price=response[x].price*response[x].quantity;
		 $('#cart-container').append(generateProductTab(response[x], cart_item_string));
}
console.log(TotalPrice);
$('#cart_total').html("$"+(TotalPrice));
$('#cart_total_final').html("$"+(TotalPrice+TotalPrice*15/100));
$('#cart_total_final_bank').html("$"+(TotalPrice+TotalPrice*15/100));
       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });


}
function submit_query(){
//$("#done_contact_us")
if($('#comment_contact').val().length<3)
 document.getElementById('wrong_contact_us').style.display='block';
else{
 document.getElementById('wrong_contact_us').style.display='none';
 document.getElementById('done_contact_us').style.display='block';
}
}

function getMyself(){

 $.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"get_myself"}, 
    success: function(response) {  

	if(response.result=="Access Denied"){

	}else{
       console.log(response)
	$('#change_firstname').val(response[0].first_name);
	$('#change_lastname').val(response[0].name.replace(response[0].first_name, ""));
	$('#change_phone-number').val(response[0].phone_number)
//        getAllFromWishlist();
	
	var addresses=response[0].del_address.split(":");
	console.log("Got addresses");
	console.log(response[0].del_address.split(":"))
	for(x in addresses){
	console.log(addresses[x]);
	if(addresses[x]!="")	{
		$('#change_modal_address').append("<textarea class='form-group form-control' rows='2' name='new_address' placeholder= 'Enter Address'>"+ addresses[x]+"</textarea>");	
		$("#address_selector").append("<option value=\""+addresses[x]+"\">"+addresses[x]+"</option>");
		}
	}


       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
	}
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });
}


function addAnotherAddress(div_id){

$('#'+div_id).append( "<textarea class='form-group form-control' rows='2' name='new_address' placeholder= 'Enter Address'></textarea>");

}

function delete_profile(){


$.ajax({
    type: 'POST', 
    url: "/~tanyaw21/boutique/controller.php",
    data : {"page":"users", "command":"delete_profile"}, 
    success: function(response) {  

       console.log(response)
	location.reload();
//        getAllFromWishlist();
       if (response != null && response.d != null) {  
        alert(response.d);  
      }  
    },  
    error: function(XMLHttpRequest, textStatus, errorThrown) {  
      console.log(errorThrown)
      alert('error'); 
    }
  });



}
getAllFromCart();
getAllFromWishlist();
getMyself();
