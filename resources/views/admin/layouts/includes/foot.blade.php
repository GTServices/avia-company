<!--bootstrap js-->
<script src="{{asset('assets/admin/assets/js/bootstrap.bundle.min.js')}}"></script>

<!--plugins-->
<script src="{{asset('assets/admin/assets/js/jquery.min.js')}}"></script>
<!--plugins-->
{{--<script src="{{asset('assets/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>--}}
<script src="{{asset('assets/admin/assets/plugins/metismenu/metisMenu.min.js')}}"></script>
{{--<script src="{{asset('assets/admin/assets/plugins/apexchart/apexcharts.min.js')}}"></script>--}}
<script src="{{asset('assets/admin/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/admin/assets/plugins/peity/jquery.peity.min.js')}}"></script>
<script>
    $(".data-attributes span").peity("donut")
</script>
<script src="{{asset('assets/admin/assets/js/main.js')}}"></script>
<script src="{{asset('assets/admin/assets/js/dashboard1.js')}}"></script>
@stack('scripts')
{{--
<script>
    new PerfectScrollbar(".user-list")
</script>
--}}
