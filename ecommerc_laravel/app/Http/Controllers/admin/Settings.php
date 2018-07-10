<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Setting;
//use Up;Up is alias name of Uplode Controller i register it in app.php in aliasis array
class Settings extends Controller {
	public function setting() {
		return view('admin.settings', ['title' => trans('admin.settings')]);
	}
	public function setting_save() {
		$data=request();
		$data = $this->validate(request(),
		[
			'logo'=>"image|mimes:jpg,gpeg,png,gif,bmp",
			'icon'=>"image|mimes:jpg,gpeg,png,gif,bmp",
			'name'=>"reequired",
			'email'=>"required",
			'main_lang'=>"required",
		],[],[
			"logo"=>trans('admin.logo'),
			"icon"=>trans('admin.icon'),
		]);
		if(up()->uplode()!=false)
		{

			$data['logo']=up()->uplode([
				'new_name'=>null,
				'file'		=>'logo',
				'path'		=>'settings',
				'uplode_type'=>'single',
				'delete_file'=>setting()->logo,
			]);
			//request()->file('input name')->store('folder name to create file in it');
			/*
			if folder settings does not exist will create it
			to specify the folder to have uplodes file
			1-put FILESYSTEM_DRIVER=path you want in .env file
			2-write command php artisan storage:link will create folder storage in the path you specify in .env
			then folder settings will create in storage folder
			*/

			$data['icon']=up()->uplode([
				'new_name'=>null,
				'file'		=>'icon',
				'path'		=>'settings',
				'uplode_type'=>'single',
				'delete_file'=>setting()->icon,
			]);
			
		}
		else{
			$data['icon']=setting()->icon;
			$data['logo']=setting()->logo;
		}
			$data['description']=request('description');
			$data['status']=request('status');
			$data['keywords']=request('keywords');
			$data['message_maintenance']=request('message_maintenance');
		//$this->validate(request(),['input name'=>"type|mimes:extension"]);
		Setting::orderBy('id', 'desc')->update($data);
		session()->flash('success', trans('admin.updated_record'));
		session()->forget('lang');
		return redirect(aurl('settings'));
	}
}
