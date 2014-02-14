<?php defined('SYSPATH') OR die('No Direct Script Access');
Class Model_Index extends Kohana_Model
{
  	private $_api_base_url = '';
    private static $_instance;
    private $_client_id;
    private $_client_secret;
    private $_redirect_url;
    private $_scopes = array('basic', 'likes', 'comments', 'relationships');
    private $_access_token;
    private $_session;

    function __construct ()
    {
		$config = Kohana::$config->load('instagram');
        $this->_client_id     = $config['client_id'];
        $this->_client_secret = $config['client_secret'];
        $this->_redirect_url  = $config['redirect_url'];
		$this->_link = $config['api_url']."v1/tags/";
		$this->_link_media = $config['api_url']."v1/media/";
		$this->_tag = $config['tag'];
        $this->_session = Session::instance('cookie');

    }
		

		
	public function _get_count_tags() {
		 
		return $this->_curl($this->_get_count_link($this->_tag));
	}
	
	public function _get_data($max_id) {
		
			return $this->_curl($this->_get_data_link($max_id));
	}
	
	public function _get_media($id) {
				return  $this->_curl($this->_get_media_link($id), '1');
	}
	
	public function _json_obj($date) {
		foreach($date as $v)
			$ret[] = json_decode($v['object']);
	return $ret;	
	}
	
	private function _curl($link, $decode ="") {
 		$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $link);
       	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   		
        $response = curl_exec($curl);
        curl_close($curl);
		if($decode)
        $result = $response; 
		else
		$result = json_decode($response, false);  
		return $result;  		
	}
	
	private function _get_count_link() {
		
		return $this->_link.$this->_tag."/?client_id=".$this->_client_id;
	}

	private function _get_data_link($max_id) {
	//	print_r($max_id);
		return $this->_link.$this->_tag."/media/recent?max_tag_id=".$max_id."&client_id=".$this->_client_id;
	}
	
	private function _get_media_link($id) {
		return 	$this->_link_media.$id."/?client_id=".$this->_client_id;
	}


}
?>