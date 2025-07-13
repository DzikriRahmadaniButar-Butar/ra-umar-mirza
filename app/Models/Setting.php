<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description'
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value)
    {
        try {
            return self::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getByGroup($group)
    {
        try {
            $settings = self::where('group', $group)->get();
            return $settings ?? collect();
        } catch (\Exception $e) {
            return collect();
        }
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
}