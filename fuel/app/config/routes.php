<?php
return array(
	'_root_'  => 'oguhouse/public/articles/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	'articles/(:num)' => 'articles/index/$1',
);