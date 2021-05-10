<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
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
          <th><strong>Identification No.</strong></th>
          <th><strong>Mobile</strong></th>
          <th><strong>E-mail</strong></th>
          <th><strong>Company</strong></th>
        </tr>
      </thead>
      <tbody id="rTable">
      </tbody>
    </table>
  </body>
</html>
