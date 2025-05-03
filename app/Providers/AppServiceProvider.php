<?php

namespace App\Providers;

use App\Filament\Custom\Responses\LogoutResponse;
use Illuminate\Support\Facades\DB;
use App\Interfaces\PaymentInterface;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Service\MidtransPaymentService;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Filament DI
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
        // Midtrans DI
        $this->app->bind(PaymentInterface::class, MidtransPaymentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Model::preventLazyLoading(!app()->isProduction());
        DB::prohibitDestructiveCommands(app()->isProduction());

        // Blade Config
        View::composer('components.cp.front.navbar', function ($view) {
            $view->with('menus', config('cp.front-menus'));
        });
        View::composer('components.laos-course.front.navbar', function($view)
        {
            $view->with('menus', config('laos-course.front-menus'));
        });
        View::composer('components.laos-course.front.footer', function($view)
        {
            $view->with('menus', config('laos-course.front-menus'));
        });
        View::composer('components.laos-course.back.aside', function($view)
        {
            $view->with('menus', config('laos-course.back-menus'));
        });

        // Global Components
        Blade::include('components.global.toastr', 'Toastr');
        /** CP Components */ 
        Blade::include('components.cp.front.navbar', 'NavbarCP');
        Blade::include('components.cp.front.footer', 'FooterCP');
        /** Course Components */
        // Front
        Blade::include('components.laos-course.front.navbar', 'NavbarFrontCourse');
        Blade::include('components.laos-course.front.footer', 'FooterFrontCourse');
        Blade::include('components.laos-course.front.course-card', 'CourseCardFrontCourse');
        Blade::include('components.laos-course.front.video-modal', 'VideoModalFrontCourse');
        Blade::include('components.laos-course.front.empty-state', 'EmptyStateFrontCourse');
        Blade::include('components.laos-course.front.init-state', 'InitStateFrontCourse');
        Blade::include('components.laos-course.front.elements.text-input', 'TextInputFrontCourse');
        Blade::include('components.laos-course.front.elements.checkbox-input', 'CheckboxInputFrontCourse');
        Blade::include('components.laos-course.front.elements.button', 'ButtonFrontCourse');
        // Back
        Blade::include('components.laos-course.back.topbar', 'TopbarBackCourse');
        Blade::include('components.laos-course.back.topbar-desktop', 'TopbarDesktopBackCourse');
        Blade::include('components.laos-course.back.aside', 'AsideBackCourse');
        Blade::include('components.laos-course.back.my-course', 'MyCourseBackCourse');
        Blade::include('components.laos-course.back.empty-state', 'EmptyStateBackCourse');
    }
}
