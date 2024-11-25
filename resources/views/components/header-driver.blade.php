@push('styles')
    <link id="pagestyle" href="{{ asset('css/frontend/css/driver/headerDriver-style.css') }}" rel="stylesheet" />
@endpush
<div class="profile-card mb-3 d-flex justify-content-center align-items-center">
    <div class="profile-text">
        <h5>Hi, {{ Auth::user()->name }}</h5>
        <p>Berkendaralah dengan hati-hati</p>
    </div>
    <img src="{{ asset('img/avatar-driver.png') }}" alt="Profile Image" height="45px" width="45px">
</div>
