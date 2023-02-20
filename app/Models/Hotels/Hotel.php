<?php

namespace App\Models\Hotels;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Hotel extends Model
{
    use HasFactory, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'internal_id',
        'name',
        'phone_number',
        'email',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
    ];

    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'internal_id' => $this->internal_id,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zip_code' => $this->zip_code,
        ];
    }

    /**
     * The users that belong to the hotel.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'hotel_user');
    }
}
