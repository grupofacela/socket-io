<?php

	use Workerman\Worker;
	use PHPSocketIO\SocketIO;

	require_once '../vendor/autoload.php';

	// SSL context
	$context = array(
	    'ssl' => array(
	        'local_cert'  => '/your/path/of/server.pem',
	        'local_pk'    => '/your/path/of/server.key',
	        'verify_peer' => false
	    )
	);
	$io = new SocketIO(8080, $context);

	$io->on('connection', function ($connection) use ($io) {
	    echo "New connection coming\n";
	});

	Worker::runAll();