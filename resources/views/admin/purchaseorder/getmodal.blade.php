
            <span class="float-left" style="width: 100%;text-align: right;">Token No. : {{ $order->order_number }}</span>
            <span class="float-left" s>NO : {{ $order->bill_no }}</span>
            <div style="clear:both;">
               <span class="float-left" style="margin-bottom: 7px; ">Date: {{ date('d M Y',strtotime($order->created_at))}}</span>
<table class="table table-hover">
  <thead>
    <tr>
      
      <th scope="col">Item Name</th>
      <th scope="col">Quantity</th>
       <th scope="col">Rate</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
    
 @if(!empty($order))
                       @foreach($order->items as $data)
                       <tr>
                          <td >{{ $data->name }}</td>
                          <td >{{ $data->pivot->quantity }}</td>
                          <td >{{ $data->pivot->price + 0 }}</td>
                          <td >{{ $data->pivot->total_price + 0 }}</td>
                       </tr>
                       @endforeach
@endif

                  @if(count($order->items) == 0)
                  <tr>
                     <td style="text-align: center;" colspan="3"> No record found.</td>
                  </tr>
                  @endif

 
  </tbody>
</table>