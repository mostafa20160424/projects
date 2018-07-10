<?php

namespace App\Http\Controllers\Admin;
use App\ManuFacture ;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\DataTables\ManuFactureDatatable;

use Storage;

class ManuFactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManuFactureDatatable $manufacture)
    {
        return $manufacture->render('admin.manufactures.index',['title'=>'manufacture Controller']);//render(viewe show data in)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufactures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         * to uplodes the photos in public/storage folder
         * 1-set FILESYSTEM_DRIVER=public in .env file
         * 2-write command "php artisan storage:link"
         * */
        $data=$this->validate(request(),[
            'manufacture_name_ar'=>'required',
            'manufacture_name_en'=>'required',
            'facebook'           =>'sometimes|nullable|url',
            'twitter'            =>'sometimes|nullable|url',
            'website'            =>'sometimes|nullable|url',
            'contact_me'         =>'sometimes|nullable|string',
            'mobile'             =>'required|numeric',
            'email'              =>'required|email',
            'lat'                =>'sometimes|nullable',
            'lng'                =>'sometimes|nullable',
            'logo'               =>'sometimes|nullable|'.v_image(),// |unique:tablename that you want email be unique for
        ],[],[
            'manufacture_name_ar'=>trans('admin.manufacture_name_ar'),
            'manufacture_name_en'=>trans('admin.manufacture_name_en'),
            'facebook'           =>trans('admin.facebook'),
            'twitter'            =>trans('admin.twitter'),
            'website'            =>trans('admin.website'),
            'contact_me'         =>trans('admin.contact_me'),
            'mobile'             =>trans('admin.mobile'),
            'email'              =>trans('admin.email'),
            'lat'                =>trans('admin.lat'),
            'lng'                =>trans('admin.lng'),
            'logo'=>trans('admin.logo'),
        ]);
        if(request()->hasFile('logo')){
          $data['logo']=up()->uplode([
            'new_name'=>null,
            'file'		=>'logo',
            'path'		=>'manufactures',//folder name in storage folder
            'uplode_type'=>'single',

          ]);
        }
        ManuFacture::create($data);
        session()->flash('success','Added successfully');//flash mean create or update if exist
        return redirect(aurl('manufactures'));
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
        $manufacture=ManuFacture::find($id);
        return view('admin.manufactures.edit',compact('manufacture'));
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
        $data=$this->validate(request(),[
            'manufacture_name_ar'=>'required',
            'manufacture_name_en'=>'required',
            'facebook'           =>'sometimes|nullable|url',
            'twitter'            =>'sometimes|nullable|url',
            'website'            =>'sometimes|nullable|url',
            'contact_me'         =>'sometimes|nullable|string',
            'mobile'             =>'required|numeric',
            'email'              =>'required|email',
            'lat'                =>'sometimes|nullable',
            'lng'                =>'sometimes|nullable',
            'logo'               =>'sometimes|nullable|'.v_image(),// |unique:tablename that you want email be unique for
        ],[],[
            'manufacture_name_ar'=>trans('admin.manufacture_name_ar'),
            'manufacture_name_en'=>trans('admin.manufacture_name_en'),
            'facebook'           =>trans('admin.facebook'),
            'twitter'            =>trans('admin.twitter'),
            'website'            =>trans('admin.website'),
            'contact_me'         =>trans('admin.contact_me'),
            'mobile'             =>trans('admin.mobile'),
            'email'              =>trans('admin.email'),
            'lat'                =>trans('admin.lat'),
            'lng'                =>trans('admin.lng'),
            'logo'=>trans('admin.logo'),
        ]);
      if(request()->hasFile('logo')){
        $data['logo']=up()->uplode([
          'new_name'    =>null,
          'file'		=>'logo',
          'path'		=>'manufactures',
          'uplode_type' =>'single',
          'delete_file' =>ManuFacture::find($id)->logo,
        ]);
      }
      else{
        $data['logo']=ManuFacture::find($id)->logo;
      }
        ManuFacture::where('id',$id)->update($data);
      session()->flash('success','Uptaded successfully');//flash mean create or update if exist
      return redirect(aurl('manufactures'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacture=ManuFacture::find($id);
        Storage::delete($manufacture->logo);
        $manufacture->delete();
        session()->flash('success','Deleted successfully');//flash mean create or update if exist
        return redirect(aurl('manufactures'));
    }

    public function multi_delete()
    {
      
      if(is_array(request('item'))){
        foreach (request('item') as $id) {
          $manufacture=ManuFacture::find($id);
          Storage::delete($manufacture->logo);
          $manufacture->delete();
        }
      }else{
        $manufacture=ManuFacture::find(request('item'));
        Storage::delete($manufacture->logo);
        $manufacture->delete();
      }
      session()->flash('success','Deleted successfully');//flash mean create or update if exist
      return redirect(aurl('manufactures'));
    }
}
