<?php

namespace App\Http\Controllers\Admin;

use App\User as UserModel;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\DataTables\UserDatatable;

class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDatatable $admin)
    {
        return $admin->render('admin.users.index',['title'=>'User Controller']);//render(viewe show data in)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
          'email'=>'required|email|unique:users',// |unique:tablename that you want email be unique for
          'password'=>'required',
          'level'=>'required|in:user,company,vendor',
        ],[],[
          'name'=>trans('admin.name'),
          'email'=>trans('admin.email'),
          'password'=>trans('admin.password'),
          'level'=>trans('admin.level'),
        ]);
        $data['password']=bcrypt(request('password'));
        UserModel::create($data);
        session()->flash('success','Added successfully');//flash mean create or update if exist
        return redirect(aurl('users'));
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
        $user=UserModel::find($id);
        return view('admin.users.edit',compact('user'));
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
        'name'=>'required',
        'email'=>'required|email|unique:users,email,'.$id,// |unique:tablename will search any row have this email except this id
        'password'=>'sometimes|nullable|min:6',//sometimes nullable if you leave the field empty will take old password
        'level' => "required|in:user,company,vendor",//must be user or vendor or company
      ],[],[
        'name'=>trans('admin.name'),
        'email'=>"Admin Email",
        'password'=>trans('admin.password'),
        'level'   =>trans('admin.level'),
      ]);
      if(request()->has('password')){

        $data['password']=bcrypt(request('password'));//$request->password
      }
      UserModel::where('id',$id)->update($data);
      session()->flash('success','Uptaded successfully');//flash mean create or update if exist
      return redirect(aurl('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserModel::find($id)->delete();
        session()->flash('success','Deleted successfully');//flash mean create or update if exist
        return redirect(aurl('users'));
    }

    public function multi_delete()
    {
      if(is_array(request('item'))){
        UserModel::destroy(request('item'));
      }else{
        UserModel::find(request('item'))->delete();
      }
      session()->flash('success','Deleted successfully');//flash mean create or update if exist
      return redirect(aurl('users'));
    }
}
