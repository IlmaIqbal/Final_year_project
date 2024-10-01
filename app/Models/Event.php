<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'customer_name',
        'customer_email',
        'description',
        'guest_no',
        'event_type',
        'start_date',
        'end_date',
        'status',
        'venue_id',
        'total_price',
        'selected_services',
    ];

    protected $casts = [
        'selected_services' => 'array',
    ];


    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function catering()
    {
        return $this->belongsToMany(Service::class, 'event_catering_service');
    }

    public function decoration()
    {
        return $this->belongsToMany(Decoration::class, 'event_decoration_service');
    }

    public function invitation()
    {
        return $this->belongsToMany(invitation::class, 'event_invitation_card');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function calculateTotalCost()
    {
        $cateringCost = $this->catering->sum('cost');
        $decorationCost = $this->decoration->sum('cost');
        $invitationCost = $this->invitation->sum('cost');

        return $cateringCost + $decorationCost + $invitationCost;
    }

    public function getSelectedServices()
    {
        $services = [
            'catering' => $this->catering->pluck('name')->toArray(),
            'decoration' => $this->decoration->pluck('name')->toArray(),
            'invitation' => $this->invitation->pluck('name')->toArray(),
        ];

        return $services;
    }
}
