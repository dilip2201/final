<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseOrder;
use DataTables;
use App\PurchaseOrderItem;
Use Carbon\Carbon;


class PurchaseOrderController extends Controller
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

        $orders = PurchaseOrder::with('totalitems')->get();
        $date = date('Y-m-d');
        return view('admin.purchaseorder.index',compact('orders','date'));
    }

    public function getprint(Request $request){
        
        $id = $request->id;
        $order = PurchaseOrder::where('id',$id)->first();
        return view('admin.orders.getinvoicedata',compact('order'));
    }
    /**
     * Get all the users
     * @param Request $request
     * @return mixed
     */

    public function getall(Request $request)
    {
        $orders = PurchaseOrder::withcount('totalitems')->orderby('id', 'desc');

        if (isset($request->date) && !empty($request->date)) {
            $orders = $orders->whereDate('created_at', date('Y-m-d', strtotime($request->date)));
        }

        $orders = $orders->get();

        return DataTables::of($orders)
            ->addColumn('action', function ($q) {
               
                $return = '<a class="btn btn-primary btn-sm openaddmodal" data-toggle="modal" data-id="'.$q->id.'"  data-target=".add_modal" href="#"><i class="fas fa-folder"></i> </a>';

                 //'<a title="Edit"  class="btn btn-info btn-sm openaddmodal" href="'.url('admin/pop/'.$q->id).'"><i class="fas fa-pencil-alt"></i> </a>';
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
            ->addIndexColumn()
            ->rawColumns(['action','status'])->make(true);
    }

    /**
     * Get model for add edit user
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getmodal(Request $request)
    {
                $id = $request->id;
       
        $order = PurchaseOrder::with('totalitems')->where('id',$id)->first();

        return view('admin.purchaseorder.getmodal',compact('order'));
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
            $holiday = PurchaseOrder::find($id);
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
