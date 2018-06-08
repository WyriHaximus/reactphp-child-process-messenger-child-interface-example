<?php

use React\EventLoop\Factory as EventLoopFactory;
use WyriHaximus\React\ChildProcess\Messenger\Messages\Factory as MessagesFactory;
use WyriHaximus\React\ChildProcess\Messenger\Messages\Payload;
use WyriHaximus\React\ChildProcess\Pool\Factory\CpuCoreCountFlexible;
use WyriHaximus\React\ChildProcess\Pool\PoolInterface;

require 'vendor/autoload.php';

$loop = EventLoopFactory::create();

CpuCoreCountFlexible::createFromClass(Example::class, $loop)->done(function(PoolInterface $pool) {
    $pool->rpc(
        MessagesFactory::rpc('return', ['message' => 'does not work'])
    )->done(function (Payload $result) use ($pool) {
        echo "Done.\n";
        print_r($result);
        $pool->terminate(MessagesFactory::message(['bye']));
    });
});

$loop->run();
