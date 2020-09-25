<?php

	use Workerman\Worker;
	use PHPSocketIO\SocketIO;
	require_once '../vendor/autoload.php';

	// Listen port 2021 for socket.io client
	$io = new SocketIO(3000);
	$io->on('connection', function ($socket) use ($io) {
		$id_user;
	    $socket->on('changeRoom', function ($id) use ($io) {
	    	echo "Se obtuvo el ID: ".$id;
	        $id_user = $id;
	        $io->join($id_user);
	    });
	    // $socket->on('reload', function ($msg) use ($io) {
	    // 	$io->to($id_user)->emit("message", "reload");
	    // });
	});

	Worker::runAll();
