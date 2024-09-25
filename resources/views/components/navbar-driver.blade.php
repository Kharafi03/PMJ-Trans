@extends('frontend.layouts.app')
@push('styles')
    <link id="pagestyle" href="{{ asset('css/frontend/css/navbarDriver-style.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
<div>
    <!-- CONTENT -->
    <section id="navbar">
        <div class="dashboard-container">
            <!-- NAVBAR -->
            <div class="p-3  sticky-bottom">
                <nav class="navbar navbar-bottom">
                    <div class="container justify-content-center align-items-center">
                      <ul class="navbar-nav d-flex flex-row">
                        <li class="nav-item">
                          <a class="nav-link text-white" href="{{ route('dashboard-driver') }}"><i class="fa-solid fa-house"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-white" href="{{ route('profile-driver') }}"><i class="fa-regular fa-user"></i></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-white" href="{{ route('trip-history') }}"><i class="fa-regular fa-bookmark"></i></a>
                        </li>
                      </ul>
                    </div>
                </nav>
            </div>
        </div>
    </section>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</div>