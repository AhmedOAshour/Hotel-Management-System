function showEmployees() {
  var elements = document.getElementsByClassName("form");
  var formData = new FormData();
  for (var i = 0; i < elements.length; i++) {
    formData.append(elements[i].name, elements[i].value);
  }
  formData.append('q', 'view');
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("rTable").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("POST","php/employees.php",true);
  xmlhttp.send(formData);

}

function addEmployee(){
  if (!validateAdd()) {
    return;
  }
  var elements = document.getElementsByClassName("form");
  var formData = new FormData();
  for (var i = 0; i < elements.length; i++) {
    formData.append(elements[i].name, elements[i].value);
    console.log(elements[i].name+" "+elements[i].value);
  }
  formData.append('q', 'add');
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      view_add();
      showEmployees();

    }
  }
  xmlhttp.open("POST","php/employees.php",true);
  xmlhttp.send(formData);

}

function editEmployee(id){
  window.location = "editE.php?id=" + id;

}

function deleteEmployee(id){
  var formData = new FormData();
  formData.append('ID', id);
  formData.append('q', 'del');
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      showEmployees();
    }
  }
  xmlhttp.open("POST","php/employees.php",true);
  xmlhttp.send(formData);
}

function validateAdd(){
  var position = document.getElementById("position").value;
  var password = document.getElementById("password").value;
  var fname = document.getElementById("Fname").value;
  var lname = document.getElementById("Lname").value;
  var username = document.getElementById("username").value;

  var errors = "";
  var flag = false;
  var lowerCaseLetters = /[a-z]/g;
  if (fname == "") {
    errors = errors.concat("Please Enter a First Name\n");
    flag = true;
  }
  if (lname == "") {
    errors = errors.concat("Please Enter a Last Name\n");
    flag = true;
  }
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var lowerCaseLetters = /[a-z]/g;

  if(!password.match(lowerCaseLetters)) {
    errors = errors.concat("Password must include lower case letters\n");
    flag = true;
  }
  var upperCaseLetters = /[A-Z]/g;
  if(!password.match(upperCaseLetters)) {
    errors = errors.concat("Password must include upper case letters\n");
    flag = true;
  }
  var numbers = /[0-9]/g;
  if(!password.match(numbers)) {
    errors = errors.concat("Password must include numbers\n");
    flag = true;
  }
  var special = /[$-/:-?{-~!"^_`\[\]]/g;
  if(!password.match(special)) {
    errors = errors.concat("Password must include special characters\n");
    flag = true;
  }
  if(password.length < 8 || password.length > 255) {
    errors = errors.concat("Password must be at least 8 characters and maximum 255 characters\n");
    flag = true;
  }
  if(username.length > 20) {
    errors = errors.concat("username must be shorter than 20 characters\n");
    flag = true;
  }
  if (flag) {
    alert(errors);
    return false;
  }
   return true;

}

function view_add(){
  var add = document.getElementById("addEmployees");
  // var edit = document.getElementById("editEmployees");
  var view = document.getElementById("viewEmployees");
  var btn = document.getElementById("addBtn");
  // if (add.style.display === "none" && edit.style.display === "none") {
  if (add.style.display === "none") {
    add.style.display = "block";
    view.style.display = "none";
    btn.innerHTML = "View Employees"
    var fname = document.getElementById("Fname").value = "";
    var lname = document.getElementById("Lname").value = "";
    var password = document.getElementById("password").value = "";
  }

  else {
    add.style.display = "none";
    view.style.display = "block";
    btn.innerHTML = "Add Employee"
  }
}
