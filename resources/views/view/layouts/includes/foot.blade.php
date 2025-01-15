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


