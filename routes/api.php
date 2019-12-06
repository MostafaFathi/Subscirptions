<?php

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/products/{section_type}/{section_id}/{user_city}/{ask_branches}', function (Request $request,$section_type,$section_id,$user_city,$ask_branches) {
    $commition=[];
    if($section_type == 0 ){
        $all_products = \App\Restaurant::where('main_section','=',$section_id)->where('is_branch','=',0)->get();
    }else
    if($section_type == 1 ){
        $all_products = \App\Restaurant::where('branch_id','=',$section_id)->where('is_branch','=',1)->get();
    }else if($section_type == 2 && $ask_branches == 1){
        $all_products =  DB::table('products')
            ->leftJoin('product_units', 'products.unit_id', '=', 'product_units.id')
            ->leftJoin('restaurants', 'products.product_rest', '=', 'restaurants.id')
            ->where('product_rest_branch','=',$section_id)
            ->get(['products.id as id','product_units.id as unit_id','products.product_name','products.product_price'
                ,'product_units.unit_name','products.img','products.img_2','products.product_section','restaurants.rest_name','products.product_rest','restaurants.discount']);
        $commition = \App\Commition::find(1);
    }else if($section_type == 2 && $ask_branches == 0){
        $all_products =  DB::table('products')
            ->leftJoin('product_units', 'products.unit_id', '=', 'product_units.id')
            ->leftJoin('restaurants', 'products.product_rest', '=', 'restaurants.id')
            ->where('product_rest','=',$section_id)
            ->get(['products.id as id','product_units.id as unit_id','products.product_name','products.product_price'
                ,'product_units.unit_name','products.img','products.img_2','products.product_section','restaurants.rest_name','products.product_rest','restaurants.discount']);
        $commition = \App\Commition::find(1);
//        $all_products = \App\Products::where('product_section','=',$section_type)->get();
    }
    $image_link = App::make('url')->to('uploads/products/');


    return collect(["all_products"=>$all_products,"commition"=>$commition,"image_link"=>$image_link]);
});

Route::post('/request', function (Request $request) {

    $id = $request->id;
    $status = 'false';

    $times = \App\TimeWork::first();
    $resttimefrom = str_replace(':','',$times->time_start);
    $resttimeto = str_replace(':','',$times->time_end);
    $currentTime = (int) date('Gis');

    if ($currentTime > $resttimefrom && $currentTime < $resttimeto )
    {
        $is_opened=true;
    }
    else
    {
        $is_opened=false;
    }
if($is_opened){
    $address = $request->address;
    if($request->address == '' || $request->address == null){
        $address = $request->userInfo['address'];
    }
    $commition = \App\Commition::find(1);
    $cartTotalCost = $request->cartTotalCost ;
    $request_id= DB::table('requests')->max('request_id');
    $request_id_1 = $request_id + 1;
    foreach (($request->order) as $item) {
        $status='true';
        $user = new \App\Requests();
        $user->user_id  = $id;
        $user->product_id  = $item['id'];
        $user->request_id  = $request_id_1;
        $user->cartTotalCost  = $cartTotalCost;
        $user->phone_number  = $request->userInfo['number'];
        $user->product_name  = $item['product_name'].' - '.$item['rest_name'];
        $user->product_price  = $item['product_price'];
        $user->address  = $address;
        $user->unit_id  = $item['unit_id'];
        $user->city  = $request->userInfo['city'];
        $user->img  = $item['img'];
        $user->quantity  = $item['product_quantity'];
        $user->buy_cost  = $item['buy_cost'];
        $user->save();
    }
    return $request;

}else{
    return ['is_open'=>false];
}



});

Route::post('/request/other', function (Request $request) {

    $id = $request->id;
    $status = 'false';

    $times = \App\TimeWork::first();
    $resttimefrom = str_replace(':','',$times->time_start);
    $resttimeto = str_replace(':','',$times->time_end);
    $currentTime = (int) date('Gis');

    if ($currentTime > $resttimefrom && $currentTime < $resttimeto )
    {
        $is_opened=true;
    }
    else
    {
        $is_opened=false;
    }
    if($is_opened){
    $address = $request->address;
    $orderDetails = $request->orderDetails;
    if($request->address == '' || $request->address == null){
        $address = $request->userInfo['address'];
    }

    $request_id= DB::table('requests')->max('request_id');
    $request_id = $request_id + 1;
    $status='true';
    $user = new \App\Requests();
    $user->user_id  = $id;
    $user->request_id  = $request_id;
    $user->phone_number  = $request->userInfo['number'];
    $user->address  = $address;
    $user->city  = $request->userInfo['city'];
    $user->is_others  = 1;
    $user->order_other  =  $orderDetails;
    $user->save();
        return $request;

    }else{
        return ['is_open'=>false];
    }

});
Route::post('/user', function (Request $request) {


    $number = \App\App_users::where('number','=',$request->number.'')->get();
    $result['status']=false;
    if(count($number) == 0){
        $user = new \App\App_users();
        $user->fullName  = $request->fullName;
        $user->number  = $request->number;
        $user->address  = $request->address;
        $user->city  = $request->city;
        $user->password  = $request->password;
        $user->save();
        $result['user']=$user;
        $result['status']=true;
    }else{
        $result['user']= [];
        $result['status']=false;
    }



    return $result;
});

Route::post('/user/login', function (Request $request) {


    $number = \App\App_users::where('number','=',$request->number.'')->get();
    $result['status']=false;
    if(count($number) > 0){
        if($number[0]->password == $request->password){
            $result['user']=$number;
            $result['status']=true;
        }else{
            $result['user']= [];
            $result['status']=false;
        }
    }else{
        $result['user']= [];
        $result['status']=false;
    }



    return $result;
});
Route::get('/user/info/{number}', function ($number) {


    $number = \App\App_users::where('number','=',$number.'')->get();



    return $number[0];
});
Route::get('/user/orders/{number}', function ($number) {


    $number = DB::table('requests')
        ->select('request_id','cartTotalCost','is_confirmed','is_others','created_at')
        ->where('phone_number','=',$number.'')->orderBy('request_id','desc')->distinct()->get();

    $image_link = App::make('url')->to('uploads/products/');

    return collect(['data'=>$number,'image_link'=>$image_link]);
});
Route::get('/regions', function () {


    $regions = DB::table('regions')->get();


    return collect(['data'=>$regions]);
});
Route::get('/user/orders/info/{request_id}', function ($request_id) {


    $number = DB::table('requests')
        ->leftJoin('product_units', 'requests.unit_id', '=', 'product_units.id')
         ->where('requests.request_id','=',$request_id.'')->orderBy('requests.id','asc')
        ->distinct()
        ->get(['requests.id as id','product_units.id as unit_id','requests.product_name','requests.quantity','requests.product_price'
            ,'product_units.unit_name','requests.img','requests.buy_cost' ,'requests.cartTotalCost','requests.order_other' ]);



    return $number;
});
Route::get('/timesWork', function () {


    $times = \App\TimeWork::first();

    $time_start = str_replace('am11','صباحاً',date('h:i am',strtotime($times->time_start)));
    $time_end = str_replace('pm11','مساءاً',date('h:i am',strtotime($times->time_end)));

    return  collect(['time_start'=>$time_start,'time_end'=>$time_end]);
});

Route::post('/user/update', function (Request $request) {

$user = \App\App_users::find($request->id);
$user->fullName = $request->fullName;
$user->address = $request->address;
$user->city = $request->city;
$user->save();
    return $user;
});
