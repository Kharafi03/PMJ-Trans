@extends('frontend.layouts.app')
@push('styles')
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/headerDriver-style.css') }}" rel="stylesheet" />
@endpush
<div>
    <div class="profile-card mb-5">
        <img src="{{ asset('img/driver.png') }}" alt="Profile Image">
        <div class="profile-text">
            <h5>Hi, {{ Auth::user()->name }}</h5>
            <p>Berkendaralah dengan hati-hati</p>
        </div>
    </div>
</div>
