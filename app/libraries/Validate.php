<?php
public function valideEmail($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
return "invalid email";

    }
return "";
public function validePassword($password){
    $checkNumeric=true;
    $checkSpecial=true;
    for($i=0;$i<strlen($password;$i++)
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
        if($checkNumeric==true&&$checkSpecial==true){
            return "Password should be atleast 8 chars in length & should contain <br> atleast 1 uppercase letter , 1 number , and one special char";


        }
        else return "";


}
public function validName($name){
    if (preg_match('/^[0-9]*$/', $name)) 
{
    return "Names cannot contain numbers";
}
else return "";

}
public function validId($id){
    if(filter_var($id,FILTER_VALIDATE_INT)){
return "";

    }
    else return "IDs must be integers";

}




}

?>