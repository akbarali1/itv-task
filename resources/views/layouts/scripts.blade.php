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

        @if (count($errors) > 0)
        toastr.error("{!! implode('<br/>', $errors->all()) !!}");
        @endif

        @if (session()->has('message'))
        toastr.success("{{ session('message') }}");
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

        // today
        // Get the current date
        const today = new Date();
        today.setHours(0, 0, 0, 0)

        // Calculate the date 3 years ago
        var threeYearsAgo = new Date(today.getFullYear() - 3, today.getMonth(), today.getDate());

        // bootstrap datepicker
        $(".date_format").datepicker({
            format          : 'yyyy-mm-dd',
            todayHighlight  : true,
            enableOnReadonly: false,
            language        : "{{ app()->getLocale() }}",
            zIndexOffset    : 1500,
            startDate       : today,
            clearBtn        : true,
        });

        $('.birth-date-validator').datepicker({
            format          : 'yyyy-mm-dd',
            todayHighlight  : true,
            enableOnReadonly: false,
            language        : "{{ app()->getLocale() }}",
            zIndexOffset    : 1500,
            clearBtn        : true,
            endDate         : threeYearsAgo,
            beforeShowDay   : function (date) {
                let year = date.getFullYear();
                // Disable dates from 2020 to 2023(inclusive)
                if (year > threeYearsAgo.getFullYear() && date < today) {
                    return false;
                }
                return true
            }
        });
    });

</script>
@yield('js')
