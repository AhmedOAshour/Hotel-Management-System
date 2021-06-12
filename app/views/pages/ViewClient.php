<?php
class ViewClient extends View{
    public function output(){
        $clients=$this->model->readClients();
        $str = 
        <<<EOD
        
        <div id="client">
        <div id="showClients">
          <input type="text" id="bar" placeholder="Search by..." oninput="showClient()">
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
                <th><strong>Create Reservation</strong></th>
              </tr>
            </thead>
            <tbody id="rTable">
            </tbody>
          </table>
          <button type="button" class="create" onclick="createClient()">Add Client</button>
        </div>
    EOD;
    $first_name,$last_name,$identification_no $nationality, $mobile, $email, $company;
    foreach ($clients as $client) {
        $str .= <<<EOD
        <tr>
       
          <td>$client->first_name</td>
          <td>$client->last_name</td>
          <td>$client->identification_no</td>
          <td>$client->nationality</td>
          <td>$client->mobile</td>
          <td>$client->email</td>
          <td>$client->company</td>
          <td style='text-align:center'><a type='button' class='link'onclick='chooseClient($row[ID])'>Create Reservation</a></td>
          
        </tr>
        EOD;
      }
  $str .= <<<EOD
      </tbody>
    </table>
    <br>
  </div>
  <!-- <button type="button" class="button" id="addBtn" onclick="view_add()">Add Employee</button> -->
  EOD;
}
public addForm(){
    $str=
    <<<EOD
            <div id="createClient">
            <form>
            <input class="formE form-control border-3" type="text" name="first_name" placeholder="First Name...">
            <input class="formE form-control border-3" type="text" name="last_name" placeholder="Last Name...">
            <input class="formE form-control border-3" type="text" name="identification_no" placeholder="Identification Number...">
            <input class="formE form-control border-3" type="text" name="nationality" placeholder="Nationality...">
            <input class="formE form-control border-3" type="text" name="mobile" placeholder="Mobile...">
            <input class="formE form-control border-3" type="text" name="email" placeholder="E-mail...">
            <input class="formE form-control border-3" type="text" name="company" placeholder="Company...">
            <button class="create"type="button" onclick="createClient()">Submit</button>
            <input type="submit" class="create" name="action" value="add" id="submitBtn" onclick="createClient()">
            </form>
            </div>
        </div>

    EOD;


}





}