<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toastr-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @if (Session::has('success'))
        toastr.success("{{ session('success') }}", 'Success');
    @endif

    @if (Session::has('error'))
        toastr.error("{{ session('error') }}", 'Error');
    @endif

    @if (Session::has('errors'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "@foreach ($errors->all() as $error){{ $error }}@endforeach",
        })
    @endif

    @if (Session::has('info'))
        toastr.info("{{ session('info') }}", 'Info');
    @endif

    @if (Session::has('warning'))
        toastr.warning("{{ session('warning') }}", 'Warning');
    @endif
</script>
