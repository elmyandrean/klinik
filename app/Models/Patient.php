<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'birth_date',
        'personal_id',
        'phone',
        'address',
        'email'
    ];

    public function treatments() {
      return $this->hasMany(Treatment::class)->orderBy('id', 'DESC');
    }

    public function last_treatment() {
      return $this->hasOne(Treatment::class)->latest('id');
    }
}
