<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

trait ActivityTrait
{
    protected static function boot()
    {   
        parent::boot();
        // static::updated(function($model){
        //     \Log::info("Updated ".$model);
        // });
        // // static::updating(function($model){
        // //     \Log::info("Updateing ".$model);
        // // });
       
        // foreach (['retrieved', 'creating', 'created', 'updating', 'updated', 'saving', 'saved', 'deleting', 'deleted'] as $event) {
        foreach ([ 'created', 'updated', 'deleted'] as $event) {
            static::$event(function ($model) use ($event) {
                $ActivityLog = ActivityLog::create([
                    'user_id'=> (auth()->check())?auth()->user()->id:0,
                    'model_type'=> get_class($model),
                    'model_id'=>$model->id,
                    'action_by'=> (auth()->check())?auth()->user()->id:0,
                    'action'=> $event,
                    'data'=> json_encode(request()->all()),
                    'existing_data'=> json_encode($model->getOriginal()),
                    'updated_data'=> json_encode($model->getDirty()),
                    'request_url'=> request()->path()
                ]);
            });
        }
    }
}
