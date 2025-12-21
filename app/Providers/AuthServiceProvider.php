<?php

namespace App\Providers;

use App\Models\Document;
use App\Models\Employee;
use App\Models\Notice;
use App\Models\User;
use App\Policies\DocumentPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\NoticePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Employee::class => EmployeePolicy::class,
        Notice::class => NoticePolicy::class,
        Document::class => DocumentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Admin gate
        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });
    }
}
