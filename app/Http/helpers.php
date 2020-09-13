<?php
use App\User;
use Mail as MailUser;
use App\Uniform;
use App\StockLog;
use Carbon\Carbon;


/************************** Dilip Functions ***********************************/

function activeMenu($uri = '') {
    $active = '';
    if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
        $active = 'active';
    }
    return $active;
}

/************************** Dilip Functions end ***********************************/

function gettotal($date){
   $date = Carbon::parse($date);
   $saletotal = StockLog::whereDate('created_at', $date)->sum('sale');
   return $saletotal;
}

function gettotalmonthly($startdate,$enddate){
    $startdate = Carbon::parse($startdate);
    $enddate = Carbon::parse($enddate);
   $saletotal = StockLog::whereBetween('created_at',[$startdate,$enddate])->sum('sale');
   return $saletotal;
}

function gettotalamount($date){
   $date = Carbon::parse($date);
   $saletotal = StockLog::whereDate('created_at', $date)->sum('total');
   return $saletotal;
}

function gettotalamountmonthly($startdate,$enddate){
   $startdate = Carbon::parse($startdate);
    $enddate = Carbon::parse($enddate);
   $saletotal = StockLog::whereBetween('created_at',[$startdate,$enddate])->sum('total');
   return $saletotal;
}


function cashtotal($date){
   $date = Carbon::parse($date);
   $saletotal = StockLog::whereDate('created_at', $date)->sum('cash');
   return $saletotal;
}

function cashtotalmonthly($startdate,$enddate){
   $startdate = Carbon::parse($startdate);
    $enddate = Carbon::parse($enddate);
   $saletotal = StockLog::whereBetween('created_at',[$startdate,$enddate])->sum('cash');
   return $saletotal;
}




function paytmtotal($date){
   $date = Carbon::parse($date);
   $saletotal = StockLog::whereDate('created_at', $date)->sum('paytm');
   return $saletotal;
}

function paytmtotalmonthly($startdate,$enddate){
   $startdate = Carbon::parse($startdate);
    $enddate = Carbon::parse($enddate);
   $saletotal = StockLog::whereBetween('created_at',[$startdate,$enddate])->sum('paytm');
   return $saletotal;
}


function swiggytotal($date){
   $date = Carbon::parse($date);
   $saletotal = StockLog::whereDate('created_at', $date)->sum('swiggy');
   return $saletotal;
}

function swiggytotalmonthly($startdate,$enddate){
   $startdate = Carbon::parse($startdate);
    $enddate = Carbon::parse($enddate);
   $saletotal = StockLog::whereBetween('created_at',[$startdate,$enddate])->sum('swiggy');
   return $saletotal;
}



function zomatototal($date){
   $date = Carbon::parse($date);
   $saletotal = StockLog::whereDate('created_at', $date)->sum('zomato');
   return $saletotal;
}
function othertotal($date){
   $date = Carbon::parse($date);
   $saletotal = StockLog::whereDate('created_at', $date)->sum('other');
   return $saletotal;
}
function zomatototalmonthly($startdate,$enddate){
   $startdate = Carbon::parse($startdate);
    $enddate = Carbon::parse($enddate);
   $saletotal = StockLog::whereBetween('created_at',[$startdate,$enddate])->sum('zomato');
   return $saletotal;
}

function getpricetoday($itemid, $type,$date){
  $date = Carbon::parse($date);
  $stocklog = StockLog::where('item_id',$itemid)->orderby('id','desc')->whereDate('created_at', '<=', $date)->first();
  if(!empty($stocklog)){
      $todaystock = StockLog::where('item_id',$itemid)->whereDate('created_at', $date)->first();
      if(!empty($todaystock)){
          return $todaystock->$type;
      }else{
          $closing = $stocklog->closing;
          $opning = $closing;
          $sale = 0;
          $purchasetotal = 0;
          $finalclosing = ($opning + $purchasetotal) - $sale;
          if($type == 'sale' || $type == 'purchase'){
            return 0;
          }
          if($type == 'opning'){
            return $opning;
          }
          if($type == 'closing'){
            return $opning;
          }
          if($type == 'total'){
            return 0;
          }
      }

  }else{
      return 0;
  }
}


function getpricetodaymonthly($itemid, $type,$startdate,$enddate){
  $startdate = Carbon::parse($startdate);
  $enddate = Carbon::parse($enddate);
  
  $stocklog = StockLog::where('item_id',$itemid)->orderby('id','desc')->whereBetween('created_at',[$startdate,$enddate]);

  if($type == 'purchase'){
    return $stocklog->sum('purchase');
  }
  if($type == 'sale'){
    return $stocklog->sum('sale'); 
  }
  if($type == 'total'){
    return $stocklog->sum('total'); 
  }
}

/************************** Sonal Functions ***********************************/
/**
 * @param $permissions
 * @return bool
 * Added by Sonal Ramdatti
 */
function begin()
{
    \DB::beginTransaction();
}

function commit()
{
    \DB::commit();
}

function rollback()
{
    \DB::rollBack();
}
/**
 * For check permission
 */
function checkPermission($permissions)
{
    if (auth()->check()) {
        $userAccess = auth()->user()->role;
        foreach ($permissions as $key => $value) {
            if ($value == $userAccess) {
                return true;
            }
        }
        return false;
    } else {
        return false;
    }
}


function getvalue($key)
{
    $comapny = \DB::table('companies')->first();
    if(!empty($comapny)){
      return $comapny->$key;
    }else{
      return 'Rudra Enterprise';
    }
}



/************************** dhruv Functions ***********************************/
/************************************** Get Content of language *****************************/
function getcontentof($languageid, $contentid)
{

    $return = '';
    $content = \App\LanguageText    ::where([['language_id', $languageid], ['content_id', $contentid]])->first();
    if (!empty($content)) {
        $return = $content->text;
    }
    return $return;
}
function Getlanguages()
{
    $branchs = \App\Language::where([['activated', '1'], ['status', 'active']])->orwhere('id', 1)->get();
    return $branchs;
}
/************************** dhruv Functions end ***********************************/
function getimagesof($itemid,$school,$gender,$season,$standard){
  $uniforms = Uniform::with('itemname')->where('school_id',$school)->where('gender',$gender)->where('season',$season)->where('standard',$standard)->where('item_id',$itemid)->get();
  return $uniforms;
}


function getvalueofitemsize($school_id,$gender,$season,$standard,$item_id){
  $uniforms = \DB::table('item_size')->where('school_id',$school_id)->where('gender',$gender)->where('season',$season)->where('standard',$standard)->where('item_id',$item_id)->first();
  return $uniforms;

}


function getvalueofuniform($school_id,$gender,$season,$standard,$item_id){
  $uniforms = Uniform::where('school_id',$school_id)->where('gender',$gender)->where('season',$season)->where('standard',$standard)->where('item_id',$item_id);

  $totaluniform = $uniforms->count();
  $finalunit = $uniforms->get();
  $return = array();
  if($totaluniform > 0){
    $total = 5 - $totaluniform;
    $startfrom = $totaluniform + 1;
    $i = 1;
    foreach ($finalunit as $uniform) {
      $single_text = null;
      if(!empty($uniform->itemname->name)){
        $single_text = $uniform->itemname->name.' ('.$uniform->itemname->ract_number.')';
      }
      $array[$i] = array('id'=>$uniform->id,'single_text'=>$single_text,'itemid'=>$uniform->single_text,'file'=>$uniform->file,'remarks'=>$uniform->remarks);
      $i++;
    }
    for ($newuni=$startfrom; $newuni <= 5 ; $newuni++) { 
      $array[$newuni] = array();
    }

  } else{
    for ($uni=1; $uni <= 5 ; $uni++) { 
      $array[$uni] = array();
    }
  }
  return $array;

}


