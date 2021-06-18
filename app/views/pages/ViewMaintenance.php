<?php
class ViewMaintenance extends View{
public function output(){
    $result=$this->model->readLogs();
    $str=
<<<EOD
                <body>
                <div class="container mt-3">
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


    while($row = mysqli_fetch_array($result)) {
     
    
        $str.=
        <<<EOD
                <tr>
                <td>$row[description]</td>
                <td>$row[MDate]</td>
                <td>$row[materials_bought]</td>
                <td>$row[cost_of_materials]</td>
                <td>$row[technician_name]</td>
                <td>$row[work_done]</td>
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
                <button type="submit" name="action" value="addpage">Add Maintenance Entry</button>
                </form>
    EOD;
                        
    echo $str;



}
public function addform($malfunction_no){
$str=<<<EOD



    <form>
    <textarea name='materials_bought' rows="3" cols="23" placeholder="Materials bought seperated by ," required></textarea>
    <textarea name="cost_of_materials" rows="3" cols="23" placeholder="cost of materials seperate by  , respectively" required></textarea> </br>
    Date: <input type='date' name='date'required>
    <input type="text" name="malfunction_no" value="$malfunction_no"  id="malfunction_no" hidden>
    <input type="text" name="technician_name"  placeholder="Please enter technician name" id="technician_no" required>
    <input type="text" name="work_done"  placeholder="Describe the work done" id="work_done" required>
    <button type="submit" name="action" value="insert">Insert Entry</button>
    </form>

    EOD;
    echo $str;
}

    
}

?>