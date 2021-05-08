<html>
<form method="post">
<input type='text' name='guest_names'>
<input type='text' name='guest_count'>
<input type='text' name='arrival'>
<input type='text' name='departure'>
<input type='text' name='comments'>
<input type="submit"  name="submit" ></input>
</form>
</html>

<?php
include "classes.php";

$user=new Front_Office();
if(isset($_POST["submit"])){
$user->create_reservation(50,101,$_POST['guest_names'],$_POST['guest_count'],$_POST['arrival'],$_POST['departure'],$_POST['comments']);


}
?>