@extends('admin.layouts.app')
@section('content')
@section('pageTitle', 'Items')
<style type="text/css">
  .posscreen .table td, .posscreen .table th{
        vertical-align: middle;
        padding: 6px 10px;
        color: #000;
        text-align: center;

  }
  .shopping-cart-wrap .price{
        color: #45a2b7;
  }
</style>
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
<div class="container" style="max-width: 100%!important;">
   <!-- Info boxes -->
   <div class="row">
      <div class="col-12">
         <form action="{{ route('admin.pos.saveinvoice')}}" method="post" class="submitpos">
          {{ csrf_field() }}
          <input type="hidden" name="orderid" value="@if(!empty($order)){{ $order->id }}@endif">
           <section class="section-content  bg-default posscreen" style="margin-top: 10px;">
              <div class="container-fluid">
                 <div class="row">
                  <div class="col-md-12 customertypeclass">
                    <div class="col-md-6 padding-y-sm card card-primary card-outline">
                      <ul class="nav bg radius nav-pills nav-fill bg" role="tablist">
                        <input type="hidden" class="selectedcustomertype" value="cafe_price">
                          <li class="nav-item">
                             <a class="nav-link  priceclictoshow @if(!empty($order) && $order->customer_type == 'cafe')) active @endif @if(empty($order)) active @endif" data-type="cafe" data-toggle="pill" href="#nav-tab-card" style="font-size: 20px;">
                             <i class="fa fa-tags"></i> Café</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link priceclictoshow @if(!empty($order) && $order->customer_type == 'frozen')) active @endif" data-type="frozen"  data-toggle="pill" href="#nav-tab-paypal" style="font-size: 20px;">
                             <i class="fa fa-tags "></i> Frozen</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link priceclictoshow @if(!empty($order) && $order->customer_type == 'zomato')) active @endif" data-type="zomato" data-toggle="pill" href="#nav-tab-bank" style="font-size: 20px;">
                             <i class="fa fa-tags "></i>Zomato</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link priceclictoshow @if(!empty($order) && $order->customer_type == 'swiggy')) active @endif" data-type="swiggy" data-toggle="pill" href="#nav-tab-bank" style="font-size: 20px;">
                             <i class="fa fa-tags "></i> Swiggy </a>
                          </li>

                       </ul>
                    </div>
                  </div>
                    
                    
                      <input type="hidden" name="billno" value="{{$billno}}">
                      <input type="hidden" name="date" value="{{$date}}">
                      <input type="hidden" name="token_no" value="{{$count}}">
                      <input type="hidden" name="time" value="{{$time}}">



                      <input type="hidden" class="paymenttype" name="paymenttype" value="@if(!empty($order)){{ $order->customer_type }}@elseif(empty($order)){{'cafe'}}@endif">
                      <input type="hidden" class="totalfinalpricehidden" name="finalprice" value="@if(!empty($order)){{ $order->total_price }}@elseif(empty($order)){{'0'}}@endif">
                      <input type="hidden" class="savetype" name="save" value="save">
                      <div class="addfull" style="display: none;">

                         @if(!empty($order))
                          @foreach($order->items as $data)
                            <div class="remove{{ $data->pivot->random_number }}">
                              <input type="hidden"  name="data[{{ $data->pivot->random_number }}][id]" value="{{ $data->pivot->item_id }}">
                              <input type="hidden"  name="data[{{ $data->pivot->random_number }}][price]" value="{{ $data->pivot->price }}"> 
                              <input type="hidden" class="quntitychange{{ $data->pivot->random_number }}" name="data[{{ $data->pivot->random_number }}][qty]" value="{{ $data->pivot->quantity }}">
                              <input type="hidden" class="totalchange{{ $data->pivot->random_number }}" name="data[{{ $data->pivot->random_number }}][finalprice]" value="{{ $data->pivot->total_price }}">
                            </div>
                          @endforeach
                        @endif
                        


                      </div>
                    <div class="col-md-5 ">
                       <div class="card card-primary card-outline">
                          <span id="cart">
                            <div class="col-lg-12" style="margin-top: 10px;">
                                 <div class="card-body" style="padding: 5px 0px;">
                                   <div class="col-md-6" style="float: left;">
                                    <b>Date :</b> {{ $date }}
                                   </div>
                                   <div class="col-md-6" style="float: left; text-align: right;">
                                    <b>Bill No.:</b> {{ $billno }}
                                   </div>
                                   <div class="col-md-6" style="float: left;">
                                    <b>Payment Mode :</b> 
                                      <select class="payment_mode" name="payment_mode" style="    width: 114px;
    height: 43px;
    padding-left: 8px;
    font-size: 21px;">
                                        <option value="cash" @if(!empty($order) && $order->payment_mode == 'cash')  selected @endif >cash</option>
                                        <option value="paytm" @if(!empty($order) && $order->payment_mode == 'paytm')  selected @endif>Paytm</option>
                                        <option value="zomato" @if(!empty($order) && $order->payment_mode == 'zomato')  selected @endif>Zomato</option>
                                        <option value="swiggy" @if(!empty($order) && $order->payment_mode == 'swiggy')  selected @endif>Swiggy</option>
                                        <option value="other" @if(!empty($order) && $order->payment_mode == 'other')  selected @endif>Other</option>
                                      </select>
                                    
                                   </div>
                                   <div class="col-md-6" style="float: left; text-align: right;">
                                    <b>Token No. :</b> {{ $count }}
                                   </div>
                                   <div class="offset-6 col-md-6" style="float: left; text-align: right;">
                                    <b>Time :</b><span class="timeload">{{ $time }}</span>
                                   </div>
                                 </div>
                              </div>
                              <hr style="margin-bottom: 0px; margin-top:10px; border-top: 1px solid rgba(0,0,0,.4);">
                             <table class="table table-hover shopping-cart-wrap">
                                <thead class="text-muted">
                                   <tr>
                                      <th scope="col" width="10">#</th>
                                      <th scope="col" width="120">Item Name</th>
                                      <th scope="col" width="120">Qty</th>
                                      <th scope="col" width="60">Rate</th>
                                      <th scope="col" width="60">Total</th>
                                   </tr>
                                </thead>
                                <tbody class="full_table">

                                  @if(!empty($order))
                                    @foreach($order->items as $data)
                                  <tr class="wholeproduct{{ $data->pivot->random_number }} remove{{ $data->pivot->random_number }}" data-price="{{ $data->pivot->price }}">
                                    <td><i class="fa fa-trash removeproduct" data-id="{{ $data->pivot->random_number }}" style="color: red; cursor: pointer;"></i></td>
                                    <td>
                                       <figure class="media">
                                       
                                          <figcaption class="media-body">{{ $data->name }}
                                          </figcaption>
                                       </figure>
                                    </td>
                                    <td class="text-center">
                                       <div class="m-btn-group m-btn-group--pill btn-group "   role="group" aria-label="...">
                                          <button type="button" class="m-btn btn btn-default eventclick" data-type="minus" data-id="{{ $data->pivot->random_number }}"  style="background: #ff8383;"><i class="fa fa-minus"></i></button>

                                          <button type="button" class="m-btn btn btn-default checkquntity{{ $data->pivot->random_number }}" data-totalqty="{{ $data->pivot->quantity }}" disabled>{{ $data->pivot->quantity }}</button>

                                          <button type="button" class="m-btn btn btn-default eventclick" data-type="plus" data-id="{{ $data->pivot->random_number }}" style="background: #95c182;"><i class="fa fa-plus"></i></button>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="price-wrap"> 
                                          <var class="price">{{ $data->pivot->price }}</var> 
                                       </div>
                                    </td>
                                     <td>
                                       <div class="price-wrap"> 
                                          <var class="allfinal finalprice{{ $data->pivot->random_number }}" totalprice="{{ $data->pivot->total_price }}">{{ $data->pivot->total_price }}</var> 
                                       </div>
                                       <!-- price-wrap .// -->
                                    </td>
                                  </tr>
                                  @endforeach
                                    @endif

                                  @if(empty($order))
                                   <tr class="removefist">
                                    <td colspan="5">No records found.</td>
                                   </tr>
                                   @endif

                                </tbody>
                             </table>
                          </span>
                       </div>
                       <!-- card.// -->
                       <div class="box">
                          
                          <dl class="dlist-align">
                             <dt>Net Amount :</dt>
                             <dd class="text-right apeendtotal">@if(!empty($order)){{ $order->total_price }}@elseif(empty($order)){{'0'}}@endif</dd>
                          </dl>
                         
                          
                       </div> 
                       <div class="row">
                            @if(!empty($order))
                            <div class="col-md-3" style="margin-top: 15px;">          
                              <button type="submit" class="btn  btn-primary btn-block saveclick" style="padding: 15px 10px;
    font-size: 18px;"><i class="fa fa-floppy-o"></i> Update <span class="savespinner"></span></button>
                            </div>
                            <div class="col-md-4" style="margin-top: 15px;">
                              <button  type="submit" class="btn  btn-primary btn-block saveprintclick" style="padding: 15px 10px;
    font-size: 18px;"><i class="fa fa-print" aria-hidden="true"></i> Update & Print <span class="saveprintspinner"></span></button>
                            </div>
                            @endif
                            @if(empty($order))
                            <div class="col-md-3" style="margin-top: 15px;">          
                              <button type="submit" class="btn  btn-primary btn-block saveclick" style="padding: 15px 10px;
    font-size: 18px;"><i class="fa fa-floppy-o"></i> Save <span class="savespinner"></span></button>
                            </div>
                            <div class="col-md-4" style="margin-top: 15px;">
                              <button  type="submit" class="btn  btn-primary btn-block saveprintclick" style="padding: 15px 10px;
    font-size: 18px;"><i class="fa fa-print" aria-hidden="true"></i> Save & Print <span class="saveprintspinner"></span></button>
                            </div>
                            @endif
                        </div>
                    </div>
                      
                  

                    <div class="col-md-7  padding-y-sm card card-primary card-outline">
                       <ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
                          <li class="nav-item">
                             <a class="nav-link active selecttype" data-type="all" data-toggle="pill" href="#nav-tab-card">
                             <i class="fa fa-tags"></i> All</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link selecttype" data-type="pizza"  data-toggle="pill" href="#nav-tab-paypal" >
                             <i class="fa fa-tags "></i>  Pizza</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link selecttype" data-type="sandwich" data-toggle="pill" href="#nav-tab-bank" >
                             <i class="fa fa-tags "></i>  Sandwich</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link selecttype" data-type="snacks" data-toggle="pill" href="#nav-tab-bank" >
                             <i class="fa fa-tags "></i> Snacks</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link selecttype" data-type="drinks" data-toggle="pill" href="#nav-tab-bank" >
                             <i class="fa fa-tags "></i> Drinks </a>
                          </li>
                        
                          <li class="nav-item">
                             <a class="nav-link selecttype" data-type="others" data-toggle="pill" href="#nav-tab-bank" >
                             <i class="fa fa-tags "></i>  Others</a>
                          </li>
                       </ul>
                       <span   id="items">
                            <div class="row">

                              @if(!empty($items))
                                @foreach($items as $item)
                                <div class="col-md-3 {{ $item->group_name }} itemall itemclass">
                                    <a class="selectevent productaddclick" data-itemid="{{ $item->id }}" data-name="{{ $item->name }}" data-frozen_price="{{ $item->frozen_price + 0 }}" data-cafe_price="{{ $item->cafe_price + 0 }}" data-zomato_price="{{ $item->zomato_price + 0 }}" data-swiggy_price="{{ $item->swiggy_price + 0 }}"> 
                                      <figure class="card-product">
                                       <figcaption class="info-wrap">
                                          <span style="line-height: 15px; font-size: 16px; margin-top: 12px; display: block;">
                                            {{ $item->name }}
                                          </span>
                                          <div class="action-wrap">
                                             <div class="price-wrap h5 cafe priceclass">
                                                <span class="price-new" style="font-size: 15px;">&#8377;{{ $item->cafe_price + 0 }}</span>
                                             </div>
                                             <div class="price-wrap h5 frozen priceclass" style="display: none;">
                                                <span class="price-new" style="font-size: 15px;">&#8377;{{ $item->frozen_price + 0 }}</span>
                                             </div>
                                             <div class="price-wrap h5 zomato priceclass" style="display: none;">
                                                <span class="price-new" style="font-size: 15px;">&#8377;{{ $item->zomato_price + 0 }}</span>
                                             </div>
                                              <div class="price-wrap h5 swiggy priceclass" style="display: none;">
                                                <span class="price-new" style="font-size: 15px;">&#8377;{{ $item->swiggy_price + 0 }}</span>
                                             </div>
                                             <!-- price-wrap.// -->
                                          </div>
                                          <!-- action-wrap -->
                                        </figcaption>
                                      </figure>
                                    </a>
                                    <!-- card // -->
                                </div>
                                @endforeach
                              @endif
                            </div>
                            <div class="row">

                            </div>
                          <!-- row.// -->
                        </span>
                    </div>
                   
                 </div>
              </div>
           </section>
           </form>
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


@push('links')
<link href="{{ URL::asset('public/admin/assets/css/ui.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('public/admin/assets/css/OverlayScrollbars.css') }}" type="text/css" rel="stylesheet"/>
@endpush
@push('script')
<script src="{{ URL::asset('public/admin/assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/assets/js/OverlayScrollbars.js') }}" type="text/javascript"></script>


<script>
  function reoloadthepage(){
    location.reload();
  }
  function printtwo(){
        var printContents = document.getElementById("testprint").innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = printContents;
       window.print();
       
       document.body.innerHTML = originalContents;
       reoloadthepage();
  }
  function printDiv() {

       var printContents = document.getElementById("testprint").innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = printContents;
       window.print();
       
       document.body.innerHTML = originalContents;
       printtwo();
   }
   function PrintTicket() {
      $('.modal-body').removeAttr('id');
      window.print();
      $('.modal-body').attr('id', 'modal-body');
   }
  function totalsum(){
    var sum = 0;
    $('.allfinal').each(function() {
        sum += Number($(this).attr('totalprice'));
    });

    $('.apeendtotal').text(sum);
    $('.totalfinalpricehidden').val(sum);
    
    
  }
   $(function() {

    /****************** while edit functionality ***************************/
    @if(!empty($order))
    var customer_type = "{{ $order->customer_type }}";
    
        $('.priceclass').css('display','none');
        
        if(customer_type == 'cafe'){
          $('.selectedcustomertype').val('cafe_price');
          
          $('.paymenttype').val('cafe');
        }
        if(customer_type == 'zomato'){
          $('.selectedcustomertype').val('zomato_price');
          
          $('.paymenttype').val('zomato');
        }
        if(customer_type == 'swiggy'){
          $('.selectedcustomertype').val('swiggy_price');
          
          $('.paymenttype').val('swiggy');
        }
        if(customer_type == 'frozen'){
          $('.selectedcustomertype').val('frozen_price');
          
          $('.paymenttype').val('frozen');
        }
        $('.'+customer_type).css('display','block');

    @endif 

    $('body').on('click','.saveclick',function(){
      $('.savetype').val('save');
    })
    $('body').on('click','.saveprintclick',function(){
      $('.savetype').val('saveprint');
    })
   // display_ct();
    $('body').on('click','.productaddclick',function(){
      var random_number =  Math.floor(Math.random() * 1000000);
      var name = $(this).data('name');
      var selectedcustomertype = $('.selectedcustomertype').val();
      if(selectedcustomertype == 'cafe_price'){
        var price = $(this).data('cafe_price');  
      }
      if(selectedcustomertype == 'zomato_price'){
        var price = $(this).data('zomato_price');  
      }
      if(selectedcustomertype == 'swiggy_price'){
        var price = $(this).data('swiggy_price');  
      }
      if(selectedcustomertype == 'frozen_price'){
        var price = $(this).data('frozen_price');  
      }

      var itemid = $(this).data('itemid');
      $('.removefist').remove();
      var html = `<tr class="wholeproduct`+random_number+` remove`+random_number+`" data-price="`+price+`">
                  <td><i class="fa fa-trash removeproduct" data-id="`+random_number+`" style="color: red; cursor: pointer;"></i></td>
                  <td>
                     <figure class="media">
                     
                        <figcaption class="media-body">`+name+`
                        </figcaption>
                     </figure>
                  </td>
                  <td class="text-center">
                     <div class="m-btn-group m-btn-group--pill btn-group "   role="group" aria-label="...">
                        <button type="button" class="m-btn btn btn-default eventclick" data-type="minus" data-id="`+random_number+`"  style="background: #ff8383;"><i class="fa fa-minus"></i></button>

                        <button type="button" class="m-btn btn btn-default checkquntity`+random_number+`" data-totalqty="1" disabled>1</button>

                        <button type="button" class="m-btn btn btn-default eventclick" data-type="plus" data-id="`+random_number+`" style="background: #95c182;"><i class="fa fa-plus"></i></button>
                     </div>
                  </td>
                  <td>
                     <div class="price-wrap"> 
                        <var class="price">`+price+`</var> 
                     </div>
                  </td>
                   <td>
                     <div class="price-wrap"> 
                        <var class="allfinal finalprice`+random_number+`" totalprice="`+price+`">`+price+`</var> 
                     </div>
                     <!-- price-wrap .// -->
                  </td>
                </tr>`;
      $('.full_table').append(html);
      var appentht = `<div class="remove`+random_number+`"><input type="hidden"  name="data[`+random_number+`][id]" value="`+itemid+`"><input type="hidden"  name="data[`+random_number+`][price]" value="`+price+`"> <input type="hidden" class="quntitychange`+random_number+`" name="data[`+random_number+`][qty]" value="1"><input type="hidden" class="totalchange`+random_number+`" name="data[`+random_number+`][finalprice]" value="`+price+`"></div>`;
      $('.addfull').append(appentht);
      totalsum();
    });

    $('body').on('click','.eventclick',function(){
        var number = $(this).data('id');
        var qty = $('.checkquntity'+number).data('totalqty');
        console.log(qty);
        var type = $(this).data('type');
        var price = $('.wholeproduct'+number).data('price');
        if(type == 'plus'){
          var finalqty = qty+1;
        }
        if(type == 'minus'){
          var finalqty = qty-1; 
        }
        if(finalqty == 0){
          finalqty = 1;
        }
         $(".checkquntity"+number).data("totalqty",finalqty);
        
        $('.checkquntity'+number).text(finalqty);
        var finalprice = finalqty * price;
        
        $('.finalprice'+number).text(finalprice);

        $('.finalprice'+number).attr('totalprice', finalprice);
        $('.totalchange'+number).val(finalprice);
        $('.quntitychange'+number).val(finalqty);


        totalsum()
    })

    $('body').on('click','.removeproduct',function(){
      var id = $(this).data('id');
      $('.remove'+id).remove();
      totalsum()
    })


    /******************** disply items ****************************/
    $('body').on('click','.selecttype',function(){
      var type = $(this).data('type');
      if(type == 'all'){
          $('.itemall').css('display','block');
      }
      else{
        $('.itemall').css('display','none');
        $('.'+type).css('display','block');
      }
    });
    /******************** disply items ****************************/

    /******** form submit **********/
    $('body').on('submit', '.submitpos', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: new FormData(this),
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                if($('.savetype').val() == 'save'){
                  $('.savespinner').html('<i class="fa fa-spinner fa-spin"></i>')  
                }else{
                  $('.saveprintspinner').html('<i class="fa fa-spinner fa-spin"></i>')  
                }
                
            },
            success: function (data) {
               $('.savespinner').html('');
                    $('.saveprintspinner').html('');
                if (data.status == 400) {
                    
                    toastr.error(data.msg)
                }
                if (data.status == 200) {
                  
                    if(data.type == 'save'){
                       location.reload();
                     }
                     if(data.type == 'saveprint'){
                      $(".add_modal").modal({
                         backdrop: 'static',
                         keyboard: false
                      })
                      $('.testprint').html(data.html);
                      printDiv();
                     }
                }
            },
        });
    });

    /************************ Display price **************************/
    $('body').on('click','.priceclictoshow',function(){
      
      var type = $(this).data('type');
        $('.priceclass').css('display','none');
        $('.full_table').html('');
        $('.addfull').html('');
        $('.full_table').html(`<tr class="removefist"><td colspan="5">No records found.</td></tr>`);
        $(".payment_mode option").removeAttr("selected");
        if(type == 'cafe'){
          $('.selectedcustomertype').val('cafe_price');
          $(".payment_mode option[value='cash']").attr("selected","selected");
          $('.paymenttype').val('cafe');
        }
        if(type == 'zomato'){
          $('.selectedcustomertype').val('zomato_price');
          $(".payment_mode option[value='zomato']").attr("selected","selected");
          $('.paymenttype').val('zomato');
        }
        if(type == 'swiggy'){
          $('.selectedcustomertype').val('swiggy_price');
          $(".payment_mode option[value='swiggy']").attr("selected","selected");
          $('.paymenttype').val('swiggy');
        }
        if(type == 'frozen'){
          $('.selectedcustomertype').val('frozen_price');
          $(".payment_mode option[value='cash']").attr("selected","selected");
          $('.paymenttype').val('frozen');
        }
        $('.'+type).css('display','block');
      
    });

    
   //The passed argument has to be at least a empty object or a object with your desired options
   //$("body").overlayScrollbars({ });
   $("#items").height(552);
   $("#items").overlayScrollbars({overflowBehavior : {
       x : "hidden",
       y : "scroll"
   } });
   $("#cart").height(500);
   $("#cart").overlayScrollbars({ });
   });
</script>
@endpush
@endsection