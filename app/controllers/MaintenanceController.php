<?php 
class MaintenanceController extends Controller{
    public function insert(){
       
        $malfunction_no=$_REQUEST['malfunction_no'];
        $date=$_REQUEST['date'];
        $materials_bought=$_REQUEST['materials_bought'];
        $cost_of_materials=$_REQUEST['cost_of_materials'];
        $technician_name=$_REQUEST['technician_name'];
        $work_done=$_REQUEST['work_done'];
        $this->model->insert($malfunction_no,$date,$materials_bought,$cost_of_materials,$technician_name,$work_done);
        }
        

}