@extends('admin.layouts.app')
@section('content')
@section('pageTitle', 'Reports')
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #000;
  text-align: left;
  padding: 8px;
  text-align: center;
}


</style>
<div class="container-fluid" style="margin-top: 10px;">
   <!-- Info boxes -->
   <div class="row">

      <div class="col-12">
         <div class="card card-info card-outline displaybl" >
            <div class="card-body" style="padding: 10px 15px;">
               <div class="col-lg-12">
                  <div class="form-group row " style="margin-bottom: 0px;">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                           <label>Start Date <span style="color: red">*</span></label>
                           <input type="date" placeholder="date" class="form-control startdate" value="{{ date('Y-m-d') }}" name="date" id ="date" required="">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                           <label>End Date <span style="color: red">*</span></label>
                           <input type="date" placeholder="date" class="form-control enddate" value="{{ date('Y-m-d') }}" name="date" id ="date" required="">
                        </div>
                     </div>

                     <div class="col-md-2" style="padding-left: 0px;">
                        <button class="btn btn-success btn-sm searchdata"
                           style="margin-top: 33px;padding: 6px 16px;">Search <span
                           class="spinner"></span>
                        </button>
                        <a href="{{ route('admin.monthlyreports.index') }}" class="btn btn-danger btn-sm"
                           style="margin-top: 33px;margin-left: 5px;padding: 6px 16px;cursor: pointer; ">
                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.card -->
         </div>
         <div class="card  card-outline">
            <div class="card-body">
               <!-- /.card-header -->
               <table id="employee" class="" style="background: #fff;">
                  <thead>
                     <tr>
                        <th >#</th>
                        <th >Item Code</th>
                        <th  style="text-align: left;">Item Name</th>
                        <th>Purchase</th>
                        <th>Sale</th>
                        <th style="text-align: right;">Total</th>
                     </tr>
                  </thead>
                  <tbody class="loadpos">
                    
                  </tbody>
               </table>
               <!-- /.card-body -->
               <!-- /.card -->
            </div>
         </div>
         <!-- /.col -->
      </div>
   </div>
   <!-- /.row -->
</div>

@push('script')

<script>
function getrecords(){
  $.ajax({
      url: '{{ route("admin.monthlyreports.loadpos") }}',
      type: 'POST',
      data:{startdate:$('.startdate').val(),enddate:$('.enddate').val()},
      headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      success: function (data) {
        $('.spinner').html('');
         $('.loadpos').html(data);
      },
      error: function () {
          toastr.error('Something went wrong!', 'Oh No!');
      }
  });
}
$(function(){
  getrecords();
  $('.searchdata').click(function(){
    $('.spinner').html('<i class="fa fa-spinner fa-spin"></i>');
    getrecords();
  });
})      
</script>
@endpush
@endsection