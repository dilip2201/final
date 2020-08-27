<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use DataTables;
use Validator;

class ItemController extends Controller
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
     * Get all the users
     * @param Request $request
     * @return mixed
     */
    public function getall(Request $request)
    {

        $items = Item::orderby('id', 'desc');
        if (isset($request->group_name) && !empty($request->group_name)) {
            $items = $items->where('group_name',$request->group_name);
        }
        $items = $items->get();
        return DataTables::of($items)
            ->addColumn('action', function ($q) {
                $id = encrypt($q->id);
                $return = '<a title="Edit"  data-id="'.$id.'"   data-toggle="modal" data-target=".add_modal" class="btn btn-info btn-sm openaddmodal" href="javascript:void(0)"><i class="fas fa-pencil-alt"></i> Edit</a>';
                return $return;
            }) 
            ->addColumn('image', function ($q) {
            $image = url('public/company/employee/default.png'); 
            if(file_exists(public_path().'/company/employee/'.$q->image) && !empty($q->image)) :
                $image = url('public/company/employee/'.$q->image); 
            endif;
            return '<img class="profile-user-img img-fluid img-circle" src="'.$image.'" style="width:50px; height:50px;border: 1px solid #adb5bd;">';
            })       

            ->addIndexColumn()
            ->rawColumns(['image','action'])->make(true);
    }

         /**
     * Get model for add edit user
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getmodal(Request $request)
    {

        $item = array();
        if (isset($request->id) && $request->id != '') {
            $id = decrypt($request->id);
            $item = Item::where('id',$id)->first();

        }
        return view('admin.items.getmodal', compact('item'));
    }

    
    public function saveinvoice(Request $request)
    {
        
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules = [
            'name' => 'required',
            'group_name' => 'required',
            'cafe_price' => 'required',
            'frozen_price' => 'required',
            'zomato_price' => 'required',
            'swiggy_price' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {
            try {
                if (isset($request->itemid)) {
                    $id = decrypt($request->itemid);
                    $item = Item::find($id);
                    $msg = "Item updated successfully.";
                }else{
                    $item = new Item;
                    $msg = "Item added successfully.";
                }
                if ($request->hasFile('image1')) {
                    $destinationPath = public_path().'/company/employee';
                    $file = $request->image1;
                    $fileName1 = time().rand() . '.'.$file->clientExtension();
                    $file->move($destinationPath, $fileName1);
                    $item->image = $fileName1;
                }
                $item->group_name = $request->group_name;
                $item->name = $request->name;
                $item->cafe_price = $request->cafe_price;
                $item->frozen_price = $request->frozen_price;
                if(isset($request->cafe_check) && $request->cafe_check == '1'){
                    $item->cafe_select = '1';
                }else{
                    $item->cafe_select = '0';
                }

                if(isset($request->frozen_check) && $request->frozen_check == '1'){
                    $item->frozen_select = '1';
                }else{
                    $item->frozen_select = '0';
                }

                if(isset($request->zomato_check) && $request->zomato_check == '1'){
                    $item->zomato_select = '1';
                }else{
                    $item->zomato_select = '0';
                }

                 if(isset($request->swiggy_check) && $request->swiggy_check == '1'){
                    $item->swiggy_select = '1';
                }else{
                    $item->swiggy_select = '0';
                }
                
                $item->zomato_price = $request->zomato_price;
                $item->swiggy_price = $request->swiggy_price;
                $item->order_by = $request->order_by;
                $item->save();

                $clientupdate = Item::find($item->id);
                $clientnumber =  'I'.str_pad($item->id, 3, "0", STR_PAD_LEFT);
                $clientupdate->item_code = $clientnumber;
                $clientupdate->save();


                $arr = array("status" => 200, "msg" => $msg);
            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;
                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;
                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }

        return \Response::json($arr);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.items.index');
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
