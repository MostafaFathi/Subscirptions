<?php

namespace App\Http\Controllers;

use App\App_users;
use App\Commition;
use App\Products;
use App\ProductUnit;
use App\Regions;
use App\Requests;
use App\Restaurant;
use App\TimeWork;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{

    public function index()
    {
        $restaurant = Restaurant::where('is_branch','=',0)->get();
        $units = ProductUnit::all();
       return view('products.add_product',['restaurant'=>$restaurant,'units'=>$units]);
    }

    public function manage()
    {

        $all_products = Products::all();
        $restaurant = Restaurant::where('is_branch','=',0)->get();
        $units = ProductUnit::all();
        return view('products.manage_products',['all_products'=>$all_products,'restaurant'=>$restaurant,'units'=>$units]);
    }


    public function app_users()
    {

        $all_users = App_users::all();
        return view('products.manage_app_users',['all_users'=>$all_users]);
    }

    public function getSubSections($section_id)
    {

        $restaurant = Restaurant::where('main_section','=',$section_id)->
        where('is_branch','=',0)->get();
        $generated_select=' <label class="col-lg-2 control-label">القسم:</label>
                            <div class="col-lg-5">
                                <select name="product_rest" class="select-search product_rest_change" id="product_rest">';
        $generated_select .= '<option value="--">إختر</option>';

        foreach ($restaurant as $item) {
            $generated_select .= '<option value="'.$item->id.'">'.$item->rest_name.'</option>';
        }
        $generated_select .= '</select></div>';
        echo \GuzzleHttp\json_encode(["select"=>$generated_select]);

    }

    public function getBranches($branch_id)
    {

        $restaurant = Restaurant::where('branch_id','=',$branch_id)->
        where('is_branch','=',1)->get();
        if(count($restaurant) == 0){
            $generated_select='';
        }else{
        $generated_select=' <label class="col-lg-2 control-label">القسم الفرعي:</label>
                            <div class="col-lg-5">
                                <select name="product_rest_branch" class="select-search" id="product_rest_branch">';
        $generated_select .= '<option value="--">إختر</option>';

        foreach ($restaurant as $item) {
            $generated_select .= '<option value="'.$item->id.'">'.$item->rest_name.'</option>';
        }
        $generated_select .= '</select></div>';
        }
        echo \GuzzleHttp\json_encode(["select"=>$generated_select]);

    }




    public function save(Request $request)
    {
        $this->validate($request,[
            'product_name'=>'required'
        ]);
        $product = new Products();
        $product->product_name  = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->unit_id = $request->input('unit_id');
        $product->product_section = $request->input('product_section');
        $product->product_rest = $request->input('product_rest');
        $product->product_rest_branch = $request->input('product_rest_branch');
        $product->product_city =  $request->input('product_city');
        if($request->file('img') != null){
            $image = $request->file('img');
            $filename  = time()+1 . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path = 'uploads/products/' . $filename;//-- string path


            Image::make($image->getRealPath())->save($path);
            $product->img = $filename;
        }
        if($request->file('img_2') != null){
            $image = $request->file('img_2');
            $filename  = time()-1 . '2.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path = 'uploads/products/' . $filename;//-- string path


            Image::make($image->getRealPath())->save($path);
            $product->img_2 = $filename;
        }
        $product->save();


        echo json_encode(['result'=>'success','student'=>$product]);
    }


    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'product_name'=>'required'
        ]);
        $student = array();
            $product = Products::find($id);
            $product->product_name=$request->input('product_name');
            $product->product_price=$request->input('product_price');
            $product->unit_id=$request->input('unit_id');
            $product->product_section=$request->input('product_section');
            $product->product_rest=$request->input('product_rest');
            $product->product_city=$request->input('product_city');
            $product->save();

        echo json_encode(['result'=>'success','product'=>$product]);
    }






    public function recycle_bin($product_id)
    {
            $product = Products::find($product_id);
            $product->delete();
            $result = 'success';

        echo json_encode(['result'=>$result]);
    }




    public function restaurants()
    {

        return view('products.add_restaurant');
    }
    public function commition()
    {
        $commition = Commition::find(1);
        return view('products.update_commition',['commition'=>$commition]);
    }
    public function times_of_work()
    {
        $times = TimeWork::first();

        return view('products.times_of_work',['times'=>$times]);
    }
    public function manage_restaurants()
    {

        $restaurant = Restaurant::where('is_branch','=',0)->get();
        return view('products.manage_restaurants',['restaurant'=>$restaurant]);
    }
    public function restaurantSave(Request $request)
    {
        $this->validate($request,[
            'rest_name'=>'required'
        ]);
        $product = new Restaurant();
        $product->rest_name  = $request->input('rest_name');
//        $product->discount  = $request->input('discount');
        $product->main_section  = $request->input('product_section');
        $product->has_branches  = $request->input('has_branches');
        if($request->file('img') != null){
            $image = $request->file('img');
            $filename  = time()+1 . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path = 'uploads/products/' . $filename;//-- string path


            Image::make($image->getRealPath())->save($path);
            $product->img = $filename;
        }
        if($request->file('img2') != null){
            $image = $request->file('img2');
            $filename2  = time()-1 . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path2 = 'uploads/products/' . $filename2;//-- string path


            Image::make($image->getRealPath())->save($path2);
            $product->img2 = $filename2;
        }
        $product->save();


        echo json_encode(['result'=>'success','product'=>$product]);
    }

    public function restaurantUpdate(Request $request,$id)
    {
        $this->validate($request,[
            'rest_name'=>'required'
        ]);
        $rest = Restaurant::find($id);
        $rest->rest_name=$request->input('rest_name');
//        $rest->discount  = $request->input('discount');
        $rest->main_section  = $request->input('product_section');
        $rest->has_branches  = $request->input('has_branches');
        if($request->file('img') != null){
            $image = $request->file('img');

            $filename  = time()+1 . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path = 'uploads/products/' . $filename;//-- string path


            Image::make($image->getRealPath())->save($path);
            $rest->img = $filename;
        }
        if($request->file('img2') != null){
            $image = $request->file('img2');
            $filename2  = time()-1 . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path2 = 'uploads/products/' . $filename2;//-- string path


            Image::make($image->getRealPath())->save($path2);
            $rest->img2 = $filename2;
        }
        $rest->save();

        echo json_encode(['result'=>'success','rest'=>$rest]);
    }

    public function commitionUpdate(Request $request)
    {
        $this->validate($request,[
            'value'=>'required'
        ]);
        $rest = Commition::find(1);
        $rest->value=$request->input('value');
        $rest->save();

        echo json_encode(['result'=>'success','rest'=>$rest]);
    }

    public function timesWorkUpdate(Request $request)
    {
        $this->validate($request,[
            'time_start'=>'required',
            'time_end'=>'required'
        ]);
        $rest = TimeWork::first();
        if(isset($rest)){
            $rest->time_start  = $request->input('time_start');
            $rest->time_end  = $request->input('time_end');
            $rest->save();
        }else{
            $rest = new TimeWork();
            $rest->time_start  = $request->input('time_start');
            $rest->time_end  = $request->input('time_end');
            $rest->save();
        }

        echo json_encode(['result'=>'success','rest'=>$rest]);
    }



    public function restaurantRecycle_bin($restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);
        $restaurant->delete();
        DB::table('products')->where('product_rest', $restaurant_id)->delete();
        $result = 'success';

        echo json_encode(['result'=>$result]);
    }




    public function  branches()
    {

        $rest = Restaurant::where('is_branch','=',0)->where('has_branches','=',0)->get();
        return view('products.add_branches',['rest'=>$rest]);
    }

    public function  addRegion()
    {

        return view('products.add_regions');
    }

    public function manage_branches()
    {

        $restaurant = Restaurant::where('is_branch','=',1)->get();
        $branches = Restaurant::where('is_branch','=',0)->where('has_branches','=',0)->get();
        return view('products.manage_branches',['restaurant'=>$restaurant,'branches'=>$branches]);
    }
    public function manage_regions()
    {

        $regions = Regions::all();
        return view('products.manage_regions',['regions'=>$regions]);
    }
    public function branchSave(Request $request)
    {
        $this->validate($request,[
            'rest_name'=>'required'
        ]);
        $product = new Restaurant();
        $product->rest_name  = $request->input('rest_name');
        $product->branch_id  = $request->input('branch_id');
        $product->is_branch  = 1;
        if($request->file('img') != null){
            $image = $request->file('img');
            $filename  = time()+1 . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path = 'uploads/products/' . $filename;//-- string path


            Image::make($image->getRealPath())->save($path);
            $product->img = $filename;
        }
        if($request->file('img2') != null){
            $image = $request->file('img2');
            $filename2  = time()-1 . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path2 = 'uploads/products/' . $filename2;//-- string path


            Image::make($image->getRealPath())->save($path2);
            $product->img2 = $filename2;
        }
        $product->save();


        echo json_encode(['result'=>'success','product'=>$product]);
    }



    public function branchesUpdate(Request $request,$id)
    {
        $this->validate($request,[
            'rest_name'=>'required'
        ]);
        $product = Restaurant::find($id);
        $product->rest_name=$request->input('rest_name');
        $product->branch_id  = $request->input('branch_id');
        $product->is_branch  = 1;
        if($request->file('img') != null){
            $image = $request->file('img');
            $filename  = time()+1 . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path = 'uploads/products/' . $filename;//-- string path


            Image::make($image->getRealPath())->save($path);
            $product->img = $filename;
        }
        if($request->file('img2') != null){
            $image = $request->file('img2');
            $filename2  = time()-1 . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path2 = 'uploads/products/' . $filename2;//-- string path


            Image::make($image->getRealPath())->save($path2);
            $product->img2 = $filename2;
        }
        $product->save();

        echo json_encode(['result'=>'success','rest'=>$product]);
    }

    public function saveRegion(Request $request)
    {
        $this->validate($request,[
            'region_name'=>'required',
            'region_commission'=>'required'
        ]);
        $region = new Regions();
        $region->region_name  = $request->input('region_name');
        $region->region_commission  = $request->input('region_commission');

        $region->save();


        echo json_encode(['result'=>'success','region'=>$region]);
    }
    public function regionUpdate(Request $request,$id)
    {
        $this->validate($request,[
            'region_name'=>'required',
            'region_commission'=>'required'
        ]);
        $region = Regions::find($id);
        $region->region_name=$request->input('region_name');
        $region->region_commission  = $request->input('region_commission');

        $region->save();

        echo json_encode(['result'=>'success','rest'=>$region]);
    }

    public function branchesRecycle_bin($restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);
        DB::table('products')->where('product_rest_branch', $restaurant_id)->delete();
        $restaurant->delete();
        $result = 'success';

        echo json_encode(['result'=>$result]);
    }

    public function regionRecycle_bin($region)
    {
        $restaurant = Regions::find($region);
        $restaurant->delete();
        $result = 'success';

        echo json_encode(['result'=>$result]);
    }

    public function getSectionProducts(Request $request)
    {
        $all_products = Products::all();
        return $request->input('section_type');
    }


    public  function sse_all_notifications()
    {


        $notifications  = DB::table('requests')
            ->where('is_confirmed','==',0)
            ->where('is_seen','==',0)
            ->orderBy('id', 'desc')
            ->get();
        $count_notifications = count($notifications);
        $generated_html = '';
        $link_to = '';
        $counter = 0;
        $prv_request_id = 0;
        foreach ($notifications as $key => $item) {

            if($item->is_others == 1){
                $generated_html .= '<tr class="show-details  " style="background-color: #d1ffc6"><td>*</td><td style="direction: ltr; text-align: center;"><span class="product-name" >'.$item->phone_number.'</span></td><td><span class="product-price">'.$item->address.'</span></td><td><span class="unit-id" style="background-color: #E91E63;color: white;padding: 0px 11px;border-radius: 10px;">طلب نصي</span></td><td><span class="">'.$item->created_at.'</span></td><td>'.$item->hints.'</td><td class="text-center"><a href="#"  class="certify-request-btn" style="margin: 0px 3px;"><i class="  icon-check check-icon" style=" color: green;font-size: 18px;"></i></a><input type="hidden" name="product_id" class="product_id" value="'.$item->id.'" /><input type="hidden" name="request_id" class="request_id" value="'.$item->request_id.'" /></td></tr><tr style="background-color: #f1f1f1" class="hide-td request_'.$item->request_id.'"><td colspan="6" style="text-align: center;"><span style="font-weight: bold">التفاصيل</span></td></tr><tr style="background-color: #f6f6f6" class="hide-td request_'.$item->request_id.'"><td colspan="6" style="text-align: center;"><span style="">'.$item->order_other.'</span></td></tr>';
            }else{
                if($item->request_id != $prv_request_id){
                    $prv_request_id = $item->request_id;
                    $generated_html.= '<tr class="show-details  " style="background-color: #d1ffc6"><td>*</td><td style="direction: ltr;text-align: center;"><span class="product-name">'. $item->phone_number .'</span></td><td><span class="product-price">'. $item->address .'</span></td><td><span class="unit-id" style="color: #e20205">'. number_format($item->cartTotalCost,2)  .' شيكل</span></td><td><span class="">'.$item->created_at.'</span></td><td>'.$item->hints.'</td><td class="text-center"><a href="#"  class="certify-request-btn" style="margin: 0px 3px;"><i class="  icon-check check-icon" style=" color: green;font-size: 18px;"></i></a><input type="hidden" name="product_id" class="product_id" value="'. $item->id.'" /><input type="hidden" name="request_id" class="request_id" value="'. $item->request_id.'" /></td></tr><tr style="background-color: #f1f1f1" class="hide-td request_'. $item->request_id.'"><td colspan="3"><span style="font-weight: bold">إسم المنتج</span></td><td><span style="font-weight: bold">السعر</span></td><td><span style="font-weight: bold">الكمية</span></td><td><span style="font-weight: bold">التكلفة</span></td></tr><tr style="background-color: #f6f6f6" class="hide-td request_'. $item->request_id.'"><td colspan="3"><span style="">'.  $item->product_name .'</span></td><td><span style="">'.  $item->product_price .'</span></td><td><span style="">'.  $item->quantity .'</span></td><td><span style="">'.  $item->buy_cost .'</span></td></tr>';
                }else{
                    $generated_html .= ' <tr style="background-color: #f6f6f6" class="hide-td request_'.$item->request_id .'"><td colspan="3"><span style="">'. $item->product_name  .'</span></td><td><span style="">'. $item->product_price  .'</span></td><td><span style="">'. $item->quantity  .'</span></td><td><span style="">'. $item->buy_cost  .'</span></td></tr>';
                }
        }
            $counter++;
        }
        $result['count_notifications'] = $count_notifications;
        $result['notifications'] = $generated_html;
        $result['counter'] = $counter;
        DB::table('requests')
            ->where('is_confirmed','==',0)
            ->where('is_seen','==',0)
            ->update(['is_seen' => 1]);
        return json_encode($result);

//        $this->load->view('sse_notifications',$result);
    }

    public  function getAllRequests()
    {

        $requests = DB::table('requests')
            ->where('is_confirmed','==',0)
            ->orderBy('id', 'desc')
            ->get();

        return view('home',['requests'=>$requests]);

    }
    public  function getAllConfirmedRequests()
    {

        $requests = DB::table('requests')
            ->orderBy('id', 'desc')
            ->get();

        return view('all_confirmed_requests',['requests'=>$requests]);

    }
    public function certifyRequests($id)
    {

        DB::table('requests')
            ->where('request_id', $id)
            ->update(['is_confirmed' => 1]);

        echo json_encode(['result'=>'success']);
    }
    public function prepareRequests($id)
    {

        DB::table('requests')
            ->where('request_id', $id)
            ->update(['is_confirmed' => 2]);

        echo json_encode(['result'=>'success']);
    }

    public function rejectRequests($id)
    {

        DB::table('requests')
            ->where('request_id', $id)
            ->update(['is_confirmed' => 3]);

        echo json_encode(['result'=>'success']);
    }
    public function markRequests($id)
    {
        $user = DB::table('requests')
            ->where('request_id', $id)
            ->first();
         DB::table('app_users')->where('number', $user->phone_number)->update(['is_marked' => 1]);


        echo json_encode(['result'=>'success']);
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    public function undo_recycle_bin($student_id)
    {
        $result = 'fail';
        if(CommonFunctions::checkStudentBranch($student_id)) {
            $student =  Center_student_recyclebin::find($student_id);
            $recycle_student = new Center_students_tb();
            $recycle_student->student_name = $student->student_name;
            $recycle_student->student_address = $student->student_address;
            $recycle_student->student_father_work = $student->student_father_work;
            $recycle_student->student_phone = $student->student_phone;
            $recycle_student->student_phone2 = $student->student_phone2;
            $recycle_student->student_age = $student->student_age;
            $recycle_student->student_gender = $student->student_gender;
            $recycle_student->student_reg_date = $student->student_reg_date;
            $recycle_student->student_school = $student->student_school;
            $recycle_student->branch_id = $student->branch_id;
            $recycle_student->level_id= $student->level_id;
            $recycle_student->save();
            $student->delete();
            $result = 'success';
        }

        echo json_encode(['result'=>$result]);
    }

}
