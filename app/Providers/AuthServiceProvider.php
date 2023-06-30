<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\User;
use App\Models\Topic;

// use App\Models\Topic;
// use App\Policies\TopicPolicy;
// use App\Models\Deck;
// use App\Policies\DeckPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Topic::class => TopicPolicy::class,
        // Deck::class => DeckPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('is-admin', function($user){
            return $user->is_admin;
        });

        Gate::define('is-owner', function(User $user, Topic $model){
            return $model->user_id === $user->id;
        });

        Gate::define('not-owner', function(User $user, Topic $model){
            return auth()->user() && !$user->is_admin && $model->user_id !== $user->id;
        });

    }
}
