<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gsessions extends Model
{
    protected $fillable = ['game_type','device_number','minutes_played','room_cost','bar_items','bar_cost','cost','total_cost','promo_percent','cost_after_promo','group','card','card_type','date'];
    use HasFactory;
}
