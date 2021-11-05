$(document).ready(function(){
	
	/*---------- Operation for General Info Form------------*/
	
	$("#general_info_submit").click(function(){
		var name = $("#name").val();
		var email = $("#email").val();
		var confirm_email = $("#confirm_email").val();
		var password = $("#password").val();
		var confirm_password = $("#confirm_password").val();
		var email_filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		// Returns successful data submission message when the entered information is stored in database.
		var dataString = 'name1='+ name + '&email1=' + email+ '&cemail1='+ confirm_email + '&password1='+ password + '&cpassword1='+ confirm_password;
		
		$('#name').on('focus', function() {
		  $(this).css('background-color', '#FFFFFF');
/*		  $('#email').css('background-color', '#FFFFFF');
		  $('#password').css('background-color', '#FFFFFF');*/
		});
		
		$('#email').on('focus', function() {
		  $(this).css('background-color', '#FFFFFF');
		});
		
		$('#confirm_email').on('focus', function() {
		  $(this).css('background-color', '#FFFFFF');
		});
		
		$('#password').on('focus', function() {
		  $(this).css('background-color', '#FFFFFF');
		});
		
		$('#confirm_password').on('focus', function() {
		  $(this).css('background-color', '#FFFFFF');
		});
				
		if(name==''&&email==''&&password=='')
		{
			//alert("Please Fill All Fields");
			$('#name').css('background-color', '#FF6600');
			$('#email').css('background-color', '#FF6600');
			$('#password').css('background-color', '#FF6600');

			document.getElementById('warning-message').innerHTML = '<div class="worning-text">All fields are blank!</div>';
		}
		else if(name==''){
			$('#name').css('background-color', '#FF6600');
			document.getElementById('warning-message').innerHTML = '<div class="worning-text">Name field can\'t be blank</div>';
		}
		else if(email==''){
			//alert('Please provide a valid email address');
			$('#email').css('background-color', '#FF6600');
			document.getElementById('warning-message').innerHTML = '<div class="worning-text">Email address cann\'t be blank!</div>';
		}
		else if(password==''){
			$('#password').css('background-color', '#FF6600');
			document.getElementById('warning-message').innerHTML = '<div class="worning-text">Password can\'t be blank</div>';
		}
		else if(!email_filter.test(email)){
			//alert('Please provide a valid email address');
			$('#email').css('background-color', '#FF6600');
			document.getElementById('warning-message').innerHTML = '<div class="worning-text">Email address is not valid!</div>';
		}
		else if(email != confirm_email) {
			//alert("Email Don't Match");
			$('#confirm_email').css('background-color', '#FF6600');
			document.getElementById('warning-message').innerHTML = '<div class="worning-text">Email Don\'t Match!</div>';			
		}
		else if(password != confirm_password) {
			//alert("Passwords Don't Match");
			$('#confirm_password').css('background-color', '#FF6600');
			document.getElementById('warning-message').innerHTML = '<div class="worning-text">Password Don\'t Match!</div>';	
		}
		else
		{
			// AJAX Code To Submit Form.
			$.ajax({
			type: "POST",
			url: "ajax_general_info_submit.php",
			data: dataString,
			cache: false,
			success: function(result){
					document.getElementById('name').value=null;
					document.getElementById('email').value=null;
					document.getElementById('confirm_email').value=null;
					document.getElementById('password').value=null;
					document.getElementById('confirm_password').value=null;
					
					//alert(result);
					document.getElementById('warning-message').innerHTML = '<div class="worning-text" style="color:green;">Data Inserted successfully</div>';
					//document.getElementById("UploadSuccess").innerHTML="<span>The image has been uploaded</span>";

					window.setTimeout(function() {
				    	window.location.href = 'contact_info.html';
					}, 500);
				}
			});
		}
		return false;
	});
	
	
	/*------ Operation for Contact Info Form-----------*/
	
	$("#contact_info_submit").click(function(){
		var address1 = $("#address1").val();
		var address2 = $("#address2").val();
		var country = $("#country").val();
		var phone = $("#phone").val();
		
		// Returns successful data submission message when the entered information is stored in database.
		var dataString = 'address1='+ address1 + '&address2=' + address2+ '&country='+ country + '&phone='+ phone;
		
		$('#address1').on('focus', function() {
		  $(this).css('background-color', '#FFFFFF');
		});
		
		$('#country').on('focus', function() {
		  $(this).css('background-color', '#FFFFFF');
		});
		
		if(address1==''&&country=="none")
		{
			//alert("Please Fill All Fields");
			$('#address1').css('background-color', '#FF6600');
			$('#country').css('background-color', '#FF6600');
			document.getElementById('warning-message').innerHTML = '<div class="worning-text">Please fill the all mendtory fields.</div>';
		}
		else if(address1==''){
			$('#address1').css('background-color', '#FF6600');
			document.getElementById('warning-message').innerHTML = '<div class="worning-text">Please fill the address fields.</div>';
		}
		else if(country=="none"){
			//alert('Please select an country');
			$('#country').css('background-color', '#FF6600');
			document.getElementById('warning-message').innerHTML = '<div class="worning-text">Please select an country</div>';
		}
		else
		{
			// AJAX Code To Submit Form.
			$.ajax({
			type: "POST",
			url: "ajax_contact_info_submit.php",
			data: dataString,
			cache: false,
			success: function(result){
					document.getElementById('address1').value=null;
					document.getElementById('address2').value=null;
					document.getElementById('country').value="none";
					document.getElementById('phone').value=null;
					//alert(result);
					document.getElementById('warning-message').innerHTML = '<div class="worning-text" style="color:green;">Data Inserted successfully</div>';
				}
			});
		}
		return false;
	});	
	
});