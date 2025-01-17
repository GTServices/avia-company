<!doctype html>
<html lang="en" data-bs-theme="light">
@include('admin.layouts.includes.head')

<body>
<x-admin.header />
<x-admin.sidebar />

<!--start main wrapper-->
<main class="main-wrapper d-flex flex-column min-vh-100">
    <div class="main-content flex-grow-1">
        @yield('content')
    </div>
    <x-admin.footer />
</main>
<!--end main wrapper-->

@include('admin.layouts.includes.partials._overlay')
@include('admin.layouts.includes.partials._switcher')
@include('admin.layouts.includes.foot')
</body>
</html>
