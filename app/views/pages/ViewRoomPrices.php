<?php
class ViewRoomPrices extends View{
  public function output(){
    $prices = $this->model->readPrices();
    $str = <<<EOD
      <div class="container">
      <h1>Manage Room Price</h1>
      <table>
      <thead>
        <th style='text-align:center'>Room Type</th>
        <th style='text-align:center'>Price</th>
        <th style='text-align:center'>Edit</th>
      </thead>
      <tbody>
    EOD;
    if ($prices) {
      foreach ($prices as $type => $price) {
        $str .= <<<EOD
        <tr>
        <td style='text-align:center'>$type</td>
        <td style='text-align:center'>$price</td>
        <td style='text-align:center'><a class="color"href="roomprices.php?action=editform&type=$type"><i class='fa fa-edit'></i></a></td>
        </tr>
        EOD;
      }
    }
    $str .= <<<EOD
      </tbody>
    </table>
    <a href="roomprices.php?action=addform"><button class="button2">Add</button></a>
    EOD;
    echo $str;
  }

  function addForm(){
    $str = <<<EOD
    <div class="container">
    <form method="POST">
      <h1>Add Room price</h1>
      <h4 class="words">Room Type</h4>
      <select name="room_type" class="formE form-control border-3"required>
        <option value="single">Single</option>
        <option value="double">Double</option>
        <option value="triple">Triple</option>
        <option value="family">Family</option>
        <option value="suite">Suite</option>
      </select><br>
      <h4 class="words arr">Price</h4>
      <input type="number" name="price" value="1.00" min="1" step="0.01" class="formE form-control border-3" required><br>
      <button type="submit" name="action" class="button2" value="add">Submit</button>
    </form>
    EOD;
    echo $str;
  }

  function editForm($type){
    $str = <<<EOD
    <div class="container">
    <form method="POST">
      <h1>Edit Room price</h1>
      <h4 class="words">Room Type</h4>
      <select class="formE form-control border-3" name="room_type">
        <option value="$type">$type</option>
      </select><br>
      <h4 class="words arr">Price</h4>
      <input type="number" class="formE form-control border-3" name="price" value="1.00" min="1" step="0.01" required><br>
      <button type="submit" name="action" class="button2"value="edit">Submit</button>
    </form>
    EOD;
    echo $str;
  }

}

?>
