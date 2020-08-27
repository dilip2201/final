@extends('admin.layouts.app')
@section('content')
@section('pageTitle', 'Items')
<style type="text/css">
  .quntitymask{
    text-align: center!important;
  }
</style>
<div class="container" style="max-width: 100%!important;">
   <!-- Info boxes -->
   <div class="row">
      <div class="col-12">
         <form action="{{ route('admin.pop.saveinvoice')}}" method="post" class="submitpos">
          {{ csrf_field() }}
          <input type="hidden" name="orderid" value="@if(!empty($order)){{ $order->id }}@endif">
           <section class="section-content  bg-default posscreen" style="margin-top: 10px;">
              <div class="container-fluid">
                 <div class="row">
                  
                    
                    
                      <input type="hidden" name="billno" value="{{$billno}}">
                      <input type="hidden" name="date" value="{{$date}}">
                      <input type="hidden" name="token_no" value="{{$count}}">
                      <input type="hidden" name="time" value="{{$time}}">


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
                                  
                                   <div class="col-md-6" style="float: left; ">
                                    <b>Token No. :</b> {{ $count }}
                                   </div>
                                   <div class=" col-md-6" style="float: left; text-align: right;">
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
                                        <input type="text" class="quntitymask checkquntity{{ $data->pivot->random_number }}" data-number="{{ $data->pivot->random_number }}" data-totalqty="{{ $data->pivot->quantity }}" value="{{ $data->pivot->quantity }}" style="width: 60%; text-align: right;">
                                       </div>
                                    </td>
                                    <td>
                                       <div class="price-wrap"> 
                                          <var class="price">{{ $data->pivot->price + 0 }}</var> 
                                       </div>
                                    </td>
                                     <td>
                                       <div class="price-wrap"> 
                                          <var class="allfinal finalprice{{ $data->pivot->random_number }}" totalprice="{{ $data->pivot->total_price }}">{{ $data->pivot->total_price + 0 }}</var> 
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
                             <dd class="text-right apeendtotal">@if(!empty($order)){{ $order->total_price + 0 }}@elseif(empty($order)){{'0'}}@endif</dd>
                          </dl>
                         
                          
                       </div> 
                       <div class="row">
                            @if(!empty($order))
                            <div class="col-md-3" style="margin-top: 15px;">          
                              <button type="submit" class="btn  btn-primary btn-block saveclick" style="padding: 15px 10px;
    font-size: 18px;"><i class="fa fa-floppy-o"></i> Update <span class="savespinner"></span></button>
                            </div>
                            <div class="col-md-4" style="margin-top: 15px;">
                            </div>
                            @endif
                            @if(empty($order))
                            <div class="col-md-3" style="margin-top: 15px;">          
                              <button type="submit" class="btn  btn-primary btn-block saveclick" style="padding: 15px 10px;
    font-size: 18px;"><i class="fa fa-floppy-o"></i> Save <span class="savespinner"></span></button>
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
                             <a class="nav-link selecttype" data-type="pizza"  data-toggle="pill" href="#nav-tab-paypal">
                             <i class="fa fa-tags "></i>  Pizza</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link selecttype" data-type="sandwich" data-toggle="pill" href="#nav-tab-bank">
                             <i class="fa fa-tags "></i>  Sandwich</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link selecttype" data-type="snacks" data-toggle="pill" href="#nav-tab-bank">
                             <i class="fa fa-tags "></i> Snacks</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link selecttype" data-type="drinks" data-toggle="pill" href="#nav-tab-bank">
                             <i class="fa fa-tags "></i> Drinks </a>
                          </li>
                        
                          <li class="nav-item">
                             <a class="nav-link selecttype" data-type="others" data-toggle="pill" href="#nav-tab-bank">
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; ">
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


@push('links')
<link href="{{ URL::asset('public/admin/assets/css/ui.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('public/admin/assets/css/OverlayScrollbars.css') }}" type="text/css" rel="stylesheet"/>
@endpush
@push('script')
<script src="{{ URL::asset('public/admin/assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/assets/js/OverlayScrollbars.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/admin/jquery.inputmask.bundle.js') }}"></script>
<script>
  function printDiv(divName) {
       var printContents = document.getElementById(divName).innerHTML;
       var originalContents = document.body.innerHTML;
   
       document.body.innerHTML = printContents;
        location.reload();
       window.print();
        
       document.body.innerHTML = originalContents;
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
      var price = $(this).data('cafe_price');  
      var selectedcustomertype = $('.selectedcustomertype').val();
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
                        <input type="text" class="quntitymask checkquntity`+random_number+`" data-number="`+random_number+`" data-totalqty="1" value="1" style="width:60%; text-align:center" >
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
      $(".quntitymask").inputmask('integer',{min:1, max:1000, allowMinus: false,allowPlus: false});
      var num = $('.checkquntity'+random_number).val();
      $('.checkquntity'+random_number).focus().val('').val(num);
      totalsum();
    });

    $('body').on('keyup','.quntitymask',function(){
        var finalqty = $(this).val();

        var number = $(this).data('number');
        $('.quntitychange'+number).val(finalqty);
        var price = $('.wholeproduct'+number).data('price');
        var finalprice = finalqty * price;
        
        $('.finalprice'+number).text(finalprice);

        $('.finalprice'+number).attr('totalprice', finalprice);
        $('.totalchange'+number).val(finalprice);


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
                      $(".add_modal").modal()
                      $('.testprint').html(data.html);
                     }
                }
            },
        });
    });

    /************************ Display price **************************/
    $('body').on('click','.priceclictoshow',function(){
        $('.priceclass').css('display','none');
        $('.full_table').html('');
        $('.addfull').html('');
        $('.full_table').html(`<tr class="removefist"><td colspan="5">No records found.</td></tr>`);
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