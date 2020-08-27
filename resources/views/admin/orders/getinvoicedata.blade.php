<div class="modal-body" >
   <div class="print" id = "printSection">
      <div class="col-md-12">
         <div class="text-center">
            <font face="Tahoma, Lucida Grande, Trebuchet MS, Verdana, Helvetica, sans-serif">
            <span style="font-size: 14px;">{{ getvalue('name') }}</span></font>
         </div>
         <div class="text-center">
            <font face="Tahoma, Lucida Grande, Trebuchet MS, Verdana, Helvetica, sans-serif">
            <span style="font-size: 14px;">GST No. {{ getvalue('gst_number') }}</span></font>
         </div>
         <div style="clear:both;">
            <div style="clear:both;"></div>
            <table class="table" cellspacing="0" border="0" style="margin-bottom:5px;font-size: 14px;  margin-top: 5px;">
               <tbody>
                  <tr>
                     <td style="padding: 5px 10px;
                        text-align: center;
                        border-top: 1px dashed;
                        border-bottom: 1px dashed; ">RETAIL INVOICE</td>
                  </tr>
               </tbody>
            </table>
            <span class="float-left" style="width: 100%;text-align: center; font-size: 16px;">Token No. : {{ $order->order_number }}</span>
            <span class="float-left" style="width: 50%;text-align: left; font-size: 13px;">Time : {{ $order->time }}</span>
            <span class="float-left" style="width: 50%; text-align: right; font-size: 13px;">NO : {{ $order->bill_no }}</span>
            <div style="clear:both;">
               <span class="float-left" style="margin-bottom: 7px; font-size: 13px;">Date: {{ date('d M Y',strtotime($order->created_at))}}</span>
               <div style="clear:both;"></div>
               <table class="table printtable" id="printtable" style="margin-bottom: 0px;" cellspacing="0" border="0">
                  <thead style="border-top: 1px dashed;
                     border-bottom: 1px dashed;">
                     <tr>
                        <th style="border:none; font-size: 13px; padding: 3px 3px;">Item Name</th>
                        <th style="border:none; font-size: 13px;  padding: 3px 3px;text-align: center;">Qty.</th>
                        <th style="border:none; font-size: 13px;  padding: 3px 3px;text-align: right;">Amount</th>
                     </tr>
                  </thead>
                  <tbody style="border-bottom: 1px dashed;">
                     @if(!empty($order))
                       @foreach($order->items as $data)
                       <tr>
                          <td style="border:none; font-size: 12px; padding: 3px 3px;">{{ $data->name }}</td>
                          <td  style="border:none;text-align: center; font-size: 12px; padding: 3px 3px;">{{ $data->pivot->quantity }}</td>
                          <td  style="border:none;text-align: right; font-size: 12px; padding: 3px 3px;">{{ $data->pivot->total_price + 0 }}</td>
                       </tr>
                       @endforeach
                     @endif
                     
                  </tbody>
               </table>
               <table class="table" cellspacing="0" border="0" style="margin-bottom:5px;">
                  <tbody>
                     <tr>
                        <td colspan="3" style="text-align:right;border: none!important; font-size: 14px;">Net Amount</td>
                        <td colspan="1" style="text-align:right; font-weight:bold;border: none!important;  font-size: 14px;">{{ $order->total_price + 0}} </td>
                     </tr>
                  </tbody>
               </table>
               <table class="table" cellspacing="0" border="0" style="margin-bottom:8px;">
                  <tbody>
                     <tr>
                        <td colspan="3" style="text-align:left; padding-left:1.5%;border: none!important; font-size: 14px;">Thanks You....Visit Again.....</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
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
margin-top: -3cm
/ Top margin on first page 10cm /
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