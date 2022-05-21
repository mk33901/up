<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;

trait UuidTraits
{
    protected static function boot()
    {
        parent::boot();
        foreach (['creating','updating'] as $event) {
            static::$event(function ($model) use ($event) {
                $model->uuid = Str::uuid();
            });
        }
    }
}
