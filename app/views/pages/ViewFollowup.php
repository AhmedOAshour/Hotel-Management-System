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
    <h2>Followup Reports</h2>
    <a href="followup.php?type=$otherType">View $otherType</a>
    <div id="viewFollowups">
      <table>
        <thead>
          <tr>
            <th><strong>ID</strong></th>
            <th><strong>Date</strong></th>
            <th><strong>Reading</strong></th>
            <th><strong>Photo</strong></th>
            <th><strong>Entered By</strong></th>
            <th><strong>Delete</strong></th>
            <th><strong>View</strong></th>
          </tr>
        </thead>
        <tbody>
    EOD;
        foreach ($followups as $followup) {
          $str .= <<<EOD
          <tr>
            <td>$followup->id</td>
            <td>$followup->date</td>
            <td>$followup->reading</td>
            <td>$followup->photo</td>
            <td>$followup->entryBy</td>
            <td><a href="followup.php?id=$followup->id&action=view&type=$type">View</a></td>
            <td><a href="followup.php?id=$followup->id&action=delete&type=$type">Delete</a></td>
          </tr>
          EOD;
        }
    $str .= <<<EOD
        </tbody>
      </table>
      <br>
    </div>
    <a href="followup.php?action=addform"><button type="button" class="button" id="addBtn">Add Followup </button></a>
    EOD;
    echo $str;
  }

  public function followupForm(){
    $str=<<<EOD
    <h3>Followup</h3>
    <div id="followupForm">
    <form class="followupForm" method="post" enctype = "multipart/form-data">
        <input type="date" name="date" class="form form-control mb-4 border-0 py-4"><br>
        <input type="text" name="comment" placeholder="comments..." class="form form-control mb-4 border-0 py-4"><br>
        <label class='followup' for='type'>Type</label>
        <select name="type" id="type">
          <option value="electricity">Electricity</option>
          <option value="water">Water</option>
        </select><br>
        <input type="file" id="myfile" name="myfile"><br>
        <button type="submit" name="action" value="submitForm">Submit</button>
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
