<?php

namespace Zaikok\Handler;

use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;

abstract class AbstractHandler
{
    protected $bot;
    protected $token;
    protected $messages;

    public function handle(): void
    {
        $multiMessage = new MultiMessageBuilder;
        foreach ($this->messages as $message) {
            $multiMessage->add($message);
        }
        $this->bot->replyMessage($this->token, $multiMessage);
    }

    protected function __construct(LINEBot $bot, string $token, array $messages)
    {
        $this->bot      = $bot;
        $this->token    = $token;
        $this->messages = $messages;
    }
}
