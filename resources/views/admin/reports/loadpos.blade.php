
@if(!empty($pizzaitems))
  
  @foreach($pizzaitems as $pizzaitem)
  <tr style="background: antiquewhite;">
     @if ($loop->first)
    <td  rowspan="{{ $pizzacount }}">Pizza</td>
    @endif
    <td >{{ $pizzaitem->item_code }}</td>
    <td style="text-align: left;">{{ $pizzaitem->name }}</td>
    <td>{{ getpricetoday($pizzaitem->id,'opning',$date) + 0}}</td>
    <td>{{ getpricetoday($pizzaitem->id,'purchase',$date) + 0}}</td>
    <td>{{ getpricetoday($pizzaitem->id,'sale',$date) + 0}}</td>
    <td>{{ getpricetoday($pizzaitem->id,'closing',$date) + 0}}</td>
    <td style="text-align: right;">{{ getpricetoday($pizzaitem->id,'total',$date) + 0}}</td>
  </tr>
  @endforeach
@endif
<tr>
  <td style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
</tr>
@if(!empty($sandwichitems))
  
  @foreach($sandwichitems as $sandwichitem)
  <tr style="background: antiquewhite">
     @if ($loop->first)
    <td rowspan="{{ $sandwichcount }}">Sandwich</td>
    @endif
    <td >{{ $sandwichitem->item_code }}</td>
    <td style="text-align: left;">{{ $sandwichitem->name }}</td>
    <td>{{ getpricetoday($sandwichitem->id,'opning',$date) + 0}}</td>
    <td>{{ getpricetoday($sandwichitem->id,'purchase',$date) + 0}}</td>
    <td>{{ getpricetoday($sandwichitem->id,'sale',$date) + 0}}</td>
    <td>{{ getpricetoday($sandwichitem->id,'closing',$date) + 0}}</td>
    <td style="text-align: right;">{{ getpricetoday($sandwichitem->id,'total',$date) + 0}}</td>
  </tr>
  @endforeach
@endif
<tr>
  <td style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
</tr>
@if(!empty($snacksitems))
  @foreach($snacksitems as $snacksitem)
  <tr style="background: antiquewhite;">
     @if ($loop->first)
    <td rowspan="{{ $snackscount }}">Snacks</td>
    @endif
    <td >{{ $snacksitem->item_code }}</td>
    <td style="text-align: left;">{{ $snacksitem->name }}</td>
    <td>{{ getpricetoday($snacksitem->id,'opning',$date) + 0}}</td>
    <td>{{ getpricetoday($snacksitem->id,'purchase',$date) + 0}}</td>
    <td>{{ getpricetoday($snacksitem->id,'sale',$date) + 0}}</td>
    <td>{{ getpricetoday($snacksitem->id,'closing',$date) + 0}}</td>
    <td style="text-align: right;">{{ getpricetoday($snacksitem->id,'total',$date) + 0}}</td>
  </tr>
  @endforeach
@endif
<tr>
  <td style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
</tr>
@if(!empty($drinksitems))
  @foreach($drinksitems as $drinksitem)
  <tr style="background: antiquewhite">
     @if ($loop->first)
    <td rowspan="{{ $drinkscount }}">Drinks</td>
    @endif
    <td >{{ $drinksitem->item_code }}</td>
    <td style="text-align: left;">{{ $drinksitem->name }}</td>
    <td>{{ getpricetoday($drinksitem->id,'opning',$date) + 0}}</td>
    <td>{{ getpricetoday($drinksitem->id,'purchase',$date) + 0}}</td>
    <td>{{ getpricetoday($drinksitem->id,'sale',$date) + 0}}</td>
    <td>{{ getpricetoday($drinksitem->id,'closing',$date) + 0}}</td>
    <td style="text-align: right;">{{ getpricetoday($drinksitem->id,'total',$date) + 0}}</td>
  </tr>
  @endforeach
@endif
<tr>
  <td style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
</tr>
@if(!empty($othersitems))
  @foreach($othersitems as $othersitem)
  <tr style="background: antiquewhite">
     @if ($loop->first)
    <td rowspan="{{ $otherscount }}">Others</td>
    @endif
    <td >{{ $othersitem->item_code }}</td>
    <td style="text-align: left;">{{ $othersitem->name }}</td>
    <td>{{ getpricetoday($othersitem->id,'opning',$date) + 0}}</td>
    <td>{{ getpricetoday($othersitem->id,'purchase',$date) + 0}}</td>
    <td>{{ getpricetoday($othersitem->id,'sale',$date) + 0}}</td>
    <td>{{ getpricetoday($othersitem->id,'closing',$date) + 0}}</td>
    <td style="text-align: right;">{{ getpricetoday($othersitem->id,'total',$date) + 0}}</td>
  </tr>
  @endforeach
@endif


<tr>
  <td style="border: 0px;"></td>
  <td style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td> Total : <b>{{ gettotal($date) }}</b></td>
    <td style="border: 0px;"></td>
    <td style="text-align: right;">Total : <b>{{ gettotalamount($date) + 0 }}</b></td>
  </tr>

<tr>
</tr>
<td style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
<tr style="background: none;">
  <td style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="text-align: right;">Cash : <b> {{ cashtotal($date) + 0 }}</b>
     <br> Paytm : <b> {{ paytmtotal($date) + 0 }}</b>
     <br> Swiggy : <b> {{ swiggytotal($date) + 0 }}</b>
     <br> Zomato : <b> {{ zomatototal($date) + 0 }}</b>
   </td>
  </tr>
