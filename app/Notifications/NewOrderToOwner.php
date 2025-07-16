<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;
use App\Models\Order;

class NewOrderToOwner extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    /**
     * Get the Telegram representation of the notification.
     */
    public function toTelegram(object $notifiable)
    {
        $appUrl = config('app.url');
        $orderUrl = $appUrl . '/admin/orders/' . $this->order->id;
        // $orderUrl = url('/admin/orders/' . $this->order->id);
        $grandTotal = number_format($this->order->grand_total, 2);

        return TelegramMessage::create()
            ->to($notifiable->routes['telegram'])
            ->content("*🎉 មានការបញ្ជាទិញថ្មីមួយ!*") // 🎉 New Order Received!
            ->line("")
            ->line("*លេខការបញ្ជាទិញ:* `" . $this->order->id . "`") // Order ID
            ->line("*អតិថិជន:* " . $this->order->address->full_name) // Customer
            ->line("*លេខទូរស័ព្ទ:* " . $this->order->address->phone) // Phone Number
            ->line("*ចំនួនសរុប:* $" . $grandTotal) // Total Amount
            ->line("")
            ->button('មើលព័ត៍មានការបញ្ជាទិញ', $orderUrl); // View Order Details
    }
}
