<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class ProbationNotification extends Notification
{
    use Queueable;

    protected $employeeFName;
    protected $employeeLName;
    protected $probationEndDate;

    public function __construct($employeeFName, $employeeLName, $probationEndDate)
    {
        $this->employeeFName = $employeeFName;
        $this->employeeLName = $employeeLName;
        $this->probationEndDate = $probationEndDate;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $daysLeft = Carbon::now()->diffInDays($this->probationEndDate);

        return (new MailMessage)
                    ->line('The probation period for  ' . $this->employeeFName  . $this->employeeLName . ' will end in ' . $daysLeft . ' days.')
                    ->action('View Employees', url('/employee-list'))
                    ->line('Thank you');
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
