<!doctype html>
<html lang="en" data-bs-theme="light">
@include('admin.layouts.includes.head')
<head>


</head>

<body>

<x-admin.header />


<x-admin.sidebar />
<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">


        @yield('content')




    </div>
</main>
<!--end main wrapper-->


@include('admin.layouts.includes.partials._overlay')


<x-admin.footer />





@include('admin.layouts.includes.partials._switcher')

@include('admin.layouts.includes.foot')

</body>

</html>
