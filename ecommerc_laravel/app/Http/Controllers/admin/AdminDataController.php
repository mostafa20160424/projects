<?php

namespace App\Http\Controllers\Admin;
use App\Admin as AdminModel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\DataTables\AdminDatatable;

class AdminDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDatatable $admin)
    {
        return $admin->render('admin.admins.index',['title'=>'Admin Controller']);//render(viewe show data in)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
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
          'name'=>'required',
          'email'=>'required|email|unique:admins',// |unique:tablename that you want email be unique for
          'password'=>'required',
        ],[],[
          'name'=>trans('admin.name'),
          'email'=>trans('admin.email'),
          'password'=>trans('admin.password'),
        ]);
        $data['password']=bcrypt(request('password'));
        AdminModel::create($data);
        session()->flash('success','Added successfully');//flash mean create or update if exist
        return redirect('admin/admin');
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
        $admin=AdminModel::find($id);
        return view('admin.admins.edit',compact('admin'));
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
        'name'=>'required',//input name => validation
        'email'=>'required|email|unique:admins,email,'.$id,// |unique:tablename will search any row have this email except this id
        'password'=>'sometimes|nullable|min:6',//sometimes nullable if you leave the field empty will take old password
      ],[],[
        'name'=>trans('admin.name'),
        'email'=>"Admin Email",
        'password'=>trans('admin.password'),
      ]);
      if(request()->has('password')){

        $data['password']=bcrypt(request('password'));//$request->password
      }
      AdminModel::where('id',$id)->update($data);
      //where(' column name',equal to value) 
      //where(' column name','operator',equal to value) 
      //EX: where('id','<',$id) 
      session()->flash('success','Uptaded successfully');//flash mean create or update if exist
      return redirect('admin/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AdminModel::find($id)->delete();
        session()->flash('success','Deleted successfully');//flash mean create or update if exist
        return redirect('admin/admin');
    }

    public function multi_delete()
    {
      if(is_array(request('item'))){
        AdminModel::destroy(request('item'));
      }else{
        AdminModel::find(request('item'))->delete();
      }
      session()->flash('success','Deleted successfully');//flash mean create or update if exist
      return redirect('admin/admin');
    }
}
