<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Uplode extends Controller
{
  /*
  $data array pth to function uplode have all argument at bottom
$request,$path,$uplode_type='single',$delete_file=null,$newName=null,$crud_type=[]

  */
    public function uplode($data=[])
    {
      if(empty($data)){
        return false;
      }
      if(request()->hasFile($data['file']) && $data['uplode_type']){
        $newName=$data['new_name'] === null? time():$data['new_name'];
        !empty($data['delete_file'])? \Storage::delete($data['delete_file']):'';
        return request()->file($data['file'])->store($data['path']);
      }
    }
}
