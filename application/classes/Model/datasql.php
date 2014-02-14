<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Model_Datasql extends Kohana_Model {
	
public function json_add($id) {
	$insta = new Model_Index();
	
try {
		$result = DB::insert('inst_id', array('id_inst', 'object'))
                    ->values(array($id, $insta->_get_media($id)))
                    ->execute();
	}
	catch (Database_Exception $exception) {
         if ($exception->getCode() === 1062) {
     	return null;
         }
	}
	return $result;        	
}

 public function getList() {
		$result = DB::select('*')->from('inst_id')->execute()->as_array();	
		
		if(isset($result))
		foreach($result as $u)
			$ret[$u['id_inst']] = $u['date_in'];
		else return null;
		
return $ret;
	}

 public function getPagList($pagination) {
		$result = DB::select('*')->from('inst_id')->order_by('id_inst', 'DESC')->limit($pagination->items_per_page)->offset($pagination->offset)->execute()->as_array();
		
return $result;
	}

public function count(){
    $result = DB::select('*')
                ->from('inst_id')
                ->execute()
                ->count(); // zwraca ilość elementów
    
    return $result;        
}
	
}
