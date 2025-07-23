<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupplierReorderNotification extends Notification
{
    use Queueable;

    protected $reorder;

    /**
     * Create a new notification instance.
     */
    public function __construct($reorder)
    {

        $this->reorder = $reorder;
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
        $inventory = $this->reorder->inventory;
        $product = $inventory->product ?? null;
        $supplier = $inventory->supplier ?? null;
        $supplierUser = $supplier->user ?? null;

        return (new MailMessage)
            ->subject('New Reorder Request for ' . $product->name)
            ->greeting('Dear Supplier,')
            ->line('You have received a reorder request.')
            ->line('Product: ' . $product->name)
            ->line('Details: ' . $product->detail)
            ->line('Requested Quantity: ' . $this->reorder->requested_qty)
            ->line('Selling Price: Rs.' . $inventory->sell_price)
            ->line('Reorder Date: ' . ($inventory->r_date ?? now()->toDateString()))
            ->line('Please log in and process the request promptly.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {


        $inventory = $this->reorder->inventory;
        $product = $inventory->product ?? null;
        $supplier = $inventory->supplier ?? null;
        $supplierUser = $supplier->user ?? null;

        return [
            'message' => 'New reorder request received for your product.' . $product->name,
            'reorder_id' => $this->reorder->id,
            'requested_qty' => $this->reorder->requested_qty,
            'product_name' => $product->name ?? 'N/A',
            'product_detail' => $product->detail ?? 'N/A',
            'sell_price' => $inventory->sell_price ?? 'N/A',
            'purchase_price' => $inventory->p_price ?? 'N/A',
            'reorder_date' => now()->toDateString(),
            'received_date' => $inventory->r_date,
            'inventory_id' => $inventory->id,
            'url' => url('/supplier/reorders/' . $this->reorder->id),
        ];
    }
}