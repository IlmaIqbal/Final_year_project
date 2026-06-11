<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReorderRequestNotification extends Notification
{
    use Queueable;

    protected $reorder;
    protected $inventory;

    /**
     * Create a new notification instance.
     */
    public function __construct($reorder, $inventory)
    {
        $this->reorder = $reorder;
        $this->inventory = $inventory;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Reorder Request')
            ->greeting('Hello, ')
            ->line('You have received a new reorder request.')
            ->line('Product: ' . $this->reorder->inventory->product->name)
            ->line('Requested Quantity: ' . $this->reorder->requested_qty)
            ->action('View Request', url('/supplier/reorders'))
            ->line('Thank you!');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable)
    {

        return $this->toArray($notifiable);
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $inventory = $this->reorder->inventory;
        $product = $this->reorder->inventory->product ?? null;
        $supplierUser = $this->inventory->supplier->user ?? null;

        return [
            'message' => 'New reorder request for product: ' . ($product->name ?? 'N/A'),
            'requested_qty' => $this->reorder->requested_qty,
            'product_name' => $product->name ?? 'N/A',
            'sell_price' => $this->inventory->sell_price ?? 'N/A',
            'r_date' => $inventory->r_date ?? 'N/A',
            'p_price' => $this->inventory->p_price ?? 'N/A',
            'reorder_id' => $this->reorder->id,
            'supplier_name' => $supplierUser->name ?? 'N/A',
            'supplier_email' => $supplierUser->email ?? 'N/A',
            'url' => url('/product_manager/reorders/' . $this->reorder->id)
        ];
    }
}
