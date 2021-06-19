<?php
class Bill extends Model{
public $id,$reservation_ID,$item,$is_Room,$price;
function __construct($id=""){
    parent::__construct();
    if ($id!="") {
      $sql = "SELECT * FROM bill WHERE ID = $id";
      $result = $this->db->query($sql);
      if ($result->num_rows == 1){
        $row = $this->db->fetchRow();
        $this->id = $row['ID'];
        $this->reservation_ID=$row['reservation_ID'];
    }
    }
}


public function readBills(){
    $sql = "SELECT *, bill.ID as BID FROM bill INNER JOIN bill_items ON bill.ID =bill.bill_ID";
    $result = $this->db->query($sql);
    if ($result->num_rows > 0){
      return $result;
    }
    else {
      return null;
    }
}
public function addItem($id,$item,$price){
    $is_Room=0;
    $sql="INSERT into bill_items (bill_ID,item,is_Room,price) values ('$id','$item','$is_Room','$price')";
    $result = $this->db->query($sql);

}
public function deleteItem($id){
$sql="delete from bill_items where ID='$id'";
$this->db->query($sql);
}

public function readBill($id){
    $info = array();
    $sql = "SELECT *, bill.ID as BID FROM bill INNER JOIN bill_items ON bill.ID =bill_items.bill_ID where bill.ID='$id' AND bill_items.is_Room=0";
    $result = $this->db->query($sql);
  
    while ($row = $this->db->fetchRow()){
    
      array_push($info,array('ID'=>$row['ID'],'Item'=>$row['item'],'Price'=>$row['price']));
      
    }
    return $info;
     
    
  
  }

}

?>