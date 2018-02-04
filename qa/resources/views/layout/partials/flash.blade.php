@if (session('status'))
    <script type="text/javascript">
    toastr.options.timeOut = 1000;
    toastr.options.fadeOut = 250;
    toastr.options.fadeIn = 250;
    toastr["{{ session('type-status', 'success') }}"]("{{ trans('messages.autoclose') }}","{{ session('status') }}.");
    </script>
@endif