<?php
function validEmail($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
return "invalid email";

    }
    else if($email==""){
        return "Email field can't be empty";
    }
    else{
return false;
    }
}
 function validPassword($password){
    $checkNumeric=true;
    $checkSpecial=true;
    $checkEmpty=true;
    for($i=0;$i<strlen($password);$i++)
    {
      if(is_numeric($password[$i]))
      {
        $checkNumeric=false;
      }
    }
  
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password))
        {
          $checkSpecial=false;
         
        }
        if($password!=""){
            $checkEmpty=false;
        }
        if($checkNumeric==true||$checkSpecial==true||$checkEmpty==true){
            return "Password should be atleast 8 chars in length & should contain <br> atleast 1 uppercase letter , 1 number , and one special char";


        }
        else return false;


}
 function validName($name){
    if($name==""){
        return "Name field can't be empty";
        
        }
        $checkNumeric=true;
   
        
        for($i=0;$i<strlen($name);$i++)
            {
              if(is_numeric($name[$i]))
              {
                $checkNumeric=false;
              }
            }
            if($checkNumeric==false){
      return "Names cannot contain numbers";
        
            }

else return false;

}
 function validId($id){
    if(filter_var($id,FILTER_VALIDATE_INT)){
return false;

    }
    else if($id==""){
        return "ID field can't be empty";
    }
    else return "IDs must be integers";

}
 function validDate($date){
    
    $test_date  = explode('-', $date);
   
    if (checkdate($test_date[1], $test_date[2], $test_date[0])) {
        return "";
    }
    else if($date=""){
        return "Date field can't be empty";
    }
    else return "invalid date";

}
 function validRoomNo($roomno){
    $checkCount=true;
    $checkNumeric=true;
    for($i=0;$i<strlen($roomno);$i++)
    {
      if(is_numeric($roomno[$i]))
      {
        $checkNumeric=false;
      }
    }
    if(strlen($roomno)==3){
        $checkCount=false;
    }
    if($checkNumeric==true || $checkCount==true){

        return "Room Number should be an integer of 3 numbers";
    }
    else return false;


}
function validPosition($position){
    $check=false;
        $positions = array(0 => 'front_clerk', 'admin', 'HK_employee');
    for($i=0;$i<count($positions);$i++){
    if($position==$positions[$i]){
    $check=true;
    }
    }
    if($check==false){
    return "Enter valid position";
    }
    else return false;
    
    
    
    
    }
 function validRoomType($roomtype){
$check=false;
    $roomtypes = array(0 => 'Single',1=> 'Double', 2=>'Triple',3=>'Suite',4=>'Family');
for($i=0;$i<count($roomtypes);$i++){
if($roomtype==$roomtypes[$i]){
$check=true;
}
}
if($check==false){
return "Room type should be one of the five room types: Single,Double,Triple,Suite,Family";
}
else return "";




}
 function validRoomStatus($status){
$check=false;
$roomstatus=array(0=>'Available','Unavailable');
for($i=0;$i<len($roomtypes);$i++){
    if($status==$roomstatus[$i]){
    $check=true;
    }
    }
    if($check==false){
    return "Room status should be :Available,Unavailable";
    }
    else return false;

}
 function validMobileNo($mobileno){
     
if(strlen($mobileno)!=11){
return "Invalid Mobile number , must be 11 digits";

}
else if($mobileno[0]!='0'||$mobileno[1]!='1'){
 return "Invalid Mobile number , mobile number must start with 01";
}
else if(!preg_match('/^[0,1,2,5]*$/', $mobileno[2])) {

    return "Invalid number";
    
    }
    else if($mobileno==""){

return "Mobile Number field can't be empty";
    }
    else return false;



}
function notEmpty($string){
if($string==""){
return "Cannot be empty";

}
else return "";

}
function validUsername($username){

    if(preg_match('/^[a-zA-Z0-9]+/', $username)){
        return "";

    }
    else return "Username cannot contain symbols";
}
function validInt($int){
    if(filter_var($int,FILTER_VALIDATE_INT)==false){
        return "Invalid Integer";
        
            }
            else if($int==""){
                return "This field can't be empty";
            }
            else{
        return false;
            }

}

?>