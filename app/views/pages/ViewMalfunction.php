<?php
class ViewMalfunction extends View{
public function output(){
   $entries= $this->model->readMalfunctions();
    $str=
<<<EOD
                <body>
                <div class="container mt-3">
                    <table width="100%" border="1" style="border-collapse:collapse; margin-top:4px;">
                        <thead>
                            <tr>
                                <th style='text-align:center'><strong>Description</strong></th>
                                <th style='text-align:center'><strong>Entry_By</strong></th>
                                <th style='text-align:center'><strong>Date</strong></th>
                                <th style='text-align:center'><strong>Status</strong></th>
EOD;
                    if(!empty($_GET['flag'])&&$_GET['flag']==true){
    $str.=
<<<EOD
                                <th style='text-align:center'><strong>Create Entry</strong></th>
                            </tr>
                   
EOD;
                    }

foreach ($entries as $entry) {
    $str .= <<<EOD
                                      <tr>
                                    
                                        <td>$entry->description</td>
                                        <td>$entry->entry_by</td>
                                        <td>$entry->date</td>
                                        <td>$entry->is_Archived</td>
    EOD;
                 if(!empty($_GET['flag'])&&$_GET['flag']==true&&$entry->is_Archived=="Pending"){
    $str.=<<<EOD
                                        <td><a href="maintenance.php?action=addform&id=$entry->id">Create Entry</a></td>
                                        
      EOD;
                            }
                            else if(!empty($_GET['flag'])&&$_GET['flag']==true&&$entry->is_Archived=="Archived") {
                                $str.=<<<EOD
                                <td>Handled</td>
                                
EOD;

                            }
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
                <button type="submit" name="action" value="addform">Add Malfunction</button>
                </form>
    EOD;
                        
    echo $str;
}
public function addForm($username){
$str=
<<<EOD
            <body>
            <div class="online py-100">
                    <div class="container pos">
                        <div class="row">
                            <div class="col-lg">
                                <form>
                                    <div class="form">	
                                        <h1 class="head">Malfunctions</h1>
                                        <input type="date"class="forms form-control mb-1 py-4 " name="date" ><br>
                                        <input type="text"class="forms form-control mb-1 py-4 " name="username" value="$username" placeholder="username" hidden><br>
                                        <textarea type="text"class="forms form-control mb-4 "id="fname" name="description" placeholder="Description.."></textarea><br>
                                        <input type="submit"class="inputfile btn w-100 py-3" value="add" name="action">
                                    </div>
                                </form>
                            </div>
                        </div>	
                    </div>
                </div>
            </body>
            </html>

EOD;
echo $str;


}
}

?>