<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

{{-- <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->


<script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
{{-- <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

<!-- Vendors JS -->
{{-- <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
<!-- Place this tag in your head or just before your close body tag. -->
{{--<script async defer src="https://buttons.github.io/buttons.js"></script>--}}
<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

<!-- bootstrap date picker -->
<script src="{{ asset('assets/vendor/libs/datepicker/datepicker.min.js') }}"></script>
<!-- datepicker ru -->
<script src="{{ asset('assets/vendor/libs/datepicker/datepicker.ru.min.js') }}"></script>
<!-- datepicker uz -->
<script src="{{ asset('assets/vendor/libs/datepicker/datepicker.uz.min.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function () {

        function NotificationMessage(message, type = 'success', url = false) {
            const Toast = Swal.mixin({
                toast            : true,
                position         : 'top-end',
                showConfirmButton: false,
                timer            : 3000,
                timerProgressBar : true,
            })
            Toast.fire({
                icon : type,
                title: message
            })
        }

        @if (count($errors) > 0)
        NotificationMessage('@foreach ($errors->all() as $error) {{ $error }} @endforeach', 'error');
        @endif

        @if (session()->has('message'))
        NotificationMessage('{{ session()->get('message') }}', 'success');
        @endif

        $('*[data-action=delete]').click(function (e) {
            const linkDelete = $(this).attr('href');
            e.preventDefault();
            Swal.fire({
                title            : "@lang('form.are_you_sure')",
                icon             : "warning",
                showCancelButton : !0,
                confirmButtonText: "@lang('form.yes')",
                cancelButtonText : "@lang('form.no')",
                customClass      : {
                    confirmButton: "btn btn-primary me-3",
                    cancelButton : "btn btn-label-secondary"
                },
                buttonsStyling   : !1
            }).then(function (t) {
                if (t.value) {
                    location = linkDelete
                }
            })
        });

    });

</script>
@yield('js')
