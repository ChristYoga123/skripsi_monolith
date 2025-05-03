<?php

namespace App\Providers\Filament;

use App\Filament\Mentor\Resources\KursusResource;
use App\Filament\Mentor\Resources\TransaksiResource;
use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Enums\ThemeMode;
use Filament\Pages\Dashboard;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class MentorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('mentor')
            ->path('mentor')
            ->defaultThemeMode(ThemeMode::Dark)
            ->login()
            ->font('Poppins')
            ->brandName('Mentor LAOS')
            ->favicon(asset('logo.png'))
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/Mentor/Resources'), for: 'App\\Filament\\Mentor\\Resources')
            ->discoverPages(in: app_path('Filament/Mentor/Pages'), for: 'App\\Filament\\Mentor\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Mentor/Widgets'), for: 'App\\Filament\\Mentor\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->shouldRegisterNavigation(false)
                    ->shouldShowAvatarForm(
                        value: true,
                        directory: 'avatars', // image will be stored in 'storage/app/public/avatars
                        rules: 'mimes:jpeg,png,jpg,webp|max:1024' //only accept jpeg and png files with a maximum size of 1MB
                    ),
            ])
            // topbar
            ->userMenuItems([
                MenuItem::make()
                    ->label(fn() => "Edit Profile")
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-cog-6-tooth'),
            ])
            // sidebar
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make('')
                        ->items([
                            ...Dashboard::getNavigationItems(),
                        ]),
                    NavigationGroup::make('LAOS Course')
                        ->items([
                            ...KursusResource::getNavigationItems(),
                            ...TransaksiResource::getNavigationItems(),
                        ]),
                ]);
            })
            ->spa();
    }
}
