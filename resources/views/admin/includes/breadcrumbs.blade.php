@if(activeMenu('pos') != 'active' && activeMenu('pop') != 'active' && activeMenu('reports') != 'active')
<!-- Content Header (Page header) -->
<div class="content-header mobiledisplay" style="padding: 10px .5rem;">
   <div class="container">
      <div class="row mb-2">
         <!-- /.col -->
         <div class="col-sm-6 ">
            
            <ol class="breadcrumb ">
               <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}" style="color: #17a2b8;">Home</a></li>
                @stack('breadcrumb')
               <li class="breadcrumb-item active" style="color: #000;">@yield('pageTitle')</li>
            </ol>
            
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endif
