<?php


namespace App\Providers;

use App\Models\UserLanguage;
use App\Observers\ActivityObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        self::registerGlobalObserver();
    }

    private static function registerGlobalObserver()
    {
        /** @var \Illuminate\Database\Eloquent\Model[] $MODELS */
        $MODELS = [
            UserLanguage::class,
            // ...... more models here
        ];

        foreach ($MODELS as $MODEL) {
            $MODEL::observe(ActivityObserver::class);
        }
    }
}