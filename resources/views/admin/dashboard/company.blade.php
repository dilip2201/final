@extends('admin.layouts.app')
@section('content')
@section('pageTitle', 'Company')

<div class="container">
<div class="card  card-outline">
               
<div class="card-body">
<form autocorrect="off" action="{{ route('admin.updatecompnay') }}" autocomplete="off" method="post" class="form-horizontal form-bordered formsubmit">
   {{ csrf_field() }}
   <fieldset>
      <legend>
         Company Info
      </legend>
      <div class="row">
         <div class="col-sm-12 col-md-6">
            <div class="form-group">
               <label>Company Name <span style="color: red">*</span></label>
               <input type="text" placeholder="Company Name " class="form-control" value="@if(!empty($company)){{ $company->name }}@endif" name="name" required="">
            </div>
         </div>
         <div class="col-sm-12 col-md-6">
            <div class="form-group">
               <label>Address<span style="color: red">*</span></label>
               <input type="text" placeholder="Address" class="form-control" value="@if(!empty($company)){{ $company->address }}@endif" name="address" required="">
            </div>
         </div>
         <div class="col-sm-12 col-md-6">
            <div class="form-group">
               <label>GST No.<span style="color: red">*</span></label>
               <input type="text" placeholder="GST No." class="form-control" value="@if(!empty($company)){{ $company->gst_number }}@endif" name="gst_number" required="">
            </div>
         </div>

      </div>
   </fieldset>
   <div class="col-md-12">
      <div class="form-group">
         <button type="submit" class="btn btn-primary  submitbutton pull-right"> Submit <span class="spinner"></span></button>
      </div>
   </div>
   
</form>
</div>
</div>
</div>

@push('script')
<script src="{{ URL::asset('public/admin/jquery.validate.min.js') }}"></script>
<script>
$(".formsubmit").validate({
    rules: {
        name : {
            required:true,
            maxlength: 20,
        },
        gst_number:{
            required:true,
            maxlength: 15,
        },
        address: {
            required:true,
            maxlength: 50,
        }
    }

});
$('body').on('submit', '.formsubmit', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        data: new FormData(this),
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.spinner').html('<i class="fa fa-spinner fa-spin"></i>')
        },
        success: function(data) {

            if (data.status == 400) {
                $('.spinner').html('');
                toastr.error(data.msg)
            }
            if (data.status == 200) {

                $('.spinner').html('');
                toastr.success(data.msg)
            }
        },
    });
});
</script>
@endpush
@endsection