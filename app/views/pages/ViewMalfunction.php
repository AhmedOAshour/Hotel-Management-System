<style>
    .add{
        position: relative;
        left:450px;
    }
</style>
<?php
class ViewMalfunction extends View{
public function output(){
   $entries= $this->model->readMalfunctions();
    $str=
<<<EOD
                <body>
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
    $str.=
<<<EOD
                                <th style='text-align:center'><strong>Create Entry</strong></th>
                            </tr>
                   
EOD;
                    }

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
                <button type="submit" name="action" class="button add"value="addform">Add Malfunction</button>
                </form>
    EOD;
                        
    echo $str;
}
public function addForm($username){
$str=
<<<EOD
            <body>
                    <div class="container">
                                <form>
                                    <div class="form">	
                                        <h1 class="head">Malfunctions</h1>
                                        <input type="date"class="formE form-control  py-4 " name="date" required><br>
                                        <input type="text"class="formE form-control  py-4 " name="username" value="$username" placeholder="username" hidden><br>
                                        <textarea type="text"class="formE form-control mb-4 "id="fname" name="description" placeholder="Description.."required></textarea><br>
                                        <input type="submit"class="button2" value="Add" name="action">
                                    </div>
                                </form>
                            </div>
            </body>
            </html>

EOD;
echo $str;


}
}

?>