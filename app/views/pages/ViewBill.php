<?php
class ViewBill extends View{
public function output(){

}
public function read($id){
    $items=$this->model->readBill($id);
    $str =
    <<<EOD
            <div class="container">
            <h1>Bill Items</h1>
            <div id="viewEmployees">
            <table>
                <thead>
                <tr>
                    <th style='text-align:center'><strong>Item</strong></th>
                    <th style='text-align:center'><strong>Price</strong></th>
                    <th style='text-align:center'><strong>Delete</strong></th>
                    
                </tr>
                </thead>
                <tbody>
    EOD;
        foreach ($items as $item) {
          $str .= <<<EOD
          <tr>
            <td style='text-align:center'>$item[Item]</td>
            <td style='text-align:center'>$item[Price]</td>
            <td style='text-align:center'><a class="color" href="bills.php?action=delete&itemid=$item[ID]&id=$id"><i class='fa fa-trash'></i></a></td>
          </tr>
          EOD;
        }
    $str .= <<<EOD
        </tbody>
      </table>
      <br>
    </div>
    <form>
    <input class="formE form-control border-3" type="text" name="id" value='$id' hidden>
    <button type="submit" name="action" value="addform" class="button2" id="addBtn">Add Item</button>
    </form>
    EOD;
    echo $str;

}
public function addForm($id){

  $str=
  <<<EOD
      <div class="container">
      <div id="createClient">
      <h1>Add bill item</h1>
      <form>
      <input class="formE form-control border-3" type="text" name="item" id="item"  placeholder="Item Name..." required>
      
      <input class="formE form-control border-3" type="text" name="price" id="price"  placeholder="Price.."required>
      <input class="formE form-control border-3" type="text" name="id" value='$id' hidden>
      <input type="submit" class="button2" name="action" value="add" id="submitBtn"">
      </form>
      </div>
  </div>
  </div>
  EOD;
echo $str;

}

}



?>