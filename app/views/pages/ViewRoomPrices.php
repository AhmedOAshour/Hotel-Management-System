<?php
class ViewRoomPrices extends View{
  public function output(){
    $prices = $this->model->readPrices();
    $str = <<<EOD
      <a href="roomprices.php?action=addform">Add</a>
      <table>
      <thead>
        <th>Room Type</th>
        <th>Price</th>
        <th>Edit</th>
      </thead>
      <tbody>
    EOD;
    if ($prices) {
      foreach ($prices as $type => $price) {
        $str .= <<<EOD
        <tr>
        <td>$type</td>
        <td>$price</td>
        <td><a href="roomprices.php?action=editform&type=$type">Edit</a></td>
        </tr>
        EOD;
      }
    }
    else {
      $str .= "<tr><td>No Results</td></tr>";
    }
    $str .= <<<EOD
      </tbody>
    </table>
    EOD;
    echo $str;
  }

  function addForm(){
    $str = <<<EOD
    <form method="POST">
      <label>Room Type:</label>
      <select name="room_type" required>
        <option value="single">Single</option>
        <option value="double">Double</option>
        <option value="triple">Triple</option>
        <option value="family">Family</option>
        <option value="suite">Suite</option>
      </select><br>
      <label>Price:</label>
      <input type="number" name="price" value="1.00" min="1" step="0.01" required>
      <button type="submit" name="action" value="add">Submit</button>
    </form>
    EOD;
    echo $str;
  }

  function editForm($type){
    $str = <<<EOD
    <form method="POST">
      <label>Room Type:</label>
      <select name="room_type">
        <option value="$type">$type</option>
      </select><br>
      <label>Price:</label>
      <input type="number" name="price" value="1.00" min="1" step="0.01" required>
      <button type="submit" name="action" value="edit">Submit</button>
    </form>
    EOD;
    echo $str;
  }

}

?>
