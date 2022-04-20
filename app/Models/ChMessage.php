<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChMessage extends Model
{
  protected $table = 'ch_messages';
  protected $fillable = [
    'seen',
    'body',
    'to_id',
    'from_id',
    'type',
    'attachment'
  ];

  public function user() {
    return $this->belongsTo(User::class)->get();
  }

}
