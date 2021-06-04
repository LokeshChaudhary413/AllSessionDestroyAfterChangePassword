setInterval(function(){
	checkUserStatus();
},50000);
function checkUserStatus(){
	jQuery.ajax({
		url:'../sql/check_status.php',
		success:function(result){
			// console.log(result);
			var result=result.trim();
			if(result!=1){
				alert('Due to password changed, Your session has expired, Please login with new password')
				window.location.href='../sql/logout.php';
				
			}
		}
	});
}

// Login 


function clearErrors(){
	$('#email_error,#password_error').html('')
	$('#name,#email,#password').css('border', '1px solid lightgray')
}

function login(e){
	e.preventDefault();
	clearErrors();

	var error = false;
	
	var email = $('#email').val();
	if (email == "") {
		$('#email').css('border', '1px solid red');
		error = true;
	}
	var password = $('#password').val();
	if (password == "") {
		$('#password').css('border', '1px solid red');
		error = true;
	}
	
	if(!error){
		// console.log('formSubmitted')
		$.ajax({
			url: 'sql/login_access.php',
			type: "POST",
			data: {
				email : email,
				password : password,
			},
			success: function(result) {
				console.log(result)
					if (result == 'email') {
						$('#email_error').text('Email is not registered')
					}else if( result == 'password'){
						$('#password_error').text('Wrong Password');
					}else{
						$('#msg').text('Permission Granted');
						window.location.href = "AdminTemplate/dashboard.php"
					}
				}
			});

	}

}

// Registration

function emailValidate(email){
    var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (reg.test(email) == false) {
        return false;
    }
   return true;
} 

function passValidate(password){ 
    var reg =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/ ;
    if (reg.test(password) == false) {
		$('#password_error1').text('Format : Test@123')
        return false;
    }
   return true;
} 

function register(e) {
    e.preventDefault();

    clearErrors();

    var error = 0;
    var email = $('#email').val();
    if(email == ""){
        $('#email').css('border','1px solid red')
        error = 1;
    }else if(!emailValidate(email)){
        $('#email_error').text("email is invalid")
        error = 1
    }
    var name = $('#name').val();
    if(name == ""){
        $('#name').css('border','1px solid red')
        error = 1;
    }
    var password = $('#password').val();
    if(password == ""){
        $('#password').css('border','1px solid red')
        error = 1;
    }else if(!passValidate(password)){
        $('#password_error').text("Format: Test@123 & min-length = 8");
        error = 1;
    }
    console.log(error)
    if(!error){
        $.ajax({
        url: 'sql/registration.php',
        type: 'post',
        data: $("#resgistration").serialize(),
        success: function(result){
			console.log(result)
			if (result == 'alreadyPresent') {
				$('#email_error').text('Email already registered')
			}else{
				$('#msg').text('Permission Granted');
				window.location.href = "index.php"
			}
        }
        })
    }
}


