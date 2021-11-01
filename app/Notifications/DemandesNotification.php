<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandesNotification extends Notification
{
    use Queueable;

    protected $first_name;
    protected $last_name;
    protected $type_demande;
    protected $notification_time;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($first_name, $last_name, $type_demande, $notification_time)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->type_demande = $type_demande;
        $this->notification_time = $notification_time;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'type_demande' => $this->type_demande,
            'notification_time' => $this->notification_time,
        ];
    }
}
