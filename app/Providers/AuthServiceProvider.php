<?php

namespace App\Providers;

use App\Models\Album;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model\Album' => 'App\Policies\AlbumPolicy',
        'App\Model\Photo' => 'App\Policies\PhotoPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

       Gate::define('manage-album', function (User $user, Album $album){

           return $user->id === $album->user_id;
       });
    }
}
