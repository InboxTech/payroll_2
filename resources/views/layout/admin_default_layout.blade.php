<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('admin/assets') }}/" data-template="vertical-menu-template">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>{{ getSettingData('config_company_name') }}</title>

        <meta name="description" content="" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset(getImage(getSettingData('config_fav_icon'))) }}" />

        @include('elements.admin_default_header_script')

        @livewireStyles

        <script>
            var url = "{{ url('/') }}";
        </script>

        @php
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        @endphp
    </head>

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    @include('elements.admin_sidebar')
                </aside>
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->
                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                        @include('elements.admin_default_header')
                    </nav>
                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->

                        @yield('content')
                        
                        <!-- / Content -->

                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div class="container-xxl">
                                <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                                    <div>
                                        ©
                                        <script>
                                            document.write(new Date().getFullYear());
                                        </script>, Design & Developed By
                                        <a href="javascript:void(0);" class="footer-link text-primary fw-medium">{{ getSettingData('config_company_name') }}</a>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>

            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>
        <!-- / Layout wrapper -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        @include('elements.admin_default_footer_script')

        @livewireScripts

        @stack('script')

        <script type="text/javascript">
            function updateClock() {
                let now = new Date();
                
                // Get day of the week, month, day, year
                let days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                let dayName = days[now.getDay()];
                let monthName = months[now.getMonth()];
                let day = now.getDate();
                let year = now.getFullYear();
                
                // Get time in 12-hour format with AM/PM
                let hours = now.getHours();
                let minutes = now.getMinutes().toString().padStart(2, '0');
                let seconds = now.getSeconds().toString().padStart(2, '0');
                let period = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12' in 12-hour clock
                let timeString = hours + ':' + minutes + ':' + seconds + ' ' + period;
                
                // Construct the full date and time string
                let fullDateTimeString = `${dayName}, ${day} ${monthName} ${year} ${timeString}`;
                
                // Update the clock element
                document.getElementById('clock').textContent = fullDateTimeString;
            }

            // Update the clock initially
            updateClock();

            // Update the clock every second
            setInterval(updateClock, 1000);
		</script>

        <!-- Delete Data Js -->
        <script src="{{ asset('admin/assets/js/global.js') }}"></script>
    </body>
</html>
