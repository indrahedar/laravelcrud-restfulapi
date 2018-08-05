<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $primaryKey = 'id';
  protected $fillable = [
      'name', 'email', 'job',
  ];
  protected $hidden = [
      'id', 'created_at', 'updated_at'
  ];
}
