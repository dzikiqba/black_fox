<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-02-10 03:35:23 --- CRITICAL: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\classes\Controller\index.php [ 24 ] in C:\project\black_fox\application\classes\Controller\index.php:24
2014-02-10 03:35:23 --- DEBUG: #0 C:\project\black_fox\application\classes\Controller\index.php(24): Kohana_Core::error_handler(8, 'Trying to get p...', 'C:\project\blac...', 24, Array)
#1 C:\project\black_fox\system\classes\Kohana\Controller.php(84): Controller_Index->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 C:\project\black_fox\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#4 C:\project\black_fox\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 C:\project\black_fox\system\classes\Kohana\Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 C:\project\black_fox\index.php(118): Kohana_Request->execute()
#7 {main} in C:\project\black_fox\application\classes\Controller\index.php:24
2014-02-10 03:35:59 --- CRITICAL: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\classes\Controller\index.php [ 24 ] in C:\project\black_fox\application\classes\Controller\index.php:24
2014-02-10 03:35:59 --- DEBUG: #0 C:\project\black_fox\application\classes\Controller\index.php(24): Kohana_Core::error_handler(8, 'Trying to get p...', 'C:\project\blac...', 24, Array)
#1 C:\project\black_fox\system\classes\Kohana\Controller.php(84): Controller_Index->action_index()
#2 [internal function]: Kohana_Controller->execute()
#3 C:\project\black_fox\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#4 C:\project\black_fox\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 C:\project\black_fox\system\classes\Kohana\Request.php(986): Kohana_Request_Client->execute(Object(Request))
#6 C:\project\black_fox\index.php(118): Kohana_Request->execute()
#7 {main} in C:\project\black_fox\application\classes\Controller\index.php:24
2014-02-10 03:57:11 --- CRITICAL: ErrorException [ 1 ]: Maximum execution time of 30 seconds exceeded ~ MODPATH\database\classes\Kohana\Database\MySQL.php [ 186 ] in file:line
2014-02-10 03:57:11 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2014-02-10 04:04:24 --- CRITICAL: Database_Exception [ 1054 ]: Unknown column 'inst_id' in 'order clause' [ SELECT * FROM `inst_id` ORDER BY `inst_id` DESC LIMIT 20 OFFSET 0 ] ~ MODPATH\database\classes\Kohana\Database\MySQL.php [ 194 ] in C:\project\black_fox\modules\database\classes\Kohana\Database\Query.php:251
2014-02-10 04:04:24 --- DEBUG: #0 C:\project\black_fox\modules\database\classes\Kohana\Database\Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT * FROM `...', false, Array)
#1 C:\project\black_fox\application\classes\Model\datasql.php(33): Kohana_Database_Query->execute()
#2 C:\project\black_fox\application\classes\Controller\index.php(36): Model_Datasql->getPagList(Object(Pagination))
#3 C:\project\black_fox\system\classes\Kohana\Controller.php(84): Controller_Index->action_index()
#4 [internal function]: Kohana_Controller->execute()
#5 C:\project\black_fox\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Index))
#6 C:\project\black_fox\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 C:\project\black_fox\system\classes\Kohana\Request.php(986): Kohana_Request_Client->execute(Object(Request))
#8 C:\project\black_fox\index.php(118): Kohana_Request->execute()
#9 {main} in C:\project\black_fox\modules\database\classes\Kohana\Database\Query.php:251