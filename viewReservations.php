<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">
      function showReservations(){
        var bar = document.getElementById("bar");
        var select = document.getElementById("select");
        var formData = new FormData();
        formData.append('bar', bar.value);
        formData.append('select', select.value);
        formData.append('q', 'show');
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("rTable").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("POST","php/reservations.php",true);
        xmlhttp.send(formData);
      }
    </script>
  </head>
  <body onload="showReservations()">
    <input type="text" id="bar" placeholder="Search..." oninput="showClient()">
    <select id="select" onchange="showClient()">
      <option value="last_name">Last Name</option>
      <option value="identification_no">ID Number</option>
      <option value="company">Company</option>
    </select>
    <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
      <thead>
        <tr>
          <th><strong>First Name</strong></th>
          <th><strong>Last Name</strong></th>
          <th><strong>Nationality</strong></th>
          <th><strong>Room Type</strong></th>
          <th><strong>Room Floor</strong></th>
          <th><strong>Arrival</strong></th>
          <th><strong>Days/Nights</strong></th>
        </tr>
      </thead>
      <tbody id="rTable">
      </tbody>
    </table>
  </body>
</html>
