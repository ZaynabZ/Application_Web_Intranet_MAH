<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;
use Carbon\Carbon;


class NewDocumentPosted extends Notification
{
    use Queueable;
    protected $user ;
    protected $type;
    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($filename , $typi , User $user)
    {
        $this->type = $typi ;
        $this->user = $user ;
        $this->filename = $filename ;
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
        $date = Carbon::now();
        $date->toDateString();;


        return [
            'typ' => 'newfile',
           'first' => $this->user->last_name, 
            'last' => $this->user->first_name ,
            'date' =>  $date,
            'type' => $this->type ,
            'filename' => $this->filename 
        ];
    }
}
