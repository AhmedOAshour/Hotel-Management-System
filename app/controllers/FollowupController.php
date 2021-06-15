<?php
class followupController extends Controller{
  public function insert() {
		$date = $_REQUEST['date'];
    $comment = $_REQUEST['comment'];
    $file = $_FILES['myfile']['name'];
    $type = $_REQUEST['type'];

		$this->model->insert($date, $comment, $file, $type);
	}

	public function delete(){
    $id = $_REQUEST['id'];
    $type = $_REQUEST['type'];
		$this->model->deleteFollowup($id, $type);
	}
}
?>
