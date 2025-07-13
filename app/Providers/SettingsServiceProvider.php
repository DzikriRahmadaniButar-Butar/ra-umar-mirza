<?php
// app/Providers/SettingsServiceProvider.php

namespace App\Providers;

use App\Models\Setting;
use App\Models\AcademicYear;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (Schema::hasTable('settings')) {
            // Share settings ke semua view
            View::composer('*', function ($view) {
                $settings = Setting::pluck('value', 'key');
                $activeAcademicYear = null;
                
                if (isset($settings['default_academic_year_id'])) {
                    $activeAcademicYear = AcademicYear::find($settings['default_academic_year_id']);
                }
                
                $view->with('globalSettings', $settings)
                     ->with('activeAcademicYear', $activeAcademicYear);
            });
        }
    }
}