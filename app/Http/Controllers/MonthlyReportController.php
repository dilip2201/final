<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class MonthlyReportController extends Controller
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
    	
        return view('admin.monthlyreports.index');
    }
    public function loadpos(Request $request){
    	//$items = Item::get();

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


    	$startdate = $request->startdate;
    	$enddate = $request->enddate;

        return view('admin.monthlyreports.loadpos',compact('pizzaitems','pizzacount','sandwichitems','sandwichcount','snacksitems','snackscount','drinksitems','drinkscount','othersitems','otherscount','startdate','enddate'));
    	//return view('admin.monthlyreports.loadpos',compact('items','startdate','enddate'));
    }
}
