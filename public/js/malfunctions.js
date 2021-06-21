function searchMalfunction() {
  var bar = document.getElementById("bar").value;
  var elements = document.getElementsByClassName("data");
  var formData = new FormData();
  for (var i = 0; i < elements.length; i++) {
    formData.append(elements[i].name, elements[i].value);
  }
  formData.append('bar', bar);
  formData.append('q', 'view');
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("rTable").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("POST","malfunctions.php",true);
  xmlhttp.send(formData);
}
