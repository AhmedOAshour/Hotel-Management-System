function checkfName(){
  var fName = document.getElementById("Fname").value;
  const numbers = /[0-9]/g;
  var errorFName = "";

  if (fName != "") {
    if (fName.match(numbers)) {
      errorFName = errorFName.concat("Name cannot contain numbers.");
    }
  }
  document.getElementById("errorName1").innerHTML = errorFName;
}

function checklName(){
  var lName = document.getElementById("Lname").value;
  const numbers = /[0-9]/g;
  var errorLName = "";

  if (lName != "") {
    if (lName.match(numbers)) {
      errorLName = errorLName.concat("Name cannot contain numbers.");
    }
  }
  document.getElementById("errorName2").innerHTML = errorLName;
}

function checkUsername(){
  var username = document.getElementById("username").value;
  var errorUsername = "";

  if (username != "") {
    if (username.length < 4 || username.length > 255) {
      errorUsername = errorUsername.concat("Username must be between 4 and 255 characters.");
    }
  }
  document.getElementById("errorUsername").innerHTML = errorUsername;
}

function checkPassword(){
  var password = document.getElementById("password").value;
  const numbers = /[0-9]/g;
  const upperCaseLetters = /[A-Z]/g;
  const lowerCaseLetters = /[a-z]/g;
  const special = /['^!.£$%&*()}{@#~?><>,|=_+¬-]/g;
  var errorPass = "";

  if (password != "") {
    if (!password.match(numbers)) {
      errorPass = errorPass.concat("Password must contain a number.<br>");
    }

    if (!password.match(upperCaseLetters)) {
      errorPass = errorPass.concat("Password must contain an uppercase letter.<br>");
    }


    if (!password.match(lowerCaseLetters)) {
      errorPass = errorPass.concat("Password must contain an lowercase letter.<br>");
    }


    if (!password.match(special)) {
      errorPass = errorPass.concat("Password must contain an special character.<br>");
    }
  }
  document.getElementById("errorPass").innerHTML = errorPass;
}

function checkConfirmPass(){
  var password = document.getElementById("password").value;
  var cPassword = document.getElementById("cPassword").value;
  var errorCPass = "";

  if (password != cPassword) {
    errorCPass = errorCPass.concat("Passwords must match.<br>");
  }
  document.getElementById("errorCPass").innerHTML = errorCPass;

}
