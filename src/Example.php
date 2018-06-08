<?php

use React\EventLoop\LoopInterface;
use WyriHaximus\React\ChildProcess\Messenger\ChildInterface;
use WyriHaximus\React\ChildProcess\Messenger\Messages\Payload;
use WyriHaximus\React\ChildProcess\Messenger\Messenger;

final class Example implements ChildInterface
{
    /**
     * @param Messenger     $messenger
     * @param LoopInterface $loop
     */
    private function __construct(Messenger $messenger, LoopInterface $loop)
    {
        $messenger->registerRpc('return', function (Payload $payload) {
            return \React\Promise\resolve($payload->getPayload());
        });
    }

    /**
     * @param Messenger     $messenger
     * @param LoopInterface $loop
     */
    public static function create(Messenger $messenger, LoopInterface $loop)
    {
        new static($messenger, $loop);
    }
}
