<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- <script src="plugins/jquery-ui/jquery-ui.min.js"></script> -->

<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>

<!-- Ion Slider -->
<script src="{{ asset('plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!-- Bootstrap slider -->
<script src="{{ asset('plugins/bootstrap-slider/bootstrap-slider.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<script>
  $(function() {

    bsCustomFileInput.init();

    /* BOOTSTRAP SLIDER */
    $('.slider').bootstrapSlider()

    /* ION SLIDER */
    $('#unitPrice').ionRangeSlider({
      min: 0,
      max: 5000,
      from: 0,
      to: 0,
      type: 'double',
      step: 5,
      prefix: '$',
      input_values_separator: ' - ',
      prettify: false,
      hasGrid: true
    })

    $('#height').ionRangeSlider({
      min: 0,
      max: 50,
      from: 0,
      to: 0,
      type: 'double',
      step: 1,
      postfix: '\"',
      prettify: false,
      hasGrid: true
    })

    $('#width').ionRangeSlider({
      min: 0,
      max: 50,
      from: 0,
      to: 0,
      type: 'double',
      step: 1,
      postfix: '\"',
      prettify: false,
      hasGrid: true
    })

    $('#weight').ionRangeSlider({
      min: 0,
      max: 50,
      from: 0,
      to: 0,
      type: 'double',
      step: 1,
      postfix: '\"',
      prettify: false,
      hasGrid: true
    })

    $('#size').ionRangeSlider({
      min: 0,
      max: 50,
      from: 0,
      to: 0,
      type: 'double',
      step: 1,
      postfix: '\"',
      prettify: false,
      hasGrid: true
    })

    $('#createdAtDateRange').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'YYYY-MM-DD HH:mm:ss'
      }
    })

  })
</script>