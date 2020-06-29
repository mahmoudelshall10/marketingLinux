<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

            //   /* define a freelance user role */
            //   Gate::define('isFreelance', function($user) {
            //     return $user->role == 'freelance';
            //  });
            
            //  /* define a student user role */
            //  Gate::define('isStudent', function($user) {
            //      return $user->role == 'student';
            //  });
           
            //  /* define a user role */
            //  Gate::define('isUser', function($user) {
            //      return $user->role == 'user';
            //  });

        //
    }
}
