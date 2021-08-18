<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{url('shop/dashboard')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span
                        class="hide-menu">Manage Category </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('category.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> All Category </span></a></li>
                        <li class="sidebar-item"><a href="{{route('category.create')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add new Category</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-table-large"></i><span
                        class="hide-menu">Manage Item </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('item.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> All Item </span></a></li>
                        <li class="sidebar-item"><a href="{{route('item.create')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add new Item</span></a></li>
                    </ul>
                </li>

                @php
                $todayDate = date("Y-m-d");
                $count = \App\Models\Order::where('shop_id',$LoggedShopInfo->id)->where('status','like','preparing')->where(DB::raw("(DATE_FORMAT(checkoutDelivery,'%Y-%m-%d'))"),'=',$todayDate)->count();
                @endphp

                @if($count==0)
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{route('order.index')}}" aria-expanded="false"><i class="mdi mdi-cart-outline"></i><span
                        class="hide-menu">View Order</span></a></li>
                @endif
                @if($count!=0)
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{route('order.index')}}" aria-expanded="false"><i class="mdi mdi-cart-outline"></i><span
                            class="hide-menu">View Order                             
                            <span class="position-absolute top-5 start-50 badge rounded-pill bg-danger">
                            {{$count}}<span class="visually-hidden">new order</span></span></span></a></li>
                @endif
                
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{route('analysis.index')}}" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span
                            class="hide-menu">Sales Analysis</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{route('promotion.index')}}" aria-expanded="false"><i class="mdi mdi-calendar-clock"></i><span
                            class="hide-menu">Schedule Promotion</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{url('stock')}}" aria-expanded="false"><i class="mdi mdi-clipboard-check"></i><span
                            class="hide-menu">Update stock</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
