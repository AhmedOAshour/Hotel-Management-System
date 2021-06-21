<?php 
class MaintenanceController extends Controller{
    public function insert(){
        $errors=array();
        $malfunction_no=$_REQUEST['malfunction_no'];
        $date=$_REQUEST['date'];
        $materials_bought=$_REQUEST['materials_bought'];
        $cost_of_materials=$_REQUEST['cost_of_materials'];
        $technician_name=$_REQUEST['technician_name'];
        $work_done=$_REQUEST['work_done'];
       

        if($temp=validDate($date)){
          $errors['date']=$temp;
        }
        if($temp=notEmpty($materials_bought)){
          $errors['materials_bought']=$temp;
          
                  }
        if($temp=notEmpty($cost_of_materials)){
          $errors['cost_of_materials']=$temp;
                     }
        if($temp=validName($technician_name)){
         $errors['technician_name']=$temp;
                                 }
         if($temp=validName($work_done)){
          $errors['work_done']=$temp;
          }
          if(count($errors)==0){
            $this->model->insert($malfunction_no,$date,$materials_bought,$cost_of_materials,$technician_name,$work_done);
        
        return false;
            }
            else{
             
              return $errors;
            }
                 
        
        }
        

}