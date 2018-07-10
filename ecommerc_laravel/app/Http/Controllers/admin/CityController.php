<?php

namespace App\Http\Controllers\Admin;

use App\City as CityModel;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\DataTables\CityDatatable;

use Storage;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CityDatatable $City)
    {
        return $City->render('admin.cities.index',['title'=>'City Controller']);//render(viewe show data in)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create');
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
          'city_name_ar'=>'required',
          'city_name_en'=>'required',
          'country_id'=>'required|numeric',

        ],[],[
          'city_name_ar'=>trans('admin.city_name_ar'),
          'city_name_en'=>trans('admin.city_name_en'),
          'country_id'=>trans('admin.country_id'),

        ]);

        CityModel::create($data);
        session()->flash('success','Added successfully');//flash mean create or update if exist
        return redirect(aurl('cities'));
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
        $city=CityModel::find($id);
        return view('admin.cities.edit',compact('city'));
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
        'city_name_ar'=>'required',
        'city_name_en'=>'required',
        'country_id'=>'required|numeric',

      ],[],[
        'city_name_ar'=>trans('admin.city_name_ar'),
        'city_name_en'=>trans('admin.city_name_en'),
        'country_id'=>trans('admin.country_id'),        

      ]);

      CityModel::where('id',$id)->update($data);
      session()->flash('success','Uptaded successfully');//flash mean create or update if exist
      return redirect(aurl('cities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $City=CityModel::find($id);
        $City->delete();
        session()->flash('success','Deleted successfully');//flash mean create or update if exist
        return redirect(aurl('cities'));
    }

    public function multi_delete()
    {
      
      if(is_array(request('item'))){
        foreach (request('item') as $id) {
          $City=CityModel::find($id);
          $City->delete();
        }
      }else{
        $City=CityModel::find(request('item'));
        $City->delete();
      }
      session()->flash('success','Deleted successfully');//flash mean create or update if exist
      return redirect(aurl('cities'));
    }
}
