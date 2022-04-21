<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
      'patient_id',
      'name',
      'diagnosis',
      'notes',
  ];

  public function patient() {
    return $this->belongsTo(Patient::class);
  }

  public function photos() {
    return $this->hasMany(Photo::class);
  }
}
