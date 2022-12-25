<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class Transations extends Model
{
    use HasFactory;

    public function model()
    {
      return $this->morphTo();
    }
}
