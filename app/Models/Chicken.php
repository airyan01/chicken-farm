<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chicken extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'breed',
        'acquired_at',
        'caretaker_id',
    ];

    protected $casts = [
        'acquired_at' => 'date',
    ];

    /**
     * Get the caretaker assigned to this chicken.
     */
    public function caretaker()
    {
        return $this->belongsTo(User::class, 'caretaker_id');
    }

    /**
     * Get the care logs for this chicken.
     */
    public function careLogs()
    {
        return $this->hasMany(CareLog::class);
    }

    /**
     * Get the latest care log for this chicken.
     */
    public function latestCareLog()
    {
        return $this->hasOne(CareLog::class)->latestOfMany('date');
    }
}
