<!-- Common scripts -->
<script src="{{ asset('assets/view/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/view/js/common_scripts_min.js') }}"></script>
<script src="{{ asset('assets/view/js/functions.js') }}"></script>

<!-- Specific scripts -->
<script>
    $(function() {
        $('input.date-pick').daterangepicker({
            autoUpdateInput: true,
            singleDatePicker: true,
            autoApply: true,
            minDate: new Date(),
            showCustomRangeLabel: false,
            locale: {
                format: 'MM-DD-YYYY'
            }
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');
        });
    });
</script>

<script>
    $('input.time-pick').timepicker({
        minuteStep: 15,
        showInputs: false
    });
</script>

<script src="{{ asset('assets/view/js/jquery.ddslick.js') }}"></script>
<script>
    $("select.ddslick").each(function() {
        $(this).ddslick({
            showSelectedHTML: true
        });
    });
</script>

<!-- SWITCHER -->
<script src="{{ asset('assets/view/js/switcher.js') }}"></script>
<div id="style-switcher">
    <h2>Color Switcher <a href="#"><i class="icon_set_1_icon-65"></i></a></h2>
    <div>
        <ul class="colors" id="color1">
            <li><a href="#" class="default" title="Default"></a></li>
            <li><a href="#" class="aqua" title="Aqua"></a></li>
            <li><a href="#" class="green_switcher" title="Green"></a></li>
            <li><a href="#" class="orange" title="Orange"></a></li>
            <li><a href="#" class="blue" title="Blue"></a></li>
        </ul>
    </div>
</div>
