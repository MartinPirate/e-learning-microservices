<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->registerSubjectRepo();
       $this->registerUserRepo();
       $this->registerSessionRepo();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */

    public function boot()
    {

    }

    public function registerUserRepo() {
        return  $this->app->bind(
            'App\Interfaces\UserInterface',
            'App\Repositories\UserRepository'

        );
    }

    public function registerSubjectRepo()
    {  return  $this->app->bind(
        'App\Interfaces\SubjectInterface',
        'App\Repositories\SubjectRepository'

    );

    }
    public function registerSessionRepo()
    {  return  $this->app->bind(
        'App\Interfaces\SessionInterface',
        'App\Repositories\SubjectRepository'

    );

    }

}
