<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use DataTables;
use App\OrderItem;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\StockLog;
use App\Item;


class OrderDetailController extends Controller
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
        $orders = Order::with('totalitems')->get();
        $date = date('Y-m-d');
        return view('admin.orders.index',compact('orders','date'));
    }

    public function getprint(Request $request){
        
        $id = $request->id;
        $order = Order::where('id',$id)->first();
        return view('admin.orders.getinvoicedata',compact('order'));
    }

    public function cancleorder($id){
        try {
            $orderitems = \DB::table('order_items')->where('order_id',$id)->get();
            $orderdetail = \DB::table('orders')->where('id',$id)->first();
            $payment_mode = 'cash';
            $finalprice =  0;
            $customer_type = 'cafe';
            if(!empty($orderdetail)){
                $payment_mode = $orderdetail->payment_mode;
                $customer_type = $orderdetail->customer_type;
            }
           
            if(!empty($orderitems)){
                foreach ($orderitems as $items) {
                    $item_id = $items->item_id;
                    $quantity = $items->quantity;
                    $finalprice =  $items->total_price;

                    $itemdata = Item::where('id',$item_id)->first();
                   
                    if(!empty($itemdata)){
                       
                        if($customer_type == 'cafe' && $itemdata->cafe_select == '1'){
                            
                            $quantity = $quantity/2;                                
                        }

                        if($customer_type == 'frozen' && $itemdata->frozen_select == '1'){
                            $quantity = $quantity/2;                                
                        }

                        if($customer_type == 'zomato' && $itemdata->zomato_select == '1'){
                            $quantity = $quantity/2;                                
                        }

                        if($customer_type == 'swiggy' && $itemdata->swiggy_select == '1'){
                            $quantity = $quantity/2;                                
                        }
                    }
                    

                    $stocklog = StockLog::where('item_id',$item_id)->orderby('id','desc')->first();
                   
                    if(!empty($stocklog)){
                            $todaystock = StockLog::where('item_id',$item_id)->whereDate('created_at', Carbon::today())->first();
                        if(!empty($todaystock)){


                            $purchasetotal = $todaystock->purchase;
                            $saletotal = $todaystock->sale - $quantity;
                            $closingtotal = ($todaystock->opning + $purchasetotal) - $saletotal;
                            
                            $total = $todaystock->total - $finalprice;
                            $updatetodaypurchase = StockLog::find($todaystock->id);

                            if($payment_mode == 'cash'){
                                $totalcash = $todaystock->cash - $finalprice;
                                $updatetodaypurchase->cash = $totalcash;
                            }
                            if($payment_mode == 'paytm'){
                                $totalpaytm = $todaystock->paytm - $finalprice;
                                $updatetodaypurchase->paytm = $totalpaytm;
                            }
                            if($payment_mode == 'zomato'){
                                $totalzomato = $todaystock->zomato - $finalprice;
                                $updatetodaypurchase->zomato = $totalzomato;
                            }
                            if($payment_mode == 'swiggy'){
                                $totalswiggy = $todaystock->swiggy - $finalprice;
                                $updatetodaypurchase->swiggy = $totalswiggy;
                            }

                            if($payment_mode == 'other'){
                                $totalother = $todaystock->other - $finalprice;
                                $updatetodaypurchase->other = $totalother;
                            }
                            
                            $updatetodaypurchase->total = $total;
                            $updatetodaypurchase->closing = $closingtotal;
                            $updatetodaypurchase->sale = $saletotal;
                            $updatetodaypurchase->save();
                        } else {

                            $opning = $stocklog->closing;
                            $purchasetotal = 0;
                            $sale = 0 - $quantity;
                            $finalclosing = ($opning + $purchasetotal) - $sale;

                            $newdaytoday = new StockLog;
                            $newdaytoday->item_id = $item_id;
                            $newdaytoday->opning = $opning;
                            $newdaytoday->purchase = $purchasetotal;

                            

                            if($payment_mode == 'cash'){
                                $totalcash = 0 - $finalprice;
                                $newdaytoday->cash = $totalcash;
                            }
                            if($payment_mode == 'paytm'){
                                $totalpaytm = 0 - $finalprice;
                                $newdaytoday->paytm = $totalpaytm;
                            }
                            if($payment_mode == 'zomato'){
                                $totalzomato = 0 - $finalprice;
                                $newdaytoday->zomato = $totalzomato;
                            }
                            if($payment_mode == 'swiggy'){
                                $totalswiggy = 0 - $finalprice;
                                $newdaytoday->swiggy = $totalswiggy;
                            }
                            if($payment_mode == 'other'){
                                $totalother = 0 - $finalprice;
                                $newdaytoday->other = $totalother;
                            }

                            $total = 0 - $finalprice;
                            $newdaytoday->total = $total;
                            $newdaytoday->sale = $sale;
                            $newdaytoday->closing = $finalclosing;
                            $newdaytoday->save();

                        }
                    } 
                }
            }
            \DB::table('orders')->where('id',$id)->update(['status'=>'cancel']);
            $arr = array("status" => 200, "msg" => 'Order Cancelled successfully.');
           

        } catch (\Illuminate\Database\QueryException $ex) {

            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            }

            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        } catch (Exception $ex) {

            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            }
            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        }
        return \Response::json($arr);
        
    }
    /**
     * Get all the users
     * @param Request $request
     * @return mixed
     */

    public function getall(Request $request)
    {
        $orders = Order::withcount('totalitems')->orderby('id', 'desc');

        if (isset($request->date) && !empty($request->date)) {
            $orders = $orders->whereDate('created_at', date('Y-m-d', strtotime($request->date)));
        }

        $orders = $orders->get();

        return DataTables::of($orders)
            ->addColumn('action', function ($q) {
                $return = '<a class="btn btn-primary btn-sm openaddmodal" data-toggle="modal" data-id="'.$q->id.'"  data-target=".add_modal" href="#"><i class="fas fa-folder"></i> </a> ';
                if(Auth::user()->role  == 'super_admin'){
                 $return .= ' <a title="Edit"  class="btn btn-info btn-sm openaddmodal" href="'.url('admin/pos/'.$q->id).'"><i class="fas fa-pencil-alt"></i> </a>';
                    if ($q->status != 'cancel') {
                        $return .= ' <a title="Cancel Order"  class="btn btn-danger btn-sm cancleorder" href="'.url('admin/cancleorder/'.$q->id).'"><i class="fas fa-times"></i> </a>';
                    }
                }
                return $return;
            })
            ->addColumn('created_by', function ($q) {
                return $q->user->name;
            }) 
            ->addColumn('total_item', function ($q) {
                return $q->totalitems_count;
            }) 
            ->addColumn('created_at', function ($q) {
                return  date('F d, Y', strtotime($q->created_at));
            }) 
            ->addColumn('status', function ($q) {
                $id = encrypt($q->id);
                if ($q->status == 'paid') {
                    return '<a  class="badge badgesize badge-success right changestatus" data-status="unpaid" data-id="' . $id . '" href="javascript:void(0)">' . ucwords($q->status) . '</a>';
                }
                if ($q->status == 'unpaid') {
                    return '<a class="badge badgesize badge-danger right changestatus"  data-status="paid"  data-id="' . $id . '" href="javascript:void(0)">' . ucwords($q->status) . '</a>';
                }
                if ($q->status == 'cancel') {
                    return '<a class="badge badgesize badge-danger right" href="javascript:void(0)">cancelled</a>';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action','status'])->make(true);
    }

    /**
     * Change status of user active or inactive
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response send response in json
     */
    public function changestatus(Request $request)
    {

        try {
            $id = decrypt($request->id);
            $holiday = Order::find($id);
            if ($holiday) {
                $holiday->update(['status' => $request->status]);
                $arr = array("status" => 200, "msg" => 'User status change successfully.');
            } else {
                $arr = array("status" => 400, "msg" => 'User not found. please try again!');
            }

        } catch (\Illuminate\Database\QueryException $ex) {

            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            }

            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        } catch (Exception $ex) {

            $msg = $ex->getMessage();
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            }
            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        }
        return \Response::json($arr);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
