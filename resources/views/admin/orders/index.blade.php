@extends('admin.layouts.app')
@section('content')
@section('pageTitle', 'Sale Orders')
<style>
   *{
   padding: 0px;
   margin: 0px;
   }
   @page :first {
   margin-top: -2.4cm
   /* Top margin on first page 10cm */
   }
   @media print{
   .modal-dialog{
   width: 100% !important;
   }
   .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12{
   float: left;
   }
   .col-md-12{
   width: 100%;
   }
   .col-md-11{
   width: 91.66666666666666%;
   }
   .col-md-10{
   width: 83.33333333333334%;
   }
   .col-md-9{
   width: 75%;
   }
   .col-md-8{
   width: 66.66666666666666%;
   }
   .col-md-7{
   width: 58.333333333333336%;
   }
   .col-md-6{
   width: 50%;
   }
   .col-md-5{
   width: 41.66666666666667%;
   }
   .col-md-4{
   width: 33.33333333333333%;
   }
   .col-md-3{
   width: 25%;
   }
   .col-md-2{
   width: 16.666666666666664%;
   }
   .col-md-1{
   width: 8.333333333333332%;
   }
   body *{
   visibility:hidden;
   }
   .container-fluid{
   display: none;
   }
   #printSection, #printSection *{
   visibility:visible;
   }
   #printSectionInvoice, #printSectionInvoice *{
   visibility:visible;
   }
   #printSection{
   text-transform:uppercase;
   font-size: 9px;
   left: 0;
   top: 0;
   padding: 0;
   margin:0;
   }
   #printSection h4{
   font-size: 12px;
   }
   #printSection tr td{
   margin: 0;
   padding: 0;
   }
   #printSection .bg-success, #printSection .bg-danger{
   visibility:hidden;
   }
   @page{
   margin: 0;
   }
   .hiddenpr{
   display: none !important;
   }
   html, body{
   zoom: 100%;
   overflow:hidden !important;
   }
   }
</style>
<div class="container">
   <!-- Info boxes -->
   <div class="row">
      <div class="col-12">
         <div class="card card-info card-outline displaybl" >
            <div class="card-body" style="padding: 10px 15px;">
               <div class="col-lg-12">
                  <div class="form-group row " style="margin-bottom: 0px;">
                    
 
                     <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                           <label>Date <span style="color: red">*</span></label>
                           <input type="date" placeholder="date" class="form-control date" value="{{$date}}" name="date" id ="date" required="">
                        </div>
                     </div>

                     <div class="col-md-2" style="padding-left: 0px;">
                        <button class="btn btn-success btn-sm searchdata"
                           style="margin-top: 33px;padding: 6px 16px;">Search <span
                           class="spinner"></span>
                        </button>
                        <a href="{{ route('admin.items.index') }}" class="btn btn-danger btn-sm"
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
               <table id="employee" class="table table-bordered table-hover" style="background: #fff;">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Order No.</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Created By</th>
                        <th>Total Item</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
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
<!--/. container-fluid -->
<div class="modal fade add_modal" >
   <div class="modal-dialog modal-lg" style="width: 380px;">
      <div class="modal-content">
         <div class="modal-header" style="padding: 15px 15px;
            background-color: #40484E;
            color: #FFF;">
            <h5 class="modal-title">Reciept</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="testprint" id="testprint">
            
         </div>
         <div class="modal-footer">
            <button  style="background-color: #40484E;color: white;" type="button" onclick="PrintTicket()" class="test btn btn-add hiddenpr">print</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
@push('script')
<script src="{{ URL::asset('public/admin/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('public/admin/jquery.inputmask.js') }}"></script>
<script src="{{ URL::asset('public/admin/jquery.inputmask.bundle.js') }}"></script>
<script>
   function printDiv(divName) {
       var printContents = document.getElementById(divName).innerHTML;
       var originalContents = document.body.innerHTML;
   
       document.body.innerHTML = printContents;
   
       window.print();
   
       document.body.innerHTML = originalContents;
   }
   function PrintTicket() {
      $('.modal-body').removeAttr('id');
      window.print();
      $('.modal-body').attr('id', 'modal-body');
   }
   
         function readURL(input, classes) {
               if (input.files && input.files[0]) {
                   var reader = new FileReader();
                   reader.onload = function(e) {
                       $('.' + classes).attr('src', e.target.result);
                   }
                   reader.readAsDataURL(input.files[0]);
               }
           }
   
           $('body').on('change', '.logo_image', function() {
               readURL(this, 'image_preview');
           });
           $(function () {
   
   
           $('body').on('click','.openaddmodal',function(){
               var id = $(this).data('id');
               $.ajax({
                   url: "{{ route('admin.orders.getprint')}}",
                   type: 'POST',
                   headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}'
                   },
                   data: {id: id},
               success: function (data) {
               $('.testprint').html(data);
   
   
               },
           });
           })
   
           /* datatable */
           $("#employee").DataTable({
               "responsive": true,
               "autoWidth": false,
               processing: true,
               serverSide: true,
               stateSave: true,
               ajax: {
                   'url': "{{ route('admin.orders.getall') }}",
                   'type': 'POST',
                   'data': function (d) {
                       d._token = "{{ csrf_token() }}";
                       d.date = $("#date").val();
                   }
               },
               columns: [
                   {data: 'DT_RowIndex', "orderable": false},
                   {data: 'order_number'},
                   {data: 'time'},
                   {data: 'created_at'},
                   {data: 'total_price'},
                   {data: 'created_by'},
                   {data: 'total_item'},
                   {data: 'status'},
                   {data: 'action', orderable: false},
               ]
           });
           /*filter*/
           $('.searchdata').click(function () {
               event.preventDefault();
               $("#employee").DataTable().ajax.reload()
           })
       });
   
       $('body').on('click', '.clicktosearch', function () {
           $('.displaybl').toggle("slide");
       })
       /********* add new employee ********/
      
   
       $('body').on('submit', '.formsubmit', function (e) {
           e.preventDefault();
           $.ajax({
               url: $(this).attr('action'),
               data: new FormData(this),
               type: 'POST',
               contentType: false,
               cache: false,
               processData: false,
               beforeSend: function () {
                   $('.spinner').html('<i class="fa fa-spinner fa-spin"></i>')
               },
               success: function (data) {
                  
                   if (data.status == 400) {
                       $('.spinner').html('');
                       toastr.error(data.msg)
                   }
                   if (data.status == 200) {
                       $('.spinner').html('');
                       $('.add_modal').modal('hide');
                       $('#employee').DataTable().ajax.reload();
                       toastr.success(data.msg,'Success!')
                   }
               },
           });
       });
       /****** delete record******/
       $('body').on('click', '.cancleorder', function (e) {
            e.preventDefault();
           var url = $(this).attr('href');
   
           (new PNotify({
               title: "Confirmation Needed",
               text: "Are you sure you wants to Cancel order?",
               icon: 'glyphicon glyphicon-question-sign',
               hide: false,
               confirm: {
                   confirm: true
               },
               buttons: {
                   closer: false,
                   sticker: false
               },
               history: {
                   history: false
               },
               addclass: 'stack-modal',
               stack: {
                   'dir1': 'down',
                   'dir2': 'right',
                   'modal': true
               }
           })).get().on('pnotify.confirm', function () {
               $.ajax({
                   url: url,
                   type: 'GET',
                   beforeSend: function () {
                   },
                   success: function (data) {
                        toastr.success('Order Cancelled successfully.', 'Success!');
                       $("#employee").DataTable().ajax.reload();
                   },
                   error: function () {
                       toastr.error('Something went wrong!', 'Oh No!');
                   }
               });
           });
       });
       /** change status**/

       $('body').on('click', '.changestatus', function () {
           var id = $(this).data('id');
           var status = $(this).data('status');
           (new PNotify({
               title: "Confirmation Needed",
               text: "Are you sure you wants to "+ status +" this record?",
               icon: 'glyphicon glyphicon-question-sign',
               hide: false,
               confirm: {
                   confirm: true
               },
               buttons: {
                   closer: false,
                   sticker: false
               },
               history: {
                   history: false
               },
               addclass: 'stack-modal',
               stack: {
                   'dir1': 'down',
                   'dir2': 'right',
                   'modal': true
               }
           })).get().on('pnotify.confirm', function () {
               $.ajax({
                   url: '{{ route("admin.orders.changestatus") }}',
                   type: 'POST',
                   headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}'
                   },
                   data: {id: id, status: status},
                   success: function (data) {
                       $("#employee").DataTable().ajax.reload();
                       toastr.success('Status changed successfully.', 'Success!');
                   },
                   error: function () {
                       toastr.error('Something went wrong!', 'Oh No!');
   
                   }
               });
           })
   
       });
       $('body').on('click', '.changestatus', function () {
           var id = $(this).data('id');
           var status = $(this).data('status');
           (new PNotify({
               title: "Confirmation Needed",
               text: "Are you sure you wants to "+ status +" this record?",
               icon: 'glyphicon glyphicon-question-sign',
               hide: false,
               confirm: {
                   confirm: true
               },
               buttons: {
                   closer: false,
                   sticker: false
               },
               history: {
                   history: false
               },
               addclass: 'stack-modal',
               stack: {
                   'dir1': 'down',
                   'dir2': 'right',
                   'modal': true
               }
           })).get().on('pnotify.confirm', function () {
               $.ajax({
                   url: '{{ route("admin.orders.changestatus") }}',
                   type: 'POST',
                   headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}'
                   },
                   data: {id: id, status: status},
                   success: function (data) {
                       $("#employee").DataTable().ajax.reload();
                       toastr.success('Status changed successfully.', 'Success!');
                   },
                   error: function () {
                       toastr.error('Something went wrong!', 'Oh No!');
   
                   }
               });
           })
   
       });
</script>
@endpush
@endsection