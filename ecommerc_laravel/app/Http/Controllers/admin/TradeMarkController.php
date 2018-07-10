<?php

namespace App\Http\Controllers\Admin;
use App\trademark as trademarkModel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\DataTables\TradeMarkDatatable;

use Storage;

class trademarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TradeMarkDatatable $trademark)
    {
        return $trademark->render('admin.trademarks.index',['title'=>'trademark Controller']);//render(viewe show data in)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trademarks.create');
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
          'trademark_name_ar'=>'required',
          'trademark_name_en'=>'required',
          'logo'=>'required|'.v_image(),// |unique:tablename that you want email be unique for
        ],[],[
          'trademark_name_ar'=>trans('admin.trademark_name_ar'),
          'trademark_name_en'=>trans('admin.trademark_name_en'),
          'logo'=>trans('admin.logo'),
        ]);
        if(request()->hasFile('logo')){
          $data['logo']=up()->uplode([
            'new_name'=>null,
            'file'		=>'logo',
            'path'		=>'trademarks',//folder name in storage folder
            'uplode_type'=>'single',

          ]);
        }
        trademarkModel::create($data);
        session()->flash('success','Added successfully');//flash mean create or update if exist
        return redirect(aurl('trademarks'));
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
        $trademark=trademarkModel::find($id);
        return view('admin.trademarks.edit',compact('trademark'));
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
        'trademark_name_ar'=>'required',
        'trademark_name_en'=>'required',
        'logo'=>'sometimes|nullable|'.v_image(),// |unique:tablename that you want email be unique for
      ],[],[
        'trademark_name_ar'=>trans('admin.trademark_name_ar'),
        'trademark_name_en'=>trans('admin.trademark_name_en'),
        'logo'=>trans('admin.logo'),
      ]);
      if(request()->hasFile('logo')){
        $data['logo']=up()->uplode([
          'new_name'    =>null,
          'file'		=>'logo',
          'path'		=>'trademarks',
          'uplode_type' =>'single',
          'delete_file' =>trademarkModel::find($id)->logo,
        ]);
      }
      else{
        $data['logo']=trademarkModel::find($id)->logo;
      }
      trademarkModel::where('id',$id)->update($data);
      session()->flash('success','Uptaded successfully');//flash mean create or update if exist
      return redirect(aurl('trademarks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trademark=trademarkModel::find($id);
        Storage::delete($trademark->logo);
        $trademark->delete();
        session()->flash('success','Deleted successfully');//flash mean create or update if exist
        return redirect(aurl('trademarks'));
    }

    public function multi_delete()
    {
      
      if(is_array(request('item'))){
        foreach (request('item') as $id) {
          $trademark=trademarkModel::find($id);
          Storage::delete($trademark->logo);
          $trademark->delete();
        }
      }else{
        $trademark=trademarkModel::find(request('item'));
        Storage::delete($trademark->logo);
        $trademark->delete();
      }
      session()->flash('success','Deleted successfully');//flash mean create or update if exist
      return redirect(aurl('trademarks'));
    }
}
