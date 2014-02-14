<?
class Controller_Json extends Controller_Template{

public $template = 'json/json';

public function action_index () {
	$sql = new Model_Datasql;
	$sql->json_add($this->request->query('id'));
	echo json_encode($this->request->query('id'));
}

}

?>