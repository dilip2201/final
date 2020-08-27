
@if(!empty($pizzaitems))
  
  @foreach($pizzaitems as $pizzaitem)
  <tr style="background: antiquewhite;">
     @if ($loop->first)
    <td  rowspan="{{ $pizzacount }}">Pizza</td>
    @endif
    <td >{{ $pizzaitem->item_code }}</td>
    <td style="text-align: left;">{{ $pizzaitem->name }}</td>
    <td>{{ getpricetodaymonthly($pizzaitem->id,'purchase',$startdate,$enddate) + 0}} </td>
    <td>{{ getpricetodaymonthly($pizzaitem->id,'sale',$startdate,$enddate) + 0}}</td>
    
    <td style="text-align: right;">{{ getpricetodaymonthly($pizzaitem->id,'total',$startdate,$enddate) + 0}}</td>
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
  <tr style="background: antiquewhite;">
     @if ($loop->first)
    <td  rowspan="{{ $sandwichcount }}">Sandwich</td>
    @endif
    <td >{{ $sandwichitem->item_code }}</td>
    <td style="text-align: left;">{{ $sandwichitem->name }}</td>
    <td>{{ getpricetodaymonthly($sandwichitem->id,'purchase',$startdate,$enddate) + 0}} </td>
    <td>{{ getpricetodaymonthly($sandwichitem->id,'sale',$startdate,$enddate) + 0}}</td>
    
    <td style="text-align: right;">{{ getpricetodaymonthly($sandwichitem->id,'total',$startdate,$enddate) + 0}}</td>
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
    <td  rowspan="{{ $snackscount }}">Snacks</td>
    @endif
    <td >{{ $snacksitem->item_code }}</td>
    <td style="text-align: left;">{{ $snacksitem->name }}</td>
    <td>{{ getpricetodaymonthly($snacksitem->id,'purchase',$startdate,$enddate) + 0}} </td>
    <td>{{ getpricetodaymonthly($snacksitem->id,'sale',$startdate,$enddate) + 0}}</td>
    
    <td style="text-align: right;">{{ getpricetodaymonthly($snacksitem->id,'total',$startdate,$enddate) + 0}}</td>
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
  <tr style="background: antiquewhite;">
     @if ($loop->first)
    <td  rowspan="{{ $drinkscount }}">Drinks</td>
    @endif
    <td >{{ $drinksitem->item_code }}</td>
    <td style="text-align: left;">{{ $drinksitem->name }}</td>
    <td>{{ getpricetodaymonthly($drinksitem->id,'purchase',$startdate,$enddate) + 0}} </td>
    <td>{{ getpricetodaymonthly($drinksitem->id,'sale',$startdate,$enddate) + 0}}</td>
    
    <td style="text-align: right;">{{ getpricetodaymonthly($drinksitem->id,'total',$startdate,$enddate) + 0}}</td>
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
  <tr style="background: antiquewhite;">
     @if ($loop->first)
    <td  rowspan="{{ $otherscount }}">Others</td>
    @endif
    <td >{{ $othersitem->item_code }}</td>
    <td style="text-align: left;">{{ $othersitem->name }}</td>
    <td>{{ getpricetodaymonthly($othersitem->id,'purchase',$startdate,$enddate)  + 0}} </td>
    <td>{{ getpricetodaymonthly($othersitem->id,'sale',$startdate,$enddate)  + 0}}</td>
    
    <td style="text-align: right;">{{ getpricetodaymonthly($othersitem->id,'total',$startdate,$enddate) + 0}}</td>
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
<tr>
  <td style="border: 0px;"></td>
  <td style="border: 0px;"></td>
  <td style="border: 0px;"></td>
  <td style="border: 0px;"></td>
  <td> Total : <b>{{ gettotalmonthly($startdate,$enddate) }}</b></td>
  <td style="text-align: right;">Total : <b>{{ gettotalamountmonthly($startdate,$enddate) + 0 }}</b></td>
</tr>

<tr>

<td style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    <td style="border: 0px;"></td>
    </tr>
<tr style="background: none;">
  <td style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td  style="border: 0px;"></td>
    <td style="text-align: right;">Cash : <b> {{ cashtotalmonthly($startdate,$enddate) + 0 }}</b>
     <br> Paytm : <b> {{ paytmtotalmonthly($startdate,$enddate) + 0 }}</b>
     <br> Swiggy : <b> {{ swiggytotalmonthly($startdate,$enddate) + 0 }}</b>
     <br> Zomato : <b> {{ zomatototalmonthly($startdate,$enddate) + 0 }}</b>
   </td>
  </tr>

