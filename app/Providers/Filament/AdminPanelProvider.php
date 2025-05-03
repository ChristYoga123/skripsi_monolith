<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Enums\ThemeMode;
use Filament\Pages\Dashboard;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use App\Filament\Admin\Pages\DiskonPage;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use App\Filament\Admin\Resources\BlogResource;
use Illuminate\Session\Middleware\StartSession;
use App\Filament\Admin\Resources\DivisiResource;
use App\Filament\Admin\Resources\KursusResource;
use App\Filament\Admin\Resources\MentorResource;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\Admin\Resources\ProgramResource;
use App\Filament\Admin\Resources\StudentResource;
use Filament\Http\Middleware\AuthenticateSession;
use App\Filament\Admin\Resources\TransaksiResource;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use FilipFonal\FilamentLogManager\FilamentLogManager;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('super_admin')
            ->path('admin')
            ->login()
            ->defaultThemeMode(ThemeMode::Dark)
            ->font('Poppins')
            ->brandName('Administrasi LAOS')
            ->favicon(asset('logo.png'))
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
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
                FilamentShieldPlugin::make(),
                FilamentLogManager::make(),
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
                    NavigationGroup::make('Company Profile')
                        ->items([
                            ...DivisiResource::getNavigationItems(),
                            ...BlogResource::getNavigationItems(),
                            ...ProgramResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('LAOS Course')
                        ->items([
                            ...StudentResource::getNavigationItems(),
                            ...MentorResource::getNavigationItems(),
                            ...KursusResource::getNavigationItems(),
                            ...DiskonPage::getNavigationItems(),
                            ...TransaksiResource::getNavigationItems(),
                        ]),
                    NavigationGroup::make('Settings')
                        ->items([
                            NavigationItem::make('Roles & Permissions')
                                ->icon('heroicon-s-shield-check')
                                ->visible(fn() => auth()->user()->can('view_role') && auth()->user()->can('view_any_role'))
                                ->url(fn() => route('filament.super_admin.resources.shield.roles.index'))
                                ->isActiveWhen(fn() => request()->routeIs('filament.super_admin.resources.shield.roles.*')),
                            NavigationItem::make('Logs')
                                ->icon('heroicon-s-newspaper')
                                ->url(fn() => route('filament.super_admin.pages.logs'))
                                ->visible(fn() => auth()->user()->can('page_Logs'))
                                ->isActiveWhen(fn() => request()->routeIs('filament.super_admin.pages.logs')),
                        ]),

                ]);
            })
            ->spa();
    }
}
