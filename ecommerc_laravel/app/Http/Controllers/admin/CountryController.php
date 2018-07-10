<?php

namespace App\Http\Controllers\Admin;
use App\Country as CountryModel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\DataTables\CountryDatatable;

use Storage;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountryDatatable $country)
    {
        return $country->render('admin.countries.index',['title'=>'Country Controller']);//render(viewe show data in)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$this->validate(request(),[
          'country_name_ar'=>'required',
          'country_name_en'=>'required',
          'mob'=>'required',
          'code'=>'required',
          'logo'=>'required|'.v_image(),// |unique:tablename that you want email be unique for
        ],[],[
          'country_name_ar'=>trans('admin.country_name_ar'),
          'country_name_en'=>trans('admin.country_name_en'),
          'mob'=>trans('admin.mob'),
          'code'=>trans('admin.code'),
          'logo'=>trans('admin.logo'),
        ]);
        if(request()->hasFile('logo')){
          $data['logo']=up()->uplode([
            'new_name'=>null,
            'file'		=>'logo',
            'path'		=>'countries',
            'uplode_type'=>'single',

          ]);
        }
        CountryModel::create($data);
        session()->flash('success','Added successfully');//flash mean create or update if exist
        return redirect(aurl('countries'));
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
        $country=CountryModel::find($id);
        return view('admin.countries.edit',compact('country'));
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
        'country_name_ar'=>'required',
        'country_name_en'=>'required',
        'mob'=>'required',
        'code'=>'required',
        'logo'=>'sometimes|nullable|'.v_image(),// |unique:tablename that you want email be unique for
      ],[],[
        'country_name_ar'=>trans('admin.country_name_ar'),
        'country_name_en'=>trans('admin.country_name_en'),
        'mob'=>trans('admin.mob'),
        'code'=>trans('admin.code'),
        'logo'=>trans('admin.logo'),
      ]);
      if(request()->hasFile('logo')){
        $data['logo']=up()->uplode([
          'new_name'    =>null,
          'file'		=>'logo',
          'path'		=>'countries',
          'uplode_type' =>'single',
          'delete_file' =>CountryModel::find($id)->logo,
        ]);
      }
      else{
        $data['logo']=CountryModel::find($id)->logo;
      }
      CountryModel::where('id',$id)->update($data);
      session()->flash('success','Uptaded successfully');//flash mean create or update if exist
      return redirect(aurl('countries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country=CountryModel::find($id);
        Storage::delete($country->logo);
        $country->delete();
        session()->flash('success','Deleted successfully');//flash mean create or update if exist
        return redirect(aurl('countries'));
    }

    public function multi_delete()
    {
      
      if(is_array(request('item'))){
        foreach (request('item') as $id) {
          $country=CountryModel::find($id);
          Storage::delete($country->logo);
          $country->delete();
        }
      }else{
        $country=CountryModel::find(request('item'));
        Storage::delete($country->logo);
        $country->delete();
      }
      session()->flash('success','Deleted successfully');//flash mean create or update if exist
      return redirect(aurl('countries'));
    }
}
