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
    class ViewMaintenance extends View{
    public function output(){
      $result=$this->model->readLogs();
      $str=<<<EOD
      <body>
      <div class="container">
        <div class="row sidebar">
            <div class="col-3 bar">
                <form action="/action_page.php">
                </form>
            </div>
            <div class="col-9 searchbar">
            <input type="text" id="bar" class="search"placeholder="Search by description.." oninput="searchMaintenance()"><i class="fa fa-search"></i>
            </div>
        </div>
      </div>
      <div class="container">
      <h1>Maintenance</h1>
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
        $materials_bought="";
        $cost_of_materials="";
      $dates="";
      $technician_name="";
      $work_done="";
        if(isset($_SESSION['errors'])){
          $errors=$_SESSION['errors'];
        
        
            if(isset($errors['date'])){
                $dates=$errors['date'];
                                        }
              if(isset($errors['materials_bought'])){
                $materials_bought=$errors['materials_bought'];
                      }
                if(isset($errors['work_done'])){
                        $work_done=$errors['work_done'];
                                                }
                if(isset($errors['technician_name'])){
                  $technician_name=$errors['technician_name'];
                                                      }
                      if(isset($errors['cost_of_materials'])){
                        $cost_of_materials=$errors['cost_of_mateirals'];
                                }
      
      
        }
      unset($_SESSION['errors']);
      if(!isset($_SESSION['CID'])){
        $_SESSION['CID']=$malfunction_no;
        }
      $date=date('Y-m-d');
    $str=<<<EOD
        <div class="container">
        <form>
        <h1>Maintenance</h1>
        <textarea name='materials_bought' rows="1" cols="80" class="formE form-control  py-4 "placeholder="Materials bought seperated by ," required></textarea>
        <h5 class="errors">$materials_bought</h5>
        <textarea name="cost_of_materials" rows="1" cols="80" class="formE form-control  py-4 "placeholder="cost of materials seperate by  , respectively" required></textarea>
        <h5 class="errors">$cost_of_materials</h5>
        <input type='date' value="$date" class="formE form-control mb-1 py-4 "name='date'required>
        <h5 class="errors">$dates</h5>
        <input type="text" name="malfunction_no" class="formE form-control mb-1 py-4 "value="$_SESSION[CID]"  id="malfunction_no" hidden>
        <input type="text" name="technician_name"  class="formE form-control mb-1 py-4 "placeholder="Please enter technician name" id="technician_no" required>
        <h5 class="errors">$technician_name</h5>
        <input type="text" name="work_done"  class="formE form-control mb-1 py-4 "placeholder="Describe the work done" id="work_done" required>
        <h5 class="errors">$work_done</h5>
        <button type="submit" name="action" class="button2"value="insert">Insert Entry</button>
        </form>
        </div>
        EOD;
        echo $str;
      // unset($_SESSION['CID']);
    }


    }

    ?>
