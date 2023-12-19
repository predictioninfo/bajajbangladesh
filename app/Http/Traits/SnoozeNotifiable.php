<?php

// declare(strict_types=1);


namespace App\Http\Traits;

use DateTimeInterface;
use Illuminate\Notifications\Notification;
use Thomasjohnkane\Snooze\Exception\SchedulingFailedException;
use App\Models\User;

Trait SnoozeNotifiable
{
    /**
     * @param  Notification  $notification
     * @param  DateTimeInterface  $sendAt
     * @param  array  $meta
     * @return ScheduledNotification
     *
     * @throws SchedulingFailedException
     */
    public function notifyAt()
    {
        return User::create($this, $notification, $sendAt, $meta);
    }
}
