<style>
    .add{
        position: relative;
        left:450px;
    }
</style>
<?php
class ViewMaintenance extends View{
public function output(){
  $result=$this->model->readLogs();
  $str=<<<EOD
  <body>
  <h1>Maintenance</h1>
  <div class="container">
      <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
          <thead>
              <tr>
                  <th style='text-align:center'><strong>Description</strong></th>
                  <th style='text-align:center'><strong>Date</strong></th>
                  <th style='text-align:center'><strong>Materials Bought</strong></th>
                  <th style='text-align:center'><strong>Cost of materials</strong></th>
                  <th style='text-align:center'><strong>Technician name</strong></th>
                  <th style='text-align:center'><strong>Work Done</strong></th>
              </tr>
  EOD;
  if ($result) {
    while($row = mysqli_fetch_array($result)) {
      $str.=<<<EOD
      <tr>
      <td style='text-align:center'>$row[description]</td>
      <td style='text-align:center'>$row[MDate]</td>
      <td style='text-align:center'>$row[materials_bought]</td>
      <td style='text-align:center'>$row[cost_of_materials]</td>
      <td style='text-align:center'>$row[technician_name]</td>
      <td style='text-align:center'>$row[work_done]</td>
      EOD;
    }
  }
  else {
    $str.=<<<EOD
    <tr><td>No Results<td><tr>
    EOD;
  }
    $str.=<<<EOD
        </tr>
      </thead>
      <tbody id="rTable">
      </tbody>
    </table>
    </div>
    </body>
    <form>
    <br>
    <button type="submit" name="action" class="button add" value="addpage">Add Maintenance Entry</button>
    </form>
    EOD;
    echo $str;
}
public function addform($malfunction_no){
$str=<<<EOD
    <div class="container">
    <form>
    <h1>Maintenance</h1>
    <textarea name='materials_bought' rows="1" cols="80" class="formE form-control  py-4 "placeholder="Materials bought seperated by ," required></textarea>
    <textarea name="cost_of_materials" rows="1" cols="80" class="formE form-control  py-4 "placeholder="cost of materials seperate by  , respectively" required></textarea>
    <input type='date' class="formE form-control mb-1 py-4 "name='date'required>
    <input type="text" name="malfunction_no" class="formE form-control mb-1 py-4 "value="$malfunction_no"  id="malfunction_no" hidden>
    <input type="text" name="technician_name"  class="formE form-control mb-1 py-4 "placeholder="Please enter technician name" id="technician_no" required>
    <input type="text" name="work_done"  class="formE form-control mb-1 py-4 "placeholder="Describe the work done" id="work_done" required>
    <button type="submit" name="action" class="button2"value="insert">Insert Entry</button>
    </form>
    </div>
    EOD;
    echo $str;
}


}

?>
