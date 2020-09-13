<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\OrderItem;
use App\StockLog;
use App\Item;


class POSController extends Controller
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
        $count = \DB::table('orders')->whereDate('created_at', Carbon::today())->count();
        $count++;
        $finalcount =  str_pad($count, 3, "0", STR_PAD_LEFT);
        $billno =  date('dmy').'-'.$finalcount;
        $date = date('d-m-y');
        $time = date('H:i A');
        return view('admin.pos.index',compact('items','finalcount','count','billno','date','time','order'));
    }

    public function saveinvoice(Request $request)
    {
        begin();
        try {
           
            $input = $request->all();
            if(isset($input['data']) && !empty($input['data'])){
                $items = $input['data'];
                
              
                if(isset($input['orderid']) && !empty($input['orderid'])) {
                    $order = Order::find($input['orderid']);
                }else{
                    $order = new Order;
                }
                $order->created_by = auth()->user()->id;
                $order->customer_type = $input['paymenttype'];
                $order->payment_mode = $input['payment_mode'];
                $order->bill_no = $input['billno'];
                $order->order_number = $input['token_no'];
                $order->total_price = $input['finalprice'];
                $order->time = $input['time'];
                $order->status = 'paid';
                $order->save();
                
                if(isset($input['orderid']) && !empty($input['orderid'])){

                    $orderitems = \DB::table('order_items')->where('order_id',$input['orderid'])->get();
                    
                    $orderdetail = \DB::table('orders')->where('id',$input['orderid'])->first();
                    $payment_mode = 'cash';
                    $finalprice =  0;
                    $customer_type = 'cafe';
                    if(!empty($orderdetail)){
                        $payment_mode = $orderdetail->payment_mode;
                        $customer_type = $orderdetail->customer_type;
                    }

                    if(!empty($orderitems)){
                        foreach ($orderitems as $orderitems) {
                            $item_id = $orderitems->item_id;
                            $quantity = $orderitems->quantity;
                            $finalprice =  $orderitems->total_price;
                            
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


                    OrderItem::where('order_id',$input['orderid'])->delete();


                }

                

                if(!empty($items)){
                    foreach ($items as $key => $item) {
                        $orderitem = new OrderItem;
                        $orderitem->price = $item['price'];
                        $orderitem->quantity = $item['qty'];
                        $orderitem->total_price = $item['finalprice'];
                        $orderitem->order_id = $order->id;
                        $orderitem->item_id = $item['id'];
                        $orderitem->random_number = $key;
                        $orderitem->save();

                        $itemdata = Item::where('id',$item['id'])->first();

                        if(!empty($itemdata)){
                            if($input['paymenttype'] == 'cafe' && $itemdata->cafe_select == '1'){
                                $item['qty'] = $item['qty']/2;                                
                            }

                            if($input['paymenttype'] == 'frozen' && $itemdata->frozen_select == '1'){
                                $item['qty'] = $item['qty']/2;                                
                            }

                            if($input['paymenttype'] == 'zomato' && $itemdata->zomato_select == '1'){
                                $item['qty'] = $item['qty']/2;                                
                            }

                            if($input['paymenttype'] == 'swiggy' && $itemdata->swiggy_select == '1'){
                                $item['qty'] = $item['qty']/2;                                
                            }

                           $totalquntity = $itemdata->stock - $item['qty'];
                           $itemdata->update(['stock'=>$totalquntity]);
                        }


                        $stocklog = StockLog::where('item_id',$item['id'])->orderby('id','desc')->first();
                        
                        if(!empty($stocklog)){
                            $todaystock = StockLog::where('item_id',$item['id'])->whereDate('created_at', Carbon::today())->first();
                            if(!empty($todaystock)){


                                $purchasetotal = $todaystock->purchase;
                                $saletotal = $todaystock->sale + $item['qty'];
                                $closingtotal = ($todaystock->opning + $purchasetotal) - $saletotal;
                                
                                $total = $todaystock->total + $item['finalprice'];
                                $updatetodaypurchase = StockLog::find($todaystock->id);

                                if($input['payment_mode'] == 'cash'){
                                    $totalcash = $todaystock->cash + $item['finalprice'];
                                    $updatetodaypurchase->cash = $totalcash;
                                }
                                if($input['payment_mode'] == 'paytm'){
                                    $totalpaytm = $todaystock->paytm + $item['finalprice'];
                                    $updatetodaypurchase->paytm = $totalpaytm;
                                }
                                if($input['payment_mode'] == 'zomato'){
                                    $totalzomato = $todaystock->zomato + $item['finalprice'];
                                    $updatetodaypurchase->zomato = $totalzomato;
                                }
                                if($input['payment_mode'] == 'swiggy'){
                                    $totalswiggy = $todaystock->swiggy + $item['finalprice'];
                                    $updatetodaypurchase->swiggy = $totalswiggy;
                                }
                                
                                if($input['payment_mode'] == 'other'){
                                    $totalother = $todaystock->other + $item['finalprice'];
                                    $updatetodaypurchase->other = $totalother;
                                }

                                $updatetodaypurchase->total = $total;
                                $updatetodaypurchase->closing = $closingtotal;
                                $updatetodaypurchase->sale = $saletotal;
                                $updatetodaypurchase->save();
                            }else{

                                $opning = $stocklog->closing;
                                $purchasetotal = 0;
                                $sale = $item['qty'];
                                $finalclosing = ($opning + $purchasetotal) - $sale;
                                
                                


                                $newdaytoday = new StockLog;
                                $newdaytoday->item_id = $item['id'];
                                $newdaytoday->opning = $opning;
                                $newdaytoday->purchase = $purchasetotal;

                                $total = $item['finalprice'];
                                if($input['payment_mode'] == 'cash'){
                                    $totalcash = $item['finalprice'];
                                    $newdaytoday->cash = $totalcash;
                                }
                                if($input['payment_mode'] == 'paytm'){
                                    $totalpaytm = $item['finalprice'];
                                    $newdaytoday->paytm = $totalpaytm;
                                }
                                if($input['payment_mode'] == 'zomato'){
                                    $totalzomato = $item['finalprice'];
                                    $newdaytoday->zomato = $totalzomato;
                                }
                                if($input['payment_mode'] == 'swiggy'){
                                    $totalswiggy = $item['finalprice'];
                                    $newdaytoday->swiggy = $totalswiggy;
                                }

                                if($input['payment_mode'] == 'other'){
                                    $totalother = $item['finalprice'];
                                    $newdaytoday->other = $totalother;
                                }
                                $newdaytoday->total = $total;
                                $newdaytoday->sale = $sale;
                                $newdaytoday->closing = $finalclosing;
                                $newdaytoday->save();

                            }

                        } else {


                            $opning = 0;
                            $purchase = 0;
                            $sale = $item['qty'];
                            $closing = ($opning + $purchase) - $sale;
                            $daytoday = new StockLog;
                            $daytoday->item_id = $item['id'];
                            $daytoday->opning = 0;
                            
                            $total = $item['finalprice'];
                            if($input['payment_mode'] == 'cash'){
                                $totalcash = $item['finalprice'];
                                $daytoday->cash = $totalcash;
                            }
                            if($input['payment_mode'] == 'paytm'){
                                $totalpaytm = $item['finalprice'];
                                $daytoday->paytm = $totalpaytm;
                            }
                            if($input['payment_mode'] == 'zomato'){
                                $totalzomato = $item['finalprice'];
                                $daytoday->zomato = $totalzomato;
                            }
                            if($input['payment_mode'] == 'swiggy'){
                                $totalswiggy = $item['finalprice'];
                                $daytoday->swiggy = $totalswiggy;
                            }
                            if($input['payment_mode'] == 'other'){
                                $totalother = $item['finalprice'];
                                $daytoday->other = $totalother;
                            }
                            $daytoday->total = $total;
                            $daytoday->sale = $item['qty'];
                            $daytoday->closing = $closing;
                            $daytoday->save();
                        }

                    }
                }
                $html = '';
                $type = 'save';
                if($request->save == 'saveprint'){
                    $order = Order::where('id',$order->id)->first();
                    $html = view('admin.orders.getinvoicedata',['order'=>$order])->render();
                    $type = 'saveprint';
                }
                //$order->items()->sync($syncarray);
                commit();
                $arr = array("status" => 200, "msg" => "Success",'type'=>$type,'html'=>$html, "result" => array());  
            }else{
                rollback();
                $arr = array("status" => 400, "msg" => "Please select at least one item to save", "result" => array());    
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
        $order = Order::with('items')->where('id', $id)->first();
        $count = $order->order_number;
        
        $billno =  $order->bill_no;
        $date = date('d-m-y',strtotime($order->created_at));
        $time = $order->time;
        return view('admin.pos.index',compact('items','count','billno','date','time','order'));
    }
    
}
