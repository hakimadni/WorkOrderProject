@php
    $permissions = session('user_permissions', []);
@endphp
@include('partials.navbar')
@yield('content')

<script>
    @if (session('message'))
        Swal.fire({
            title: 'Success!',
            text: "{{ session('status') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @elseif (session('status'))
        Swal.fire({
            title: 'Success!',
            text: "{{ session('status') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @elseif (session('error'))
        Swal.fire({
            title: 'Error!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@include('partials.footer')
