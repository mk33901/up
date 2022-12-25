<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;


class ActivityObserver
{
    /**
     * Handle the Model "created" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function created(Model $model)
    {
        //
    }

    /**
     * Handle the Model "updated" event.
     *
     * @param  \App\Models\Model  $model
     * @return void
     */
    public function updated(Model $model)
    {
        \Log::info($model);
    }

    /**
     * Handle the Model "deleted" event.
     *
     * @param  \App\Models\Model  $model
     * @return void
     */
    public function deleted(Model $model)
    {
        //
    }

    /**
     * Handle the Model "restored" event.
     *
     * @param  \App\Models\Model  $model
     * @return void
     */
    public function restored(Model $model)
    {
        //
    }

    /**
     * Handle the Model "force deleted" event.
     *
     * @param  \App\Models\Model  $model
     * @return void
     */
    public function forceDeleted(Model $model)
    {
        //
    }
}
