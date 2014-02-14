<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Read extends Controller_Index {
        
	public function action_index () {

		$sql = new Model_Datasql;
		$inst = new Model_Index();
		
		$tags = $inst ->_get_count_tags();

		 if(is_numeric($this->request->query('max_id')))
		 	$max_id = $this->request->query('max_id');
		else $max_id = 0;
		
		$ret = $inst->_get_data($max_id);
		
		$content = new View('/read/admin');
		
		$content->set('exist', $sql->getList());
        $content->set('data', $ret->data);
        $content->set('pagination', $ret->pagination);
		$content->set('count', $tags);


		
		$this->template->content = $content;
	}    

}