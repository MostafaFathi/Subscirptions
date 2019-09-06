<?php

namespace App\Http\Controllers;

use App\Center_branch_tb;
use App\Center_opening_tb;
use App\Educational_center_tb;
use App\User;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPSTORM_META\map;
use Intervention\Image\Facades\Image;

class CenterController extends Controller
{



    public function manage()
    {
        $center_id = Auth::user()->center_id;
        $center_info = Educational_center_tb::where('center_id','=',$center_id)->first();
        $all_centers = array();
        if(Auth::user()->privilege_type == 'admin')
            $all_centers = Educational_center_tb::all();

        // var_dump($center_info);
        return view('center.center_info',['center'=>$center_info,'all_centers'=>$all_centers]);
    }
    public function open_center()
    {
        $center_id = Auth::user()->center_id;
        $last_open = Center_opening_tb::where('center_id','=',$center_id)->orderBy('id','desc')->first();

        return view('center.open_center',['last_open'=>$last_open]);
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'center_name'=>'required',
            'center_email' => 'required|email',
            'center_phone'=>'required|min:7|max:10',
            //  'branch_id'=>'required',
            'img'=>'mimes:jpeg,jpg,png,gif|max:20000|file|image',
            'center_user_id'=>'required'
        ]);

        $center_user_id = $request->input('center_user_id');
        $center = new Educational_center_tb();
        $center->center_name  = $request->input('center_name');
        $center->center_address  = $request->input('center_address');
        $center->center_phone  = $request->input('center_phone');
        $center->center_email  = $request->input('center_email');
        $center->center_owner  = $request->input('center_owner');
        $center->center_cover_img = 'default_center.png';
        $center->status = $request->input('status');
        $center->first_open_date = Carbon::now();
        $center->center_user_id = $center_user_id;

        if($request->file('center_cover_img') != null){
            $image = $request->file('center_cover_img');
            $filename  = time() . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path = public_path('uploads/centers/' . $filename);//-- string path


            Image::make($image->getRealPath())->resize(200, 200)->save($path);
            $center->center_cover_img = $filename;
        }
        $center->save();
        User::where('id','=',$center_user_id)->update(['center_id'=>$center->center_id,'status'=>$center->status]);
        $primary_branch = new Center_branch_tb();
        $primary_branch->branch_name = $request->input('center_name').' | '.'الفرع الرئيسي';
        $primary_branch->branch_type = 'primary';
        $primary_branch->center_id = $center->center_id;
        $primary_branch->branch_phone = $center->center_phone;
        $primary_branch->branch_address = $center->center_address;
        $primary_branch->save();
        echo json_encode(['result'=>'success','center'=>$center]);
    }

    public function update(Request $request)
    {
        $center_id = Auth::user()->center_id;
        $center_id_form =$center_id;
        if($request->input('center_id_form')){
            $center_id_form = $request->input('center_id_form');
        }
        $this->validate($request,[
            'center_name'=>'required',
            'center_email' => 'required|email',
            'center_phone'=>'required|min:7|max:10',
            //  'branch_id'=>'required',
            'img'=>'mimes:jpeg,jpg,png,gif|max:20000|file|image'
        ]);
        if($request->input('status') == 'on')
            $status = 'active';
        else
            $status = 'inactive';
         $center =  Educational_center_tb::where('center_id','=',$center_id_form)->first();
        $center->center_name  = $request->input('center_name');
        $center->center_address  = $request->input('center_address');
        $center->center_phone  = $request->input('center_phone');
        $center->center_email  = $request->input('center_email');
        $center->center_owner  = $request->input('center_owner');
        $center->status = $status;

        if($request->file('center_cover_img') != null){
            $image = $request->file('center_cover_img');
            $filename  = time() . '.jpg' ;//. $image->getClientOriginalExtension();// get name and extention // save all images in jpg format

            $path = public_path('uploads/centers/' . $filename);//-- string path


            Image::make($image->getRealPath())->resize(200, 200)->save($path);
            $center->center_cover_img = $filename;
        }
        $center->save();
        User::where('center_id','=',$center->center_id)->update(['status'=>$status]);

        echo json_encode(['result'=>'success','center'=>$center,'status'=>$status]);
    }

    public function open_center_update(Request $request)
    {
        $this->validate($request,[
            'open_start_date'=>'required'
        ]);
        $center_id = Auth::user()->center_id;
        $open_start_date = $request->input('open_start_date');
        $last_open = Center_opening_tb::where('center_id','=',$center_id)->orderBy('id','desc')->get();


        if(count($last_open) > 0){
            $open_end_date= (new Carbon($open_start_date))->subDay(1);
            Center_opening_tb::where('center_id','=',$center_id)->orderBy('id','desc')
                ->first()
                ->update([
                'open_end_date'=>$open_end_date
            ]);
        }
        $open_end_date= null;
            $first_open = new Center_opening_tb();
            $first_open->center_id = $center_id;
            $first_open->open_start_date = $open_start_date;
            $first_open->open_end_date = $open_end_date;
            $first_open->save();

            session(['open_start_date'=>$open_start_date,'open_end_date'=>$open_end_date]);
        echo json_encode(['end_date'=>$open_end_date]);
    }
    public function edit($id)
    {
        $is_admin = false;
        if(Auth::user()->privilege_type == 'admin')
            $is_admin = true;
        $user_center = array();
        $manager_user = null;
        if($is_admin){
            $user_center = Educational_center_tb::find($id);
            $manager_user = $user_center->mainUser->name;

        }
        //$user_center = $user_center->mainUser->name;
        echo json_encode(['result'=>$user_center,'manager_user'=>$manager_user]);
    }
    public function search($key,$source,$last_id)
    {
        $result = array();
        $key_length = strlen($key);
        if($last_id == null)$last_id=0;
        if($source == 'users' && $key == 'empty'){
            $result = User::where('id','>',$last_id)->limit(11)->get();
        }else if($source == 'users' && $key_length > 0){
            $result = User::where('name','like','%'.$key.'%')->get();
        }
        $count = count($result);
        $last = collect($result)->last();
        if(!($last == null))
            $last = $last->id;
        $result  =  $this->get_html_rows(collect($result));
       echo json_encode(['result'=>$result,'counts'=>$count,'last_id'=>$last]);
    }

    public function get_html_rows($array)
    {
        if(count($array) > 0)
        $response = $array->map(function($item,$key){
           return  '<tr>'.
               '<td>'.($item->id).'</td>'.
               '<td><a href="#" class="user_id" style="display: block;"><input type="hidden" value="'.$item->id.'" />'.$item->name.'</a></td>'.
               '<td>'.$item->created_at.'</td>'.
               '</tr>';
        });
        else
            $response = collect('<tr><td colspan="3" style="text-align: center;">لا يوجد نتائج مطابقة</td></tr>');

        return (string) $response;
    }

}
