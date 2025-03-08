</div>
<!--end::Testimonials Section-->

</div>
<!--end::Container-->
</div>
<!--end::Post-->
</div>
<!--end::Root-->
@if (Session::has('error'))
    <script>
        // Display SweetAlert with the error message
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ Session::get('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if (Session::has('success'))
    <script>
        // Display SweetAlert with the error message
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ Session::get('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        // Trigger modal and API request when the button is clicked
        $('#before-prayer-display').on('click', function() {

            // Make an API request to fetch data (replace 'your-api-endpoint' with the actual API)
            $.ajax({
                url: 'https://api.myquran.com/v2/sholat/kota/semua', // Replace with your API URL
                method: 'GET',
                success: function(response) {
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
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                fill="black" />
            <path
                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                fill="black" />
        </svg>
    </span>
    <!--end::Svg Icon-->
</div>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
            (registration) => {
                console.log("Service worker registration succeeded:", registration);
            },
            (error) => {
                console.error(`Service worker registration failed: ${error}`);
            },
        );
    } else {
        console.error("Service workers are not supported.");
    }
</script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "3000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<!--end::Scrolltop-->
<script>
    var hostUrl = "assets/";
</script>
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('js/scripts.bundle.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script src="{{ asset('plugins/custom/typedjs/typedjs.bundle.js') }}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('js/custom/landing.js') }}"></script>
<script src="{{ asset('js/custom/pages/company/pricing.js') }}"></script>
<!--end::Page Custom Javascript-->

<!--begin::Page Vendors Javascript(used by this page)-->
<link href="{{ asset('/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('/js/custom/apps/customers/list/export.js') }}"></script>
<script src="{{ asset('/js/custom/apps/customers/list/list.js') }}"></script>
<script src="{{ asset('/js/custom/apps/customers/add.js') }}"></script>
<script src="{{ asset('/js/custom/widgets.js') }}"></script>
<script src="{{ asset('/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('/js/custom/modals/create-app.js') }}"></script>
<script src="{{ asset('/js/custom/modals/upgrade-plan.js') }}"></script>
<!--end::Page Custom Javascript-->
</body>
<!--end::Body-->

</html>
