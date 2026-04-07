<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') . ' | ' . Request::segment(1) }}</title>
    @include('components.layouts.styles')
    @stack('css')

</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            {{-- @livewire('components.sidebar') --}}
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a wire:navigate href="/admin" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('assets/images/zapp.svg') }}" alt="zapp">
                        </span>
                    </a>

                    <a href="javascript:void(0)" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">{{ 'menu' }}</span>
                    </li>
                    <li class="menu-item">
                        <a wire:navigate href="{{ '#' }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-menu"></i>
                            <div>menu</div>
                        </a>
                    </li>
                </ul>


            </aside>

            <div class="sidebar-overlay"></div>
            <div class="layout-page">
                @include('components.layouts.navbar')
                <div class="content-wrapper">
                    <div class="container-xxl flex-1 container-p-y">
                        {{ $slot }}
                    </div>
                </div>
                <div class="content-backdrop fade"></div>
                @include('components.layouts.footer')
            </div>
        </div>
    </div>

    @include('components.layouts.scripts')
    @stack('js')
</body>

</html>
