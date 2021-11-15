<nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header" data-logobg="skin5">
        
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <a class="navbar-brand" href="{{url('shop/dashboard')}}">
            <!-- Logo icon -->
            <b class="logo-icon ps-2">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img src="{{asset('assets/images/default.png')}}" alt="homepage" class="light-logo" width="230" height="60" />

            </b>
            <!--End Logo icon -->
            {{-- <!-- Logo text -->
            <span class="logo-text">
                <!-- dark Logo text -->
                <img src="{{asset('assets/images/logo-text.png')}}" alt="homepage" class="light-logo" />

            </span> --}}
            <!-- Logo icon -->
            <!-- <b class="logo-icon"> -->
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <!-- <img src="('assets/images/logo-text.png')}}" alt="homepage" class="light-logo" /> -->

            <!-- </b> -->
            <!--End Logo icon -->
        </a>
        <!-- End Logo -->
        <!-- Toggle which is visible on mobile only -->
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                class="ti-menu ti-close"></i></a>
    </div>
    <!-- End Logo -->

    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
        <!-- toggle and nav items -->
        <ul class="navbar-nav float-start me-auto">
            <li class="nav-item d-none d-lg-block"><a
                    class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                    data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
            </li>
        </ul>
        
        <!-- Right side toggle and nav items -->
        <ul class="navbar-nav float-end" style="float: end;">
            <!-- User profile and search -->
            <li class="nav-item dropdown">
                @if($LoggedShopInfo->shop_image==NULL)
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{$LoggedShopInfo->name}}</strong>&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{asset('assets/images/logodef.png')}}" alt="user" class="rounded-circle" width="40" height="40"> 
                   </a> 
                @endif
                @if($LoggedShopInfo->shop_image!=NULL)
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{$LoggedShopInfo->name}}</strong>&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ Storage::url($LoggedShopInfo->shop_image) }}" alt="user" class="rounded-circle" width="40" height="40"> 
                   </a> 
                @endif
                {{-- <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <strong>{{$LoggedShopInfo->name}}</strong>&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ Storage::url($LoggedShopInfo->shop_image) }}" alt="user" class="rounded-circle" width="40" height="40"> 
                </a>  --}}
                {{-- src="{{asset('assets/images/users/2.jpg')}}" --}}
                <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('profile.index')}}"><i class="ti-user me-1 ms-1"></i>My Profile</a>
                    {{-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet me-1 ms-1"></i>My Balance</a> --}}
                    {{-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email me-1 ms-1"></i>Inbox</a> --}}
                    <div class="dropdown-divider"></div>
                    {{-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings me-1 ms-1"></i> Account Setting</a> --}}
                    {{-- <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item" href="{{url('shoplogout')}}"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                    {{-- <div class="dropdown-divider"></div> --}}
                    {{-- <div class="ps-4 p-10"><a href="javascript:void(0)" lass="btn btn-sm btn-success btn-rounded text-white">View Profile</a></div> --}}
                </ul>
            </li>
            <!-- User profile and search -->
        </ul>
    </div>
</nav>