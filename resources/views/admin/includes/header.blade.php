<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white navmenu" style="padding: .5rem 0.2rem; border-bottom: 1px solid #929292!important">
    <div class="container" style="max-width: 100%;">
        <div class="navbar-brand">

            <a href="{{ url('admin/dashboard') }}">
                <span class="fa fa-html5" style="margin-left: 10px;width: 100%;color: #17a2b8; font-size: 25px;
                  "></span>
            </a>
        </div>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{activeMenu('dashboard')}}">{{ __('message.Dashboard') }}</a>
                </li>
                @if(checkPermission(['super_admin']))
                <li class="nav-item">
                    <a href="{{ route('admin.users.index')}}" class="nav-link {{activeMenu('users')}}">Users</a>
                </li>
                @endif
                @if(checkPermission(['super_admin']))
                <li class="nav-item">
                    <a href="{{ route('admin.company')}}" class="nav-link {{activeMenu('company')}}">Company</a>
                </li>
                @endif
                @if(checkPermission(['super_admin']))
                <li class="nav-item">
                    <a href="{{ route('admin.items.index')}}" class="nav-link {{activeMenu('items')}}">Items</a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.pos.index')}}" class="nav-link {{activeMenu('pos')}}">POS</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.orders.index')}}" class="nav-link {{activeMenu('orders')}}">Sale Orders</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pop.index')}}" class="nav-link {{activeMenu('pop')}}">POP</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.purchaseorders.index')}}" class="nav-link {{activeMenu('purchaseorders')}}">Purchase Orders</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.reports.index')}}" class="nav-link {{activeMenu('reports')}}">Reports</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.monthlyreports.index')}}" class="nav-link {{activeMenu('monthlyreports')}}">Monthly Report</a>
                </li>
            </ul>
        </div>
        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item dropdown profiledrop">
                @php
                if(!empty(auth()->user()->image)){
                $image =auth()->user()->image;
                }else{
                $image = 'default.png';
                }
                @endphp
                <a class="nav-link" data-toggle="dropdown" href="#" style="padding-top: 5px;">
                    <img src="{{ url('public/company/employee/'.$image) }}" style=" width: 30px;">

                </a>


                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                    style="top: 133%; min-width: 339px!important; border-radius: 10px;">
                    <div
                        style="width:100%; padding: 20px; background: url('{{ url('public/admin/user_profile_bg.jpg') }}');background-size: cover;">
                        <div class="m-card-user m-card-user--skin-dark" style="color: #fff;">
                            <div class="m-card-user__details">
                                <span
                                    style="font-size: 20px; width: 100%; display: block;">{{ auth()->user()->name }} {{ auth()->user()->lastname }}</span>
                                <a href="#" class="m-card-user__email m--font-weight-300 m-link"
                                    style="color: #fff;">{{ auth()->user()->email }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="buttonsection" style="padding: 15px;">
                        <a href="{{ route('admin.profile') }}" class="btn btnpopup profilebutton"><i class="fa fa-user"
                                aria-hidden="true"></i> Profile</a>

                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn btnpopup"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>

                </div>

            </li>
        </ul>
    </div>
</nav>

<!-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i>
         
        </a>
        <ul class="nav nav-treeview">
          
          <li class="nav-item">
            <a href="./index2.html" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              
            </a>
          </li>
         
        </ul>
      </li>
      
    </ul>
  </nav>
</div>
</aside> -->