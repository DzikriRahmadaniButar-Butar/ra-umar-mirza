<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingHelper
{
    public static function get($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
    
    public static function getJson($key, $default = [])
    {
        try {
            $value = self::get($key, null);
            if ($value === null) {
                return $default;
            }
            
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : $default;
        } catch (\Exception $e) {
            return $default;
        }
    }
    
    public static function getByGroup($group)
    {
        try {
            $settings = Cache::remember("settings_group_{$group}", 3600, function () use ($group) {
                return Setting::where('group', $group)->get();
            });
            
            return $settings ?? collect();
        } catch (\Exception $e) {
            return collect();
        }
    }
    
    public static function set($key, $value)
    {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
    
    public static function clearCache()
    {
        try {
            $settings = Setting::all();
            foreach ($settings as $setting) {
                Cache::forget("setting_{$setting->key}");
            }
            
            $groups = Setting::distinct()->pluck('group');
            foreach ($groups as $group) {
                Cache::forget("settings_group_{$group}");
            }
        } catch (\Exception $e) {
            // Silent fail
        }
    }
}