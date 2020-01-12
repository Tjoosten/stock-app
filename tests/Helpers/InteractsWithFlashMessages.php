<?php

namespace Tests\Helpers;

use Illuminate\Support\Collection;
use Laracasts\Flash\Message;

trait InteractsWithFlashMessages
{
    protected function flashMessages(): Collection
    {
        return $this->app['session']->get('flash_notification');
    }

    protected function flashMessagesForLevel(string $level)
    {
        return $this->flashMessages()->filter(function (Message $message) use ($level) {
            return $message->level === $level;
        });
    }
}
