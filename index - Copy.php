<?php defined('SYSPATH') OR die('No direct script access.');

class Kohana_Instagram {

    
    
    const API_BASE_URL = 'https://api.instagram.com/';

    const API_VERSION = 'v1';

    private static $_instance;

    private $_client_id;

    private $_client_secret;

    private $_redirect_url;

    private $_scopes = array('basic', 'likes', 'comments', 'relationships');

    private $_access_token;

    private $_session;





    /**
     * Use this function to create and get an instance of this class.
     *
     * @return Instagram
     */
    public static function instance ()
    {
        if (self::$_instance === NULL)
        {
            self::$_instance = new Instagram();
        }

        return self::$_instance;
    }




    /**
     * Constructor.
     */
    protected function __construct ()
    {
        $config = Kohana::$config->load('instagram');

        $this->_client_id     = $config['client_id'];
        $this->_client_secret = $config['client_secret'];
        $this->_redirect_url  = $config['redirect_url'];

        $this->_session = Session::instance('cookie');
    }




    /**
     * This function returns the url to login in into instagram.
     *
     * @param array $scope      An array containing the login scope.
     * @return string
     */
    public function login_url ($scope = array('basic'))
    {
        if (is_array($scope) AND count(array_intersect($scope, $this->_scopes)) === count($scope))
        {
            return Instagram::API_BASE_URL . 'oauth/authorize?client_id=' . $this->_client_id . '&redirect_uri=' . $this->_redirect_url . '&scope=' . implode('+', $scope) . '&response_type=code';
        }

        else
        {
            throw new Exception("Invalid scope given!");
        }
    }




    /**
     * Returns TRUE if user is logged in. A user is logged in if an
     * access token is stored in session.
     *
     * @return bool
     */
    public function logged_in ()
    {
        return ($this->get_access_token() !== NULL);
    }




    /**
     * This function is to get an OAuth token from instagram api.
     * If request is successful, the received token can be get by
     * using get_access_token().
     *
     * @param $code     The code you get after a successful login
     *                  as GET parameter at your redirect url.
     *
     * @return bool     Returns TRUE, if OAuth token received, else FALSE.
     */
    public function request_oauth_token ($code)
    {
        $params = array
        (
            'grant_type'      => 'authorization_code',
            'client_id'       => $this->_client_id,
            'client_secret'   => $this->_client_secret,
            'redirect_uri'    => $this->_redirect_url,
            'code'            => $code
        );

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, Instagram::API_BASE_URL . 'oauth/access_token');
        curl_setopt($curl, CURLOPT_POST, count($params));
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response);        

        if (isset($result->access_token))
        {
            $this->set_access_token($result->access_token);
        }

        return isset($result->access_token);
    }




    /**
     * This function is to do request to instagram api for getting data.
     *
     * @param $endpoint         The endpoint of the api to use.
     * @param bool $auth        Set TRUE, if authorization is required for request.
     * @param array $params     An array containing all request parameters.
     *
     * @return mixed            An instance of stdClass containing all response data.
     */
    private function _request_api ($endpoint, $auth = FALSE, $params = array())
    {
        if ($auth === FALSE)
        {
            $params['client_id'] = $this->_client_id;
        }

        else if ($this->get_access_token() !== NULL)
        {
            $params['access_token'] = $this->get_access_token();
        }


        // Create query string containing all GET parameters
        $query_string = empty($params) ? '' : ('?' . http_build_query($params));


        // Create complete API query
        $api_query = Instagram::API_BASE_URL . Instagram::API_VERSION . '/' . $endpoint . $query_string;


        // Setup curl handle
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_query);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);


        // Execute curl request
        $response = curl_exec($curl);

        curl_close($curl);


        // Return JSON decoded response
        return json_decode($response);
    }




    /**
     * Returns the current access token.
     *
     * @return string
     */
    public function get_access_token ()
    {
        if ($this->_access_token === NULL)
        {
            $this->_access_token = $this->_session->get('instagram_access_token');

        }

        return $this->_access_token;
    }




    /**
     * Sets the current access token.
     *
     * @param $access_token
     */
    public function set_access_token ($access_token)
    {
        $this->_access_token = $access_token;

        $this->_session->set('instagram_access_token', $access_token);
    }




    /**
     * This function is to get a users media collection.
     * All media items are stored within an iterator.
     *
     * @param string $id    The id of the user.
     * @param int $limit    The maximum number of media items to request.
     *
     * @return MediaSet     An iterator containing all found medias as instances
     *                      of class MediaItem.
     */
    public function get_user_media ($id = 'self', $limit = 0)
    {
        $response = $this->_request_api('users/' . $id . '/media/recent', TRUE, array('count' => $limit));

        return new MediaSet($response);
    }

}

?>