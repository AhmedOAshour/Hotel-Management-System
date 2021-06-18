<style>
  #myfile{
    background-color:#000026;
    color:white;
  }
</style>
<?php
class ViewFollowup extends View{
  public function outputFollowups($type){
    $followups = $this->model->readFollowups($type);
    $otherType;
    if ($type == "water") {
      $otherType = "electricity";
    }
    else {
      $otherType = "water";
    }
    ucwords($otherType);
    $str =
    <<<EOD
    <div class="container">
    <h1>Followup Reports</h1>

    <div id="viewFollowups">
    
      <table>
        <thead>
          <tr>
            <th style='text-align:center'><strong>ID</strong></th>
            <th style='text-align:center'><strong>Date</strong></th>
            <th style='text-align:center'><strong>Reading</strong></th>
            <th style='text-align:center'><strong>Photo</strong></th>
            <th style='text-align:center'><strong>Entered By</strong></th>
            <th style='text-align:center'><strong>View</strong></th>
            <th style='text-align:center'><strong>Delete</strong></th>
          </tr>
        </thead>
        <tbody>
    EOD;
        if (isset($followups)) {
          foreach ($followups as $followup) {
            $str .= <<<EOD
            <tr>
              <td style='text-align:center'>$followup->id</td>
              <td style='text-align:center'>$followup->date</td>
              <td style='text-align:center'>$followup->reading</td>
              <td style='text-align:center'>$followup->photo</td>
              <td style='text-align:center'>$followup->entryBy</td>
              <td style='text-align:center'><a class="color" href="followup.php?id=$followup->id&action=view&type=$type"><i class="fa fa-eye"></i></a></td>
              <td style='text-align:center'><a class="color" href="followup.php?id=$followup->id&action=delete&type=$type"><i class='fa fa-trash'></i></a></td>
            </tr>
            EOD;
          }
        }


    $str .= <<<EOD
        </tbody>
      </table>
      <br>
      <a href="followup.php?type=$otherType"><button type="button" class="button2">View $otherType </button></a><br>
      <a href="followup.php?action=followupForm"><button type="button" class="button2" id="addBtn">Add Followup </button></a>
      </div>
    EOD;
    echo $str;
  }

  public function followupForm(){
    $str=<<<EOD
    <div class="container"> 
    <h1>Add Followup</h1>
    <div id="followupForm">
    <form class="followupForm" method="post" enctype = "multipart/form-data">
        <input type="date" name="date" class="formE form-control mb-4 border-0 py-4" required><br>
        <input type="text" name="comment" placeholder="comments..." class="formE form-control mb-4 border-0 py-4" required><br>
        <label class='followup' for='type'></label>
        <select class="formE form-control mb-4 border-0 py-4" name="type" id="type">
        
        <option value="Task">Task</option>
        <option value="electricity">Electricity</option>
          <option value="water">Water</option>
        </select><br>
        <input class="formE form-control mb-4 border-0 py-4"type="file" id="myfile" name="myfile"style="height:65px" required><br>
        <button class="button2"type="submit" name="action" value="submitForm">Submit</button>
      </form>
    </div>
    EOD;
    echo $str;
  }

  public function viewFollowup($id){
    $str=<<<EOD
    <h3>Followup number $id</h3>
    <div id="followupForm">

    </div>
    EOD;
    echo $str;
  }
}
?>
