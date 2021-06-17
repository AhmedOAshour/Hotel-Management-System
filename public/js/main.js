function checkAddEdit(){
  var fName = document.getElementById("Fname").value;
  var lName = document.getElementById("Lname").value;
  var password = document.getElementById("password").value;
  var username = document.getElementById("username").value;
  var position = document.getElementById("position").value;

  const numbers = /[0-9]/g;
  const upperCaseLetters = /[A-Z]/g;
  const lowerCaseLetters = /[a-z]/g;
  const special = /['^!.£$%&*()}{@#~?><>,|=_+¬-]/g;

  var errorName1 = "";
  var errorName2 = "";
  var errorPass = "";
  var errorUsername = "";
  var errorPosition = "";

  if (fName != "") {
    if (fName.match(numbers)) {
      errorName1 = errorName1.concat("Name cannot contain numbers.");
      
    }
    else {
      errorName1 = "";
    }
  }
  if (lName != "") {
    if (lName.match(numbers)) {
      errorName2 = errorName2.concat("Name cannot contain numbers.");
      
    }
    else {
      errorName2 = "";
    }
  }

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


  if (username != "") {
    if (username.length < 10 || username.length > 255) {
      errorUsername = errorUsername.concat("Username must be between 10 and 255 characters.");
    }
    else {
      errorUsername = "";
    }
  }
  document.getElementById("errorName1").innerHTML = errorName1;
  document.getElementById("errorName2").innerHTML = errorName2;
  document.getElementById("errorPass").innerHTML = errorPass;
  document.getElementById("errorUsername").innerHTML = errorUsername;
}

function checkNewPass(){
  var password = document.getElementById("newPass").value;
  var cPassword = document.getElementById("cNewPass").value;

  const numbers = /[0-9]/g;
  const upperCaseLetters = /[A-Z]/g;
  const lowerCaseLetters = /[a-z]/g;
  const special = /[$-/:-?{-~!"^_`\[\]]/g;

  var errorPass = "";
  var errorCPass = "";

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

  }

  if (cPassword != "") {
    if (password != cPassword) {
      errorCPass = errorCPass.concat("Passwords must match.")
    }
    else {
      errorCPass = "";
    }
  }
  document.getElementById("errorNewPass").innerHTML = errorPass;
  document.getElementById("errorCNewPass").innerHTML = errorCPass;

}
