<div class="modal-body" id="modal-body" style="    max-height: calc(100vh - 200px);
    overflow-y: auto;">
   <div class="print" id = "printSection">
      <div class="col-md-12">
         <div class="text-center">
            <font face="Tahoma, Lucida Grande, Trebuchet MS, Verdana, Helvetica, sans-serif">
               <span style="font-size: 15.4px;">Rudra Enterprise</span></font>
            
         </div>
         <div class="text-center">
            <font face="Tahoma, Lucida Grande, Trebuchet MS, Verdana, Helvetica, sans-serif">
               <span style="font-size: 15.4px;">GST No. GSTIN435435435</span></font>
            
         </div>

         <div style="clear:both;">
            <div style="clear:both;"></div>
             <table class="table" cellspacing="0" border="0" style="margin-bottom:5px;font-size: 14px;  margin-top: 5px;">
                  <tbody>
                     <tr>
                        <td style="padding: 10px 10px;
    text-align: center;
    border-top: 1px dashed;
    border-bottom: 1px dashed; ">RETAIL INVOICE</td>
                     </tr>
                  </tbody>
               </table>
            <span class="float-left" style="width: 100%;text-align: right; font-size: 13px;">Token No. : 25</span>
            <span class="float-left" style=" font-size: 13px;">NO : 04072020-80</span>
            <div style="clear:both;">
               <span class="float-left" style="margin-bottom: 7px; font-size: 13px;">Date: 04-07-2020</span>
               <div style="clear:both;"></div>

               <table class="table printtable" id="printtable" style="margin-bottom: 0px;" cellspacing="0" border="0">
                  <thead style="border-top: 1px dashed;
    border-bottom: 1px dashed;">
                     <tr>
                        <th style="border:none; font-size: 14px; padding: 3px 3px;">Item Name</th>
                        <th style="border:none; font-size: 14px;  padding: 3px 3px;text-align: center;">Qty.</th>
                        <th style="border:none; font-size: 14px;  padding: 3px 3px;text-align: right;">Amount</th>
                     </tr>
                  </thead>
                  <tbody style="border-bottom: 1px dashed;">
                    @foreach($orders as $order)
                    @foreach($order->totalitems as $data)
                     <tr>
                        <td style="border:none; font-size: 14px; padding: 3px 3px;">{{ $data->name }}</td>
                        <td  style="border:none;text-align: center; font-size: 14px; padding: 3px 3px;">{{ $data->pivot->quantity }}</td>
                        <td  style="border:none;text-align: right; font-size: 14px; padding: 3px 3px;">{{ $data->pivot->price }}</td>
                        
                     </tr>
                   @endforeach
                   @endforeach
                  </tbody>
               </table>
         
               <table class="table" cellspacing="0" border="0" style="margin-bottom:5px;">
                  <tbody>
                     <tr>
  
                        <td colspan="3" style="text-align:right; padding-left:1.5%;border: none!important; font-size: 14px;">Net Amount</td>
                        @foreach($orders as $order)
                        <td colspan="1" style="text-align:right;font-weight:bold;border: none!important;  font-size: 14px;">{{ $order->total_price}} </td>
                        @endforeach
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