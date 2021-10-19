<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Website;

class SubscribeUser extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'website_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function website(){
        return $this->belongsTo(Website::class);
    }
}
