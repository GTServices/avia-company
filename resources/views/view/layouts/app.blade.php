<!DOCTYPE html>
<html lang="en">

<head>
@include("view.layouts.includes.head")

</head>
<body>

@include("view.layouts.includes.partials._preload")

<!-- Mobile menu overlay mask -->

<x-view.header />

<x-view.hero />


@yield('content')


<x-view.footer />
@include("view.layouts.includes.partials._to_top")

@include("view.layouts.includes.partials._sign_in_dialog")

@include("view.layouts.includes.foot")
</body>
</html>
