@if(!empty($items))
@foreach($items as $item)
<div class="master">
   <div class="left">
      <span>{{ $item->name }}</span>
   </div>
   @php
   $images = getimagesof($item->id,$school,$gender,$season,$standard);

   @endphp
   <div class="right">
      <div class="row">
         <div class="col-1">  
         </div>
         <div class="col-10">
            <div class="one-time">
              @if(!empty($images))
                @foreach($images as $image)
                <div class="item">
                  @if(!empty($image->file) && file_exists(public_path().'/thumbnail/'.$image->file))
                  @php $imagefile = url('public/thumbnail/'.$image->file); @endphp
                  @else
                  @php $imagefile = url('public/uniforms/default.png'); @endphp
                  @endif
                  <img class="myImg" data-item="{{ $item->id }}" data-school="{{ $school }}" data-gender="{{ $gender }}"  data-season="{{ $season }}"  data-standard="{{ $standard }}"  src="{{ $imagefile }}"  width="auto" height="90px;">
                  
                  @if(!empty($image->itemname))<label style="margin-bottom: 0px; width: 100%;">{{ $image->itemname->name ?? '' }} {{ ($image->itemname->ract_number ?? '') }}</label>  @endif
                  <label style="font-weight: 100; margin-bottom: 0px; width: 100%;" >{{ $image->remarks }}</label>
                 </div>
                @endforeach
              @endif
              @if(count($images) == 0)
                <div style="font-weight: 600; line-height :150px;">  N/A</div>
              @endif
               
               
            </div>
         </div>
         <div class="col-1">
         </div>
      </div>
      
   </div>
</div>
@endforeach
@endif

@if(count($items) == 0)
<p style="width: 100%; text-align: center;"> No records found.</p>
@endif