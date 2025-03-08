<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>KIM | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('media/Logo MMS.png') }}" />
    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('plugins/global/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.bundle.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/summernote/summernote-bs4.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Start GA -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body id="kt_body" class="bg-white">

    @yield('content')
    </div>
    <script>
        $(document).ready(function() {
            console.log('Test');

            // Trigger modal and API request when the button is clicked
            $('#before-prayer-display').on('click', function() {

                // Make an API request to fetch data (replace 'your-api-endpoint' with the actual API)
                $.ajax({
                    url: 'https://api.myquran.com/v2/sholat/kota/semua', // Replace with your API URL
                    method: 'GET',
                    success: function(response) {
                        console.log(response.data);
                        const selectData = response.data.map(item => {
                            return {
                                id: item.id, // Use 'id' for the option's value
                                text: item
                                    .lokasi // Use 'lokasi' for the option's display text
                            };
                        });
                        $('#city').select2({
                            placeholder: 'Select a location', // Custom placeholder text
                            data: selectData, // Use the mapped data
                            width: '100%' // Full width for the dropdown
                        });
                        $('#prayerModal').modal('show');

                    },
                    error: function(error) {
                        console.error('Error fetching prayer data:', error);
                    }
                });
            });

            $('#go').on('click', function() {

            });
        });
    </script>
    <!-- General JS Scripts -->
    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom/authentication/sign-up/general.js') }}"></script>
    <script src="{{ asset('js/custom/authentication/sign-in/general.js') }}"></script>
</body>

</html>
