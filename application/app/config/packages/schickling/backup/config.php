<?php

// on windows: 'C:\\...\\mysql\\bin\\'
// on linux: '/usr/bin/'
// on MAC: '/Applications/MAMP/Library/bin/'

return array(
	'path' => storage_path() . '/backup/',

	'mysql' => array(
		'dump_command_path' => '/usr/bin/',
		'restore_command_path' => '/usr/bin/',
		//'dump_command_path' => 'C:\\...\\mysql\\bin\\',
		//'restore_command_path' => 'C:\\...\\mysql\\bin\\',
	),

	's3' => array(
		'path' => ''
	),

    	'compress' => true,
);

