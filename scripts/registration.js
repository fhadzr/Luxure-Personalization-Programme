function valName(){
	var name = document.getElementById("fullname").value;
	// Example: John Tan
	var regexp = /^[A-Za-z]+( [A-Za-z]+)*$/;
	
	if(!regexp.test(name)){
		if (confirm("Please enter a valid name!") == true) {
			document.getElementById("fullname").value = '';
		}
	}
}

function valEmail() {
    var emailElement = document.getElementById("email");
    var email = emailElement.value;

    var regexp = /^[A-Za-z][\w.-]*@[a-zA-Z\d.-]+(\.[a-zA-Z]{2,3}(\.[a-zA-Z]{2,3})?)?$/;

    if (!regexp.test(email)) {
        if (confirm("Please enter a valid email!")) {
            emailElement.value = ''; // Clear the email input field
        }
	}
}

function valPass(){
	var pwd = document.getElementById("password").value;
	var regexp = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])[\w!@#$%^&*()_+ ]{6,}$/;

	
	if(!regexp.test(pwd)){
		if (confirm("Please enter a valid password! Min 6 character with least one uppercase letter, at least one digit, and at least one special symbol") == true) {
			document.getElementById("password").value = '';
		}
	}
}

function valRPass(){
	var pwd = document.getElementById("password").value;
	var repeat_password = document.getElementById("repeat_password").value;

	if(pwd != repeat_password){
		if (confirm("Password doesnt match!") == true) {
			document.getElementById("password").value = '';
			document.getElementById("repeat_password").value = '';
		}
	}
}

function valAdd(){
	var address = document.getElementById("address").value;
	var regexp = /^[A-Za-z0-9\s\.,#-]+$/;
	
	if(!regexp.test(address)){
		if (confirm("Please enter a valid address!") == true) {
			document.getElementById("address").value = '';
		}
	}
}