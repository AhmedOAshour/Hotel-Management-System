<style>
  .errors{
      color:red;
      position: relative;
      left:270px;
    }
</style>
<?php
class ViewBill extends View{
public function output(){

}
public function read($id){
    $items=$this->model->readBill($id);
    $price = 0;
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
          EOD;
          if (!$item['is_room']) {
            $str.= <<<EOD
            <td style='text-align:center'><a class="color" href="bills.php?action=delete&itemid=$item[ID]&id=$id"><i class='fa fa-trash'></i></a></td>
            EOD;
          }
          $str .= <<<EOD
          </tr>
          EOD;
          $price+=$item['Price'];
        }
    $str .= <<<EOD
    <tr>
    <td style='text-align:center'>Total</td>
    <td style='text-align:center'>$price</td>
    <td></td>
    </tr>
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

public function checkout($id){
  $items=$this->model->readBill($id);
  $price = 0;
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
    EOD;
    if (!$item['is_room']) {
      $str.= <<<EOD
      <td style='text-align:center'><a class="color" href="bills.php?action=delete&itemid=$item[ID]&id=$id"><i class='fa fa-trash'></i></a></td>
      EOD;
    }
    $str .= <<<EOD
    </tr>
    EOD;
    $price+=$item['Price'];
  }
  $str .= <<<EOD
  <tr>
  <td style='text-align:center'>Total</td>
  <td style='text-align:center'>$price</td>
  <td></td>
  </tr>
      </tbody>
    </table>
    <br>
  </div>
  <form action="rooms.php" method="post">
  <input class="formE form-control border-3" type="text" name="id" value='$id' hidden>
  <button type="submit" name="action" value="checkout" class="button2" id="addBtn">Checkout</button>
  </form>
  EOD;
  echo $str;
}

public function addForm($id){
 
  $item="";
  $price="";
  

  if(isset($_SESSION['errors'])){
    $errors=$_SESSION['errors'];
   
      if(isset($errors['item'])){
          $item=$errors['item'];
                                  }
        if(isset($errors['price'])){
          $price=$errors['price'];
                }


  }
unset($_SESSION['errors']);
if(!isset($_SESSION['CID'])){
  $_SESSION['CID']=$id;
  }

  $str=
  <<<EOD
      <div class="container">
      <div id="createClient">
      <h1>Add bill item</h1>
      <form>
      <input class="formE form-control border-3" type="text" name="item" id="item"  placeholder="Item Name..." required>
      <h5 class="errors"$item</h5>
      <input class="formE form-control border-3" type="text" name="price" id="price"  placeholder="Price.."required>
      <h5 class="errors"$price</h5>
      <input class="formE form-control border-3" type="text" name="id" value='$_SESSION[CID]' hidden>
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
