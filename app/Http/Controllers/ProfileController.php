<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;
use App\User;
use App\CompanySetting;
use App\Company;
class ProfileController extends Controller
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
        
      
        return view('admin.profile.index');
       
    }
    public function profileupdate(Request $request){
        $input = $request->all();
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'username' => 'required',
        ];
        $messages = [
            'name' => 'Please enter first name.',
            'lastname' => 'Please enter last name.',
            'username' => 'Please enter username.',
            //'image.mimes' => 'Upload image with valid extension. Only .jpg, .jpeg, .png and .gif extensions are allowed.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {

            try {

                $user = User::find(Auth::user()->id);
                $user->name = $request->name;
                $user->lastname = $request->lastname;
                $user->username = $request->username;
                $user->save();

                $msg = 'Profile updated successfully.';
                $arr = array("status" => 200, "msg" => $msg);

            } catch ( \Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if(isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                }
                $arr = array("status" => 400, "msg" => $msg, "result" => array());

            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if(isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                }
                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }
        return \Response::json($arr);
    }

    public function updatecompnay(Request $request){
        $input = $request->all();
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'gst_number' => 'required',
        ];
        $messages = [
            'name' => 'Please enter first name.',
            'address' => 'Please enter last name.',
            'gst_number' => 'Please enter username.',
            //'image.mimes' => 'Upload image with valid extension. Only .jpg, .jpeg, .png and .gif extensions are allowed.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {

            try {

                $company = Company::first();
               // $company->user_id = Auth::user()->id;
                $company->name = $request->name;
                $company->address = $request->address;
                $company->gst_number = $request->gst_number;
                $company->save();

                $msg = 'Company updated successfully.';
                $arr = array("status" => 200, "msg" => $msg);

            } catch ( \Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if(isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                }
                $arr = array("status" => 400, "msg" => $msg, "result" => array());

            } catch (Exception $ex) {
                $msg = $ex->getMessage();
                if(isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                }
                $arr = array("status" => 400, "msg" => $msg, "result" => array());
            }
        }
        return \Response::json($arr);
    }

    public function changepassword(Request $request){
        $input = $request->all();
        $id = Auth::user()->id;
        $rules =[
            'current_password' => "required",
            'new_password' => "required|min:6",
            'password_confirmation' => 'required|min:6|same:new_password',
        ];
        $messages = [
            'password_confirmation.same' => 'Password Confirmation should match the Password',
        ];
        $validator = Validator::make($input, $rules, $messages );

        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                $current_password = $input["current_password"];
                $new_password = Hash::make($input["new_password"]);
                $data = User::find($id);
                if ($data) {
                    if (Hash::check($current_password, $data->password)) {
                        $data->password = $new_password;
                        $data->save();
                        $arr = array("status" => 200, "msg" => "Password change successfully", "data" => []);
                    } else {
                        $arr = array("status" => 400, "msg" => "Current Password Not Match.", "data" => []);
                    }
                } else {
                    $arr = array("status" => 400, "msg" => "User not found.", "data" =>  []);
                }
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" =>  []);
            }
        }
        return \Response::json($arr);
    }


}
