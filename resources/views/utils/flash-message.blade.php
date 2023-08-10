@if (Session::has('flash-info-msg'))
<script>
    Swal.fire({
        position: 'top',
        icon: 'info',
        title: "{{ Session::get('flash-info-msg') }}",
        showConfirmButton: false,
        timer: 2500,
        showCloseButton: true
    })
</script>
@endif

@if (Session::has('flash-warning-msg'))
<script>
    Swal.fire({
        position: 'top',
        icon: 'warning',
        title: "{{ Session::get('flash-warning-msg') }}",
        showConfirmButton: false,
        timer: 2500,
        showCloseButton: true
    })
</script>
@endif

@if (Session::has('flash-error-msg'))
<script>
    Swal.fire({
        position: 'top',
        icon: 'error',
        title: "{{ Session::get('flash-error-msg') }}",
        showConfirmButton: false,
        timer: 2500,
        showCloseButton: true
    })
</script>
@endif

@if (Session::has('flash-success-msg'))
<script>
    Swal.fire({
        position: 'top',
        icon: 'success',
        title: "{{ Session::get('flash-success-msg') }}",
        showConfirmButton: false,
        timer: 2500,
        showCloseButton: true
    })
</script>
@endif