<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Template {

        public $template = 'template/template';
        protected $_title;
        protected $__JS__;
        protected $__CSS__;
        
        public function before(){
            parent::before();
                    
            $this->_title       = 'Instagram';         
            $this->__JS__   = 'public/static/js/';
            $this->__CSS__= 'public/static/css/';
        }

public function action_index()
	{
			$inst = new Model_Index();
			$sql = new Model_Datasql;
			
			$ret = $inst ->_get_count_tags();
			if($ret->meta->code != '200')
			$content = new View('/template/error');   
			else
			{
			$content = new View('/template/page');
			$pagination = Pagination::factory(array( 
  			'total_items'    => $sql->count(), 
  			'items_per_page' => 20, 
            'view'           => 'template/pagination/floating', 
        	));
        	
			$content->set('page_links', $pagination->render());
			$content->set('data',$inst-> _json_obj($sql->getPagList($pagination)));
			$this->template->content = $content;
			}
	}        
	

        public function after(){
            $_script = array($this->__JS__.'jquery-2.1.0.min.js',$this->__JS__.'json.js', $this->__JS__.'jquery.lightbox',
            );
                
            $_style = array($this->__CSS__.'style.css', $this->__CSS__.'jquery.shadow.css'  , $this->__CSS__.'jquery.lightbox',  
            );
    
            $this->template->header = View::factory('template/partial/header');
            $this->template->menu  = View::factory('template/partial/menu');
            $this->template->footer = View::factory('template/partial/footer');
            $this->template->title    = $this->_title;
            $this->template->style   = $_style; 
            $this->template->script  = $_script;   
            
            parent::after();
        }

}