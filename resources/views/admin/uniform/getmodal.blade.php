<style type="text/css">
   table, th, td {
  border: 1px solid #797979;
  border-collapse: collapse;
  padding: 10px;
  text-align: center;
}
</style>


   
   
   <div class="row">
      <div class="col-sm-12 col-md-5">
         <fieldset>
            <legend>
               Item Info
            </legend>
            <form  autocorrect="off" action="{{ route('admin.uniform.storeitem') }}" autocomplete="off" method="post" class="form-horizontal form-bordered formsubmit">
               {{ csrf_field() }}
               <input type="hidden" name="itemid" class="itemid" value="">
               <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                     <label>Item Name<span style="color: red">*</span></label>
                     <input type="text" placeholder="Item Name" class="form-control item_name" value="" name="item_name" required="">
                  </div>
               </div>
               <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                     <label>Rack Number<span style="color: red">*</span></label>
                      <input type="text" placeholder="Rack Number" class="form-control rack_number" value="" name="ract_number" required="">
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary  submitbutton pull-right"> Submit <span class="spinneritem"></span></button>
                  </div>
               </div>
            </form>
            
         </fieldset>
      </div>
      <div class="col-sm-12 col-md-7 loadfullhtml" style="margin-top: 20px; padding-bottom: 20px; max-height: 350px; overflow-y: scroll;">
         <table style="width:100%">
           <tr>
             <th>Item Name</th>
             <th>Rack Number</th> 
             <th>Action</th>
           </tr>
           @forelse ($item_masters as $item_master)
             <tr>
             <td>{{ $item_master->name }}</td>
             <td>{{ $item_master->ract_number }}</td>
             <td><a title="Edit" class="btn btn-info btn-sm edititem" data-ract_number="{{ $item_master->ract_number }}" data-name="{{ $item_master->name }}" data-id="{{ $item_master->id }}" href="javascript:void(0)"><i class="fas fa-pencil-alt"></i> </a></td>
           </tr>
         @empty
            <tr>
             <td colspan="3">No Item found.</td>
           </tr>
         @endforelse
           
           
         </table>

      </div>
   </div>   
   </div>
