<?php

	use Workerman\Worker;
	use PHPSocketIO\SocketIO;
	require_once '../vendor/autoload.php';

	// Listen port 2021 for socket.io client
	$io = new SocketIO(3000);
	$io->on('connection', function ($socket) use ($io) {
	    $socket->on('changeRoom', function ($room) use ($io) {
	        $io->join($room);
	        echo $io->room;
	    });
	    $socket->on('reload', function ($msg) use ($io) {
	    	$io->to($id_user)->emit("message", array(
	            'message' => $socket->username
	        ));
	    });
	});

	Worker::runAll();
