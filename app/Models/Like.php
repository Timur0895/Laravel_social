<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Like extends Model
{
  use Notifiable;

  protected $table = 'likeable';
  protected $fillable = ['user_id'];

  public function likeable() 
  {
    return $this->morphTo();
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
