<style>
  #myfile{
    background-color:#000026;
    color:white;
  }
  .w3-blue{
    background-color:#000026 !important;
  }
  .cards{
    position:relative;
    left:334px;
  }
  #followupForm{
    position:relative;
    left:150px;
  }
  .image{
    border-radius:25px;
  }
  .data{
    position:relative;
    right:50px;
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
            <th style='text-align:center'><strong>Comment</strong></th>
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
    $date="";
    $type="";
    $file="";

    if(isset($_SESSION['errors'])){
      $errors=$_SESSION['errors'];

      if(isset($errors['date'])){
        $date=$errors['date'];
     }
      if(isset($errors['type'])){
        $type=$errors['file'];
    }
  }

    $str=<<<EOD
    <div class="container">
    <h1>Add Followup</h1>
    <div id="followupForm">
    <form class="followupForm" method="post" enctype = "multipart/form-data">
        <input type="date" name="date" class="formE form-control mb-4 border-0 py-4" required><br>
        <h5 class="errors">$date</h5>
        <input type="text" name="comment" placeholder="Reading..." class="formE form-control mb-4 border-0 py-4" required><br>
        <label class='followup' for='type'></label>
        <select class="formE form-control mb-4 border-0 " name="type" id="type" required>
        <option selected value="electricity">Electricity</option>
        <option value="water">Water</option>
        </select><br>
        <h5 class="errors">$type</h5>
        <input class="formE form-control mb-4 border-0 py-4"type="file" id="myfile" name="myfile"style="height:65px" required><br>
        <h5 class="errors">$file</h5>
        <button class="button2"type="submit" name="action" value="submitForm">Submit</button>
      </form>
    </div>
    EOD;
    echo $str;
  }

  public function viewFollowup($id, $type){
    $this->model->test();
    $followup = $this->model->readFollowup($id, $type);
    $str=<<<EOD
      <div class="container">
          <h1>Follow Up</h1><br>
          <div class="w3-card-4 cards" style="width:40%;">
          <header class="w3-container w3-blue">
              <h1>$id</h1>
          </header>
          <div class="w3-container" id="followupForm">
            <img class="image"src="./images/$followup[3]" alt="photo" width="100" height="100"><br>
            <h4 class="data"><b>Date: </b>$followup[1]<br></h4>
            <h4 class="data"><b>Reading: </b>$followup[2]<br></h4>
            <h4 class="data"><b>Entry By: </b>$followup[4]<br></h4>
          </div>
        </div>
    EOD;
    echo $str;
  }
}
?>
