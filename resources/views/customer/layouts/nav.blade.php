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

            <!-- Messages -->
            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     <i class="font-24 mdi mdi-comment-processing"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown" aria-labelledby="2">
                    <ul class="list-style-none">
                        <li>
                            <div class="">
                                <!-- Message -->
                                <a href="javascript:void(0)" class="link border-top">
                                    <div class="d-flex no-block align-items-center p-10">
                                        <span class="btn btn-success btn-circle"><i
                                                class="ti-calendar"></i></span>
                                        <div class="ms-2">
                                            <h5 class="mb-0">Event today</h5>
                                            <span class="mail-desc">Just a reminder that event</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="link border-top">
                                    <div class="d-flex no-block align-items-center p-10">
                                        <span class="btn btn-info btn-circle"><i
                                                class="ti-settings"></i></span>
                                        <div class="ms-2">
                                            <h5 class="mb-0">Settings</h5>
                                            <span class="mail-desc">You can customize this template</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="link border-top">
                                    <div class="d-flex no-block align-items-center p-10">
                                        <span class="btn btn-primary btn-circle"><i
                                                class="ti-user"></i></span>
                                        <div class="ms-2">
                                            <h5 class="mb-0">Pavan kumar</h5>
                                            <span class="mail-desc">Just see the my admin!</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="link border-top">
                                    <div class="d-flex no-block align-items-center p-10">
                                        <span class="btn btn-danger btn-circle"><i
                                                class="fa fa-link"></i></span>
                                        <div class="ms-2">
                                            <h5 class="mb-0">Luanch Admin</h5>
                                            <span class="mail-desc">Just see the my new admin!</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </ul>
            </li> --}}
            <!-- End Messages -->
            

            
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
                 
                    <a class="dropdown-item" href="Custlogout"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                </ul>
            </li>
            
        </ul>
    </div>
</nav>