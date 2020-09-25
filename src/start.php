<?php

	use Workerman\Worker;
	use PHPSocketIO\SocketIO;

	require_once '../vendor/autoload.php';

	// SSL context
	$context = array(
	    'ssl' => array(
	        'local_cert'  => '/home/facela_shop_2020/fclntwrkcntndlvrd.com.pem',
	        'local_pk'    => '/home/facela_shop_2020/fclntwrkcntndlvrd.com.key',
	        'verify_peer' => false
	    )
	);
	$io = new SocketIO(8080, $context);

	$io->on('connection', function ($connection) use ($io) {
	    echo "New connection coming\n";
	});

	Worker::runAll();
