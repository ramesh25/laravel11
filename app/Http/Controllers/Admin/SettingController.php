<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    private $title = 'Setting';
    private $controller = 'admin/setting';
    private $table = 'settings';
    private $update_form = 'admin.setting.index';


    public function index()
    {
        $title = $this->title. 'Management';
        //breadcrumb
        $breadcrumb = ABS . 'Settings';
        $model = Setting::first();
        // dd($model);
        return view($this->update_form, compact('title','breadcrumb', 'model'));
    }

    
    public function store(SettingRequest $request)
    {       
        $model = new Setting();
        // dd($request->all());
        $model->site_title = $request['site_title'];
        $model->email = $request['email'];
        $model->email_2 = $request['email_2'];
        $model->landline = $request['landline'];
        $model->landline_2 = $request['landline_2'];
        $model->mobile_no = $request['mobile_no'];
        $model->mobile_no_2 = $request['mobile_no_2'];
        $model->fax = $request['fax'];
        $model->address = $request['address'];
        $model->post_code = $request['post_code'];
        $model->google_analytics = $request['google_analytics'];
        $model->google_map = $request['google_map'];
        $model->meta_title = $request['meta_title'];
        $model->meta_keywords = $request['meta_keywords'];
        $model->meta_description = $request['meta_description'];

        $folder= 'uploads/setting/';
        $titleicon = 'favicon';
         if ($request->hasFile('favicon')) { 
            $extension = $request->file('favicon')->getClientOriginalExtension();
            $favicon = $titleicon . time() . '.' . $extension;
            $request->file('favicon')->move($folder, $favicon);
           $model->favicon = $folder.$favicon;
          } else if ($request->get('delete_favicon')) {
            if ($model->favicon) {
             File::delete(public_path() . $folder, $model->favicon);
            }
            $model->favicon = '';
        }
        $titlelogo = 'logo';
         if ($request->hasFile('logo')) { 
            $extension = $request->file('logo')->getClientOriginalExtension();
            $logo = $titlelogo . time() . '.' . $extension;
            $request->file('logo')->move($folder, $logo);
           $model->logo = $folder.$logo;
          } else if ($request->get('delete_logo')) {
            if ($model->logo) {
             File::delete(public_path() . $folder, $model->logo);
            }
            $model->logo = '';
        }    
        $model->save();
        return redirect()->back()->with('success', '<span>Record has been Successfully Updated</span>');
        }
        


    public function update(SettingRequest $request, $id)
    {
        // dd($request->all());        
        $model = Setting::find($id);
        $model->site_title = $request['site_title'];
        $model->email = $request['email'];
        $model->email_2 = $request['email_2'];
        $model->landline = $request['landline'];
        $model->landline_2 = $request['landline_2'];
        $model->mobile_no = $request['mobile_no'];
        $model->mobile_no_2 = $request['mobile_no_2'];
        $model->fax = $request['fax'];
        $model->address = $request['address'];
        $model->post_code = $request['post_code'];
        $model->google_analytics = $request['google_analytics'];
        $model->google_map = $request['google_map'];
        $model->meta_title = $request['meta_title'];
        $model->meta_keywords = $request['meta_keywords'];
        $model->meta_description = $request['meta_description'];

        $folder = 'uploads/setting/';
        $titlelogo = 'logo';

        if ($request->hasFile('logo')) {
            // Delete existing logo
            if ($model->logo) {
                \File::delete(public_path($model->logo)); // <- FIXED LINE
            }

            $extension = $request->file('logo')->getClientOriginalExtension();
            $logo = $titlelogo . time() . '.' . $extension;
            $request->file('logo')->move(public_path($folder), $logo);
            $model->logo = $folder . $logo;

        } else if ($request->get('delete_logo')) {
            if ($model->logo) {
                \File::delete(public_path($model->logo)); // <- FIXED LINE
            }
            $model->logo = '';
        }


        $titlefavicon = 'favicon';
         if ($request->hasFile('favicon')) {
            if ($model->favicon) {
                \File::delete(public_path($model->favicon)); // <- FIXED LINE
            }

            $extension = $request->file('favicon')->getClientOriginalExtension();
            $favicon = $titlefavicon . time() . '.' . $extension;
            $request->file('favicon')->move($folder, $favicon);
           $model->favicon = $folder.$favicon;
        } else if ($request->get('delete_favicon')) {
            if ($model->favicon) {
             \File::delete(public_path() . $folder, $model->favicon);
            }
            $model->favicon = '';
        }
        $model->save();
        return redirect()->back()->with('success', '<span>Record has been Successfully Updated</span>');
        }
        

}