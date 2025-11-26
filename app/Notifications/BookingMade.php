<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingMade extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private Booking $booking
        )

    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->line("New booking ({$this->booking->amount}) was made for your listing for {$this->booking->start_date}.")
        ->action('See Bookings to confirm or reject', 
        route('owner-rent.show',  ['owner_rent'=> $this->booking->rent_id] )
        )
        ->line('Thank you for using Car-Flex!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
        'booking_id' => $this->booking->id,
        'rent_id' => $this->booking->rent_id,
        'amount' => $this->booking->amount,
        'start_date' => $this->booking->start_date,
        'renter_id' => $this->booking->renter_id
        ];
    }
}
