function searchReservation() {
  var bar = document.getElementById("bar").value;
  var formData = new FormData();
  formData.append('bar', bar);
  formData.append('q', 'view');
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("rTable").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("POST","clients.php",true);
  xmlhttp.send(formData);
}
