<form autocorrect="off" action="{{ route('admin.items.store') }}" autocomplete="off" method="post" class="form-horizontal form-bordered formsubmit">
   {{ csrf_field() }}
       @if(isset($item) && !empty($item->id) )
        <input type="hidden" name="itemid" value="{{ encrypt($item->id) }}">
    @endif
   <fieldset>
      <legend>
         Item Info
      </legend>
      <div class="row">
         <div class="col-sm-12 col-md-4">
           <div class="form-group">
               <label><b>Group Name: </b>
               </label>
               <select class="form-control group_name" id="group_name" name="group_name" required="">

                   <option value="">Select Group Name</option>
                   <option value="pizza" @if(!empty($item) && $item->group_name == 'pizza') selected @endif>Pizza</option>
                   <option value="sandwich" @if(!empty($item) && $item->group_name == 'sandwich') selected @endif>Sandwich</option>   
                  <option value="snacks" @if(!empty($item) && $item->group_name == 'snacks') selected @endif>Snacks</option>
                  <option value="drinks" @if(!empty($item) && $item->group_name == 'drinks') selected @endif>Drinks</option>
                  <option value="others" @if(!empty($item) && $item->group_name == 'others') selected @endif>Others</option> 
               </select>
           </div>
         </div>
         <div class="col-sm-12 col-md-4">
            <div class="form-group">
               <label>Name<span style="color: red">*</span></label>
               <input type="text" placeholder="Name" class="form-control" value="@if(!empty($item)){{ $item->name }}@endif" name="name" required="">
            </div>
         </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
               <label>Order<span style="color: red">*</span></label>
               <input type="number" maxlength="10" placeholder="Order" class="form-control" value="@if(!empty($item)){{ $item->order_by }}@endif" name="order_by" min="1" required="">
            </div>
         </div>
         <div class="col-sm-12 col-md-3">
            <div class="form-group">
               <label>Cafe Price<span style="color: red">*</span> </label>
               <input type="text" placeholder="Cafe Price" class="form-control number" value="@if(!empty($item)){{ $item->cafe_price }}@endif"  name="cafe_price" required="">
               <input type="checkbox" name="cafe_check" id="checkbox_id" value="1" class="haldish" @if(!empty($item) && $item->cafe_select == '1') checked @endif> <label for="checkbox_id" style="cursor: pointer;">Half Dish</label>
            </div>
         </div>
        <div class="col-sm-12 col-md-3">
            <div class="form-group">
               <label>Frozen Price<span style="color: red">*</span></label>
               <input type="text" placeholder="Frozen Price" class="form-control number" value="@if(!empty($item)){{ $item->frozen_price }}@endif" name="frozen_price" required="" >
               <input type="checkbox" name="frozen_check" id="checkbox_frozen"  value="1" class="haldish" @if(!empty($item) && $item->frozen_select == '1') checked @endif> <label for="checkbox_frozen" style="cursor: pointer;">Half Dish</label>
            </div>
         </div>
        <div class="col-sm-12 col-md-3">
            <div class="form-group">
               <label>Swiggy Price<span style="color: red">*</span></label>
               <input type="text" placeholder="Swiggy Price" class="form-control number" value="@if(!empty($item)){{ $item->swiggy_price }}@endif" name="swiggy_price" required="">
               <input type="checkbox" name="swiggy_check" id="checkbox_swiggy" value="1" class="haldish" @if(!empty($item) && $item->swiggy_select == '1') checked @endif> <label for="checkbox_swiggy" style="cursor: pointer;">Half Dish</label>
            </div>
         </div>
        <div class="col-sm-12 col-md-3">
            <div class="form-group">
               <label>Zomato Price<span style="color: red">*</span></label>
               <input type="text" placeholder="Zomato Price" class="form-control number" value="@if(!empty($item)){{ $item->zomato_price }}@endif" name="zomato_price" required="">
               <input type="checkbox" name="zomato_check" id="checkbox_zomato" value="1" class="haldish" @if(!empty($item) && $item->zomato_select == '1') checked @endif> <label for="checkbox_zomato" style="cursor: pointer;">Half Dish</label>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group">
               <label>Item Image</label>
               <input type="file" name="image1" accept="image/*"
                  class="form-control logo_image" style="padding: 3px;" 
                  placeholder="Profile image">
            </div>
         </div>
         @php $image = url('public/company/employee/default.png'); @endphp
         @if(!empty($item) && file_exists(public_path().'/company/employee/'.$item->image) && !empty($item->image))
         @php $image = url('public/company/employee/'.$item->image);  @endphp
         @endif
         <div class="col-sm-12 col-md-2">
            <span style=""><img src="{{$image}}" class="image_preview profile-user-img img-circle" style="width: 80px;
               height: 78px;margin-top: 13px; margin-left: 30px;"></span>
         </div>

      </div>
   </fieldset>
   <div class="col-md-12">
      <div class="form-group">
         <button type="submit" class="btn btn-primary  submitbutton pull-right"> Submit <span class="spinner"></span></button>
      </div>
   </div>
   
</form>

