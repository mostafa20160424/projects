<?php

namespace App\Http\Controllers\Admin;
use App\Department ;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\DataTables\CityDatatable;

use Storage;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.departments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
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
          'dep_name_ar'    =>'required',
          'dep_name_en'    =>'required',
          'parent_id'      =>'sometimes|nullable|numeric',
          'icon'           => 'sometimes|nullable|'.v_image(),
          'description'    => 'sometimes|nullable',
          'keyword'        => 'sometimes|nullable',



        ],[],[
            'dep_name_ar'=>trans('admin.dep_name_ar'),
            'dep_name_en'=>trans('admin.dep_name_en'),
            'parent_id'=>trans('admin.parent_id'),
            'icon'    =>trans('admin.icon'),
            'description'    => trans('admin.description'),
            'keyword'        => trans('admin.keyword'),


        ]);
        if(request()->hasFile('icon')){
            $data['icon']=up()->uplode([
                'new_name'=>null,
                'file'		=>'icon',
                'path'		=>'departments',
                'uplode_type'=>'single',

            ]);
        }

        Department::create($data);
        session()->flash('success','Added successfully');//flash mean create or update if exist
        return redirect(aurl('departments'));
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

        $dep=Department::find($id);
        return view('admin.departments.edit',compact('dep'));
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
          'dep_name_ar'    =>'required',
          'dep_name_en'    =>'required',
          'parent_id'      =>'sometimes|nullable|numeric',
          'icon'           => 'sometimes|nullable',
          'description'    => 'sometimes|nullable',
          'keyword'        => 'sometimes|nullable',



      ],[],[
          'dep_name_ar'=>trans('admin.dep_name_ar'),
          'dep_name_en'=>trans('admin.dep_name_en'),
          'parent_id'=>trans('admin.parent_id'),
          'icon'    =>trans('admin.icon'),
          'description'    => trans('admin.description'),
          'keyword'        => trans('admin.keyword'),

      ]);

        if(request()->hasFile('icon')){
            $data['icon']=up()->uplode([
                'new_name'=>null,
                'file'		=>'icon',
                'path'		=>'departments',
                'uplode_type'=>'single',
            ]);
        }
        else{
            $data['icon']=Department::find($id)->icon;
        }

      Department::where('id',$id)->update($data);
      session()->flash('success','Uptaded successfully');//flash mean create or update if exist
      return redirect(aurl('departments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dep=Department::find($id);
        $childrens=Department::where('parent_id',$id)->get();
        if($childrens)
        {
            foreach ($childrens as $children){
                Storage::delete($children->icon);//will automatic know the image folder path in ٍsorage folder
                $children->delete();

            }
        }
        Storage::delete($dep->icon);
        $dep->delete();

        session()->flash('success','Deleted successfully');//flash mean create or update if exist
        return redirect(aurl('departments'));
    }

    public function multi_delete()
    {
      
      if(is_array(request('item'))){
        foreach (request('item') as $id) {
          $City=Department::find($id);
          $City->delete();
        }
      }else{
        $City=Department::find(request('item'));
        $City->delete();
      }
      session()->flash('success','Deleted successfully');//flash mean create or update if exist
      return redirect(aurl('cities'));
    }
}
