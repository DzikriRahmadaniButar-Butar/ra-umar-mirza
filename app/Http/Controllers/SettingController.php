<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
{
    $settings = Setting::all();
    $academicYears = AcademicYear::all();
    return view('settings.edit', compact('settings', 'academicYears'));
}



public function update(Request $request)
{
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'about_title' => 'required|string|max:255',
            'about_description' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address_description' => 'nullable|string',
            'map_embed' => 'nullable|string',
        ]);
        
        $settings = [
            'hero_title' => $request->hero_title,
            'hero_description' => $request->hero_description,
            'about_title' => $request->about_title,
            'about_description' => $request->about_description,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_description' => $request->address_description,
            'map_embed' => $request->map_embed,
        ];

        foreach ($settings as $key => $value) {
            $label = match ($key) {
                'hero_title' => 'Judul Hero',
                'hero_description' => 'Deskripsi Hero',
                'about_title' => 'Judul Tentang Kami',
                'about_description' => 'Deskripsi Tentang Kami',
                'email' => 'Email Kontak',
                'phone' => 'Telepon Kontak',
                'address_description' => 'Deskripsi Alamat',
                'map_embed' => 'Lokasi Google Maps',
                default => ucfirst(str_replace('_', ' ', $key))
            };

            $type = match ($key) {
                'hero_description', 'about_description', 'address_description', 'map_embed' => 'textarea',
                'default_academic_year_id' => 'select',
                default => 'text'
            };

            $group = match ($key) {
                'hero_title', 'hero_description', 'about_title', 'about_description' => 'landing',
                'email', 'phone', 'address_description', 'map_embed' => 'contact',
                'default_academic_year_id' => 'system',
                default => 'general'
            };

            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'label' => $label,
                    'type' => $type,
                    'group' => $group
                ]
            );
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function setActiveYear(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        Setting::updateOrCreate(['key' => 'default_academic_year_id'], [
            'value' => $request->academic_year_id,
            'label' => 'Tahun Ajaran Aktif',
            'type' => 'select',
            'group' => 'system'
        ]);

        return back()->with('success', 'Tahun ajaran aktif diperbarui.');
    }
}
