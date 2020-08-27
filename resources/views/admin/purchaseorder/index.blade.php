@extends('admin.layouts.app')
@section('content')
@section('pageTitle', 'Purchase Order')

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
                        <a href="{{ route('admin.purchaseorders.index') }}" class="btn btn-danger btn-sm"
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
    <div class="modal-dialog modal-lg"  style="width: 380px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px 15px;">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body addholidaybody">
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@push('script')

<script>

        $(function () {
           /* datatable */
           $("#employee").DataTable({
               "responsive": true,
               "autoWidth": false,
               processing: true,
               serverSide: true,
               stateSave: true,
               ajax: {
                   'url': "{{ route('admin.purchaseorders.getall') }}",
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
                   {data: 'action', orderable: false},
               ]
           });
           /*filter*/
           $('.searchdata').click(function () {
               event.preventDefault();
               $("#employee").DataTable().ajax.reload()
           })
       });
   
       /********* add new employee ********/
       $('body').on('click', '.openaddmodal', function () {
           var id = $(this).data('id');
  
      

           $.ajax({
               url: "{{ route('admin.purchaseorders.getmodal')}}",
               type: 'POST',
               headers: {
                   'X-CSRF-TOKEN': '{{ csrf_token() }}'
               },
               data: {id: id},
               success: function (data) {
               $('.addholidaybody').html(data);
   
                       $(".formsubmit").validate({
                           rules: {
                           "name": {
                                required: true,
                                maxlength: 20,
                            },
   
                       },
                       messages: {
                       }
                   });
   
               },
           });
       });
</script>
@endpush
@endsection