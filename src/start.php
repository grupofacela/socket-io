<?php

	use Workerman\Worker;
	use PHPSocketIO\SocketIO;
	require_once '../vendor/autoload.php';

	// Listen port 2021 for socket.io client
	// $io = new SocketIO(3000);
	$io = new SocketIO(80);
	$io->on('connection', function ($socket) {
	    $socket->on('changeRoom', function ($room) use ($socket) {
	    	$socket->id_user = $room;
	        $socket->join($socket->id_user);
	    });
	    $socket->on('reload', function ($msg) use ($socket) {
	    	$socket->join($socket->id_user);
	    	$socket->broadcast->emit("message", "reload");
	    });
	});

	Worker::runAll();
