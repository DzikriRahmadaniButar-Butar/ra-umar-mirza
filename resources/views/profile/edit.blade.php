@extends('layouts.app')

@section('content')
<div class="py-6 px-6">
    <h2 class="text-2xl font-bold text-gray-100 mb-6">Edit Profil</h2>

    <div class="max-w-3xl space-y-8">

        {{-- Update Profil --}}
        @include('profile.partials.update-profile-information-form')

        {{-- Update Password --}}
        @include('profile.partials.update-password-form')

        {{-- Hapus Akun --}}
        @include('profile.partials.delete-user-form')

    </div>
</div>
@endsection
