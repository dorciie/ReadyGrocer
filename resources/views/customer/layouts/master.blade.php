<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    @include('customer.layouts.head')
</head>
<body>

    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        
        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar" data-navbarbg="skin5">
            @include('customer.layouts.nav')
        </header>
        <!-- End Topbar header -->

        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        @include('customer.layouts.sidebar')
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="page-breadcrumb">
            @yield('title')
            </div>
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- End Container fluid  -->

            <!-- footer -->
            <footer class="footer text-center">
                {{-- All Rights Reserved by Matrix-admin. Designed and Developed by <a
                    href="https://www.wrappixel.com">WrapPixel</a>. --}}
                    All Rights Reserved by ReadyGrocer. Designed and Developed by Hasya@Atiqah :)
            </footer>
            <!-- End footer -->

        </div>
        <!-- End Page wrapper  -->

    </div>
    <!-- End Wrapper -->

    @include('customer.layouts.footer')
    
</body>

</html>