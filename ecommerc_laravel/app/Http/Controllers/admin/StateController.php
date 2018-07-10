<?php

namespace App\Http\Controllers\Admin;
use App\City;
use App\State as StateModel;
use App\Http\Controllers\Controller;

use Form;

use Illuminate\Http\Request;

use App\DataTables\StateDatatable;

use Storage;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StateDatatable $state)
    {
        return $state->render('admin.states.index',['title'=>'state Controller']);//render(viewe show data in)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax())
        {
            $select=request()->has('select')? request('select') : '';
            if(request()->has('country_id')){
                return Form::select('city_id',City::where('country_id','=',request('country_id'))
                    ->pluck('city_name_'.session('lang'),'id'),$select,['class'=>"form-control" , "placeholder"=> "...."]);
            }
        }
        return view('admin.states.create');
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
          'state_name_ar'=>'required',
          'state_name_en'=>'required',
          'country_id'=>'required|numeric',
            'city_id'=>'required|numeric',

        ],[],[
          'state_name_ar'=>trans('admin.state_name_ar'),
          'state_name_en'=>trans('admin.state_name_en'),
          'country_id'=>trans('admin.country_id'),
          'city_id'=>trans('admin.city_id'),

        ]);

        StateModel::create($data);
        session()->flash('success','Added successfully');//flash mean create or update if exist
        return redirect(aurl('states'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return State::all();
        //return State::orderBy('id','desc')->get();
        //return State::get();
        //return DB::table('states')->get();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state=StateModel::find($id);
        return view('admin.states.edit',compact('state'));
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
        'state_name_ar'=>'required',
        'state_name_en'=>'required',
        'country_id'=>'required|numeric',
        'city_id'=>'required|numeric',


      ],[],[
        'state_name_ar'=>trans('admin.state_name_ar'),
        'state_name_en'=>trans('admin.state_name_en'),
        'country_id'=>trans('admin.country_id'),
          'city_id'=>trans('admin.country_id'),

      ]);

        StateModel::where('id',$id)->update($data);
      session()->flash('success','Uptaded successfully');//flash mean create or update if exist
      return redirect(aurl('states'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state=StateModel::find($id);
        $state->delete();
        session()->flash('success','Deleted successfully');//flash mean create or update if exist
        return redirect(aurl('states'));
    }

    public function multi_delete()
    {
      
      if(is_array(request('item'))){
        foreach (request('item') as $id) {
          $state=StateModel::find($id);
          $state->delete();
        }
      }else{
        $state=StateModel::find(request('item'));
        $state->delete();
      }
      session()->flash('success','Deleted successfully');//flash mean create or update if exist
      return redirect(aurl('states'));
    }
}
