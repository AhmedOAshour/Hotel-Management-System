<style>
    .add{
        position: relative;
        left:450px;
    }
    .search{
        width:250px;
        border-top: none;
        border-right: none;
        border-left: none;
    }
    .sidebar{
        background-color:white;
        width:100%;
        height:45px;
        margin:0;
        padding-top:10px;
    }
    .bar{
        text-align:left;
    }
    .searchbar{
        text-align:right;
    }
    .left{
        background-color:#EFEBEB;
        width:230px;
        height:790px;
        position: relative;
        top:15px;
        right:15px;
    }
    .errors{
      color:red;
      position: relative;
      left:270px;
    }
</style>
<?php
class ViewMalfunction extends View{
public function output(){
   $date = date('Y-m-d');
   $nextdate = date('Y-m-d',strtotime($date."-7 days"));
   $dateform = <<<EOD
   <div class="col-6 bar">
   <label>From: </label><input onchange="searchMalfunction()" type="date" id="date" name="from" class="data" value="$nextdate">
   <label>To: </label><input onchange="searchMalfunction()" type="date" id="date" name="to" class="data" value="$date"">
   </div>
   EOD;
  $str=<<<EOD
  <body>
  <div class="container">
        <div class="row sidebar">
            <div class="col-6 bar">
            $dateform
            </div>
            <div class="col-6 searchbar">
            <input type="text" id="bar" class="search"placeholder="Search by description.." oninput="searchMalfunction()"><i class="fa fa-search"></i>
            </div>
        </div>
    </div>
  <div class="container">
  <h1>Malfunctions</h1>
      <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
          <thead>
              <tr>
                  <th style='text-align:center'><strong>Description</strong></th>
                  <th style='text-align:center'><strong>Entry_By</strong></th>
                  <th style='text-align:center'><strong>Date</strong></th>
                  <th style='text-align:center'><strong>Status</strong></th>
  EOD;
  if(!empty($_GET['flag'])&&$_GET['flag']==true){
    $str.=<<<EOD
        <th style='text-align:center'><strong>Create Entry</strong></th>
    </tr>
    EOD;
  }
  $str1 = $this->table();
    $str.=<<<EOD
         </tr>
        </thead>
        <tbody id="rTable">
        $str1
        </tbody>
    </table>
    </div>
    </body>
    <form>
    <br>
    <button type="submit" name="action" class="button add"value="addform">Add Malfunction</button>
    </form>
    EOD;

    echo $str;
}

public function table($from="",$to="",$bar="")
{
  $str = <<<EOD
  EOD;
  $entries= $this->model->readMalfunctions($from,$to,$bar);
  if ($entries) {
    foreach ($entries as $entry) {
      $str .= <<<EOD
      <tr>
      <td style='text-align:center'>$entry->description</td>
      <td style='text-align:center'>$entry->entry_by</td>
      <td style='text-align:center'>$entry->date</td>
      <td style='text-align:center'>$entry->is_Archived</td>
      EOD;
      if(!empty($_GET['flag'])&&$_GET['flag']==true&&$entry->is_Archived=="Pending"){
        $str.=<<<EOD
        <td style='text-align:center'><a class="color"href="maintenance.php?action=addform&id=$entry->id"><i class="fa fa-plus-square"></i></a></td>
        EOD;
      }
      else if(!empty($_GET['flag'])&&$_GET['flag']==true&&$entry->is_Archived=="Archived") {
        $str.=<<<EOD
        <td style='text-align:center'>Handled</td>
        EOD;
      }
    }
  }
  else {
    $str.=<<<EOD
    <tr><td>No Results<td><tr>
    EOD;
  }
  return $str;
}

public function addForm($username){
   
    $date="";
    $description="";
  
    if(isset($_SESSION['errors'])){
      $errors=$_SESSION['errors'];
    
     
        if(isset($errors['date'])){
            $date=$errors['date'];
                                    }
          if(isset($errors['description'])){
            $description=$errors['description'];
                  }
  
  
    }
  unset($_SESSION['errors']);
  $date = date('Y-m-d');
$str=<<<EOD
  <div class="container">
              <form>
                  <div class="form">
                      <h1 class="head">Malfunctions</h1>
                      <input type="date"class="formE form-control  py-4 " name="date" value="$date" required><br>
                      <h5 class="errors"$date</h5>
                      <input type="text"class="formE form-control  py-4 " name="username" value="$username" placeholder="username" hidden><br>
                      <textarea type="text"class="formE form-control mb-4 "id="fname" name="description" placeholder="Description.."required></textarea><br>
                      <h5 class="errors"$description</h5>
                      <input type="submit"class="button2" value="Add" name="action">
                  </div>
              </form>
          </div>
EOD;
echo $str;


}
}

?>
