<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use App\Stock;
use App\Item;
use App\StockLog;

class POPController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $order = array();
        $items = \DB::table('items')->select('id','group_name','name','cafe_price','frozen_price','zomato_price','swiggy_price')->get();
        $count = \DB::table('purchase_orders')->whereDate('created_at', Carbon::today())->count();
        $count++;
        $finalcount =  str_pad($count, 3, "0", STR_PAD_LEFT);
        $billno =  date('dmy').'-'.$finalcount;
        $date = date('d-m-y');
        $time = date('H:i A');
        return view('admin.pop.index',compact('items','finalcount','count','billno','date','time','order'));
    }

    public function saveinvoice(Request $request)
    {
        begin();
        try {
            $input = $request->all();
            if(isset($input['data']) && !empty($input['data'])){
                $items = $input['data'];
                

                if(isset($input['orderid']) && !empty($input['orderid'])) {
                    $order = PurchaseOrder::find($input['orderid']);
                }else{
                    $order = new PurchaseOrder;
                }
                $order->created_by = auth()->user()->id;
                $order->time = $input['time'];
                $order->order_number = $input['token_no'];
                $order->total_price = $input['finalprice'];
                $order->save();
                
                if(isset($input['orderid']) && !empty($input['orderid'])){
                    PurchaseOrderItem::where('purchase_order_id',$input['orderid'])->delete();
                }
                if(!empty($items)){
                    foreach ($items as $key => $item) {
                        $orderitem = new PurchaseOrderItem;
                        $orderitem->price = $item['price'];
                        $orderitem->quantity = $item['qty'];
                        $orderitem->total_price = $item['finalprice'];
                        $orderitem->purchase_order_id = $order->id;
                        $orderitem->item_id = $item['id'];
                        $orderitem->random_number = $key;
                        $orderitem->save();

                        $itemdata = Item::where('id',$item['id'])->first();

                        if(!empty($itemdata)){
                           $totalquntity = $itemdata->stock + $item['qty'];
                           $itemdata->update(['stock'=>$totalquntity]);
                        }

                        $stocklog = StockLog::where('item_id',$item['id'])->orderby('id','desc')->first();
                        
                        if(!empty($stocklog)){
                            $todaystock = StockLog::where('item_id',$item['id'])->whereDate('created_at', Carbon::today())->first();
                            if(!empty($todaystock)){
                                $purchasetotal = $todaystock->purchase + $item['qty'];
                                $closingtotal = ($todaystock->opning + $purchasetotal) - $stocklog->sale;
                                $updatetodaypurchase = StockLog::find($todaystock->id);
                                $updatetodaypurchase->purchase = $purchasetotal;
                                $updatetodaypurchase->closing = $closingtotal;
                                $updatetodaypurchase->save();
                            }else{
                                $closing = $stocklog->closing;
                                $opning = $closing;
                                $purchasetotal = $item['qty'];
                                $sale = 0;
                                $finalclosing = ($opning + $purchasetotal) - $sale;

                                $newdaytoday = new StockLog;
                                $newdaytoday->item_id = $item['id'];
                                $newdaytoday->opning = $opning;
                                $newdaytoday->purchase = $purchasetotal;
                                $newdaytoday->sale = $sale;
                                $newdaytoday->closing = $finalclosing;
                                $newdaytoday->save();
                                
                            }

                        }else{
                            $daytoday = new StockLog;
                            $daytoday->item_id = $item['id'];
                            $daytoday->purchase = $item['qty'];
                            $daytoday->closing = $item['qty'];
                            $daytoday->save();
                        }
                        
                    }
                }
                $html = '';
                $type = 'save';
                
                //$order->items()->sync($syncarray);
                commit();
                $arr = array("status" => 200, "msg" => "Success",'type'=>$type,'html'=>$html, "result" => array());  
            }else{
                $arr = array("status" => 400, "msg" => "Please select at least one item to save", "result" => array());   
                rollback(); 
            }
        } catch ( \Illuminate\Database\QueryException $ex) {
            $msg = $ex->getMessage();
            if(isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            }
            rollback(); 
            $arr = array("status" => 400, "msg" => $msg, "result" => array());

        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            if(isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            }
            rollback(); 
            $arr = array("status" => 400, "msg" => $msg, "result" => array());
        }
        return \Response::json($arr);
    }

    public function show($id){
        $items = \DB::table('items')->select('id','group_name','name','cafe_price','frozen_price','zomato_price','swiggy_price')->get();
        $order = PurchaseOrder::with('items')->where('id', $id)->first();
        $count = $order->order_number;
        
        $billno =  $order->bill_no;
        $date = date('d-m-y',strtotime($order->created_at));
        $time = $order->time;
        return view('admin.pop.index',compact('items','count','billno','date','time','order'));
    }
}
