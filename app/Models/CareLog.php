<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CareLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'chicken_id',
        'user_id',
        'date',
        'feed_type',
        'feed_quantity',
        'feed_time',
        'health_status',
        'health_symptoms',
        'eggs_collected',
    ];

    protected $casts = [
        'date' => 'date',
        'eggs_collected' => 'integer',
    ];

    /**
     * Get the chicken associated with this care log.
     */
    public function chicken()
    {
        return $this->belongsTo(Chicken::class);
    }

    /**
     * Get the user (caretaker/admin) who recorded this care log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
