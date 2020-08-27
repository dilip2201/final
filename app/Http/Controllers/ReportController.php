<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\StockLog;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
        return view('admin.reports.index');
    }

    public function loadpos(Request $request){
    	$pizzaitems = Item::where('group_name','pizza')->get();
        $pizzacount = $pizzaitems->count();

        $sandwichitems = Item::where('group_name','sandwich')->get();
        $sandwichcount = $sandwichitems->count(); 

        $snacksitems = Item::where('group_name','snacks')->get();
        $snackscount = $snacksitems->count(); 

        $drinksitems = Item::where('group_name','drinks')->get();
        $drinkscount = $drinksitems->count();

        $othersitems = Item::where('group_name','others')->get();
        $otherscount = $othersitems->count();

    	$date = $request->date;
    	return view('admin.reports.loadpos',compact('pizzaitems','pizzacount','sandwichitems','sandwichcount','snacksitems','snackscount','drinksitems','drinkscount','othersitems','otherscount','date'));
    }
    
}
