<nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header" data-logobg="skin5">
        
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <a class="navbar-brand" href="index.html">
            <!-- Logo icon -->
            <b class="logo-icon ps-2">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img src="{{asset('assets/images/default.png')}}" alt="homepage" class="light-logo" width="230" height="60" />
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text">
                <!-- dark Logo text -->
                <!-- <img src="{{asset('assets/images/logo-text.png')}}" alt="homepage" class="light-logo" /> -->

            </span>
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
                    data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
            
            <!-- create new -->
            {{-- <li class="nav-item dropdown"> --}}
                {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                    <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                </a> --}}
                {{-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul> --}}
            {{-- </li> --}}

            <!-- Search -->
            {{-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                    href="javascript:void(0)"><i class="ti-search"></i></a>
                <form class="app-search position-absolute">
                    <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                        class="srh-btn"><i class="ti-close"></i></a>
                </form>
            </li> --}}
        </ul>
        
        <!-- Right side toggle and nav items -->
        <ul class="navbar-nav float-end">
            <!-- Comment -->
            <li class="nav-item dropdown">
               {{-- @if($LoggedShopInfo->shop_image==NULL)
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{$LoggedShopInfo->name}}</strong>&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{asset('assets/images/logodef.png')}}" alt="user" class="rounded-circle" width="40" height="40"> 
                   </a> 
                @endif
                @if($LoggedShopInfo->shop_image!=NULL)
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{$LoggedShopInfo->name}}</strong>&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ Storage::url($LoggedShopInfo->shop_image) }}" alt="user" class="rounded-circle" width="40" height="40"> 
                   </a> 
                @endif--}}
            <!-- End Comment -->

            

            
            <!-- User profile and search -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <strong>{{\App\Models\Customer::where('id',session('LoggedCustomer'))->value('name')}}</strong>&nbsp;&nbsp;&nbsp;
                 <?php
                    $data =\App\Models\Customer::where('id',session('LoggedCustomer'))->first();
                 ?>
                 @if($data->CustImage==NULL)
                    &nbsp;&nbsp;&nbsp;&nbsp;<img src="{{asset('assets/images/logodef.png')}}" alt="user" class="rounded-circle" width="40" height="40"> 
                @endif
                @if($data->CustImage!=NULL)
                    &nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ Storage::url($data->CustImage) }}" alt="user" class="rounded-circle" width="40" height="40"> 
                @endif
                
                </a>
                <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('custProfile.index')}}"><i class="ti-user me-1 ms-1"></i>My Profile</a>
                 
                    <a class="dropdown-item" href="{{url('Custlogout')}}"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                </ul>
            </li>
            
        </ul>
    </div>
</nav>