<?php
namespace App\Services\Dashboard;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StoreAdminService
{

    public function store($data)
    {


        $photo = isset($data["photo"]) ? UploadImage($data["photo"],"adminImage","logo") : NULL;

        return Admin::create([
            'name'=>$data['name'],
             'email'=>$data['email'],
              'password'=>Hash::make($data['password']),
              "phone"=>$data['phone'],
              "photo"=>$photo,
              "address"=>$data['address'],
              "admin_id"=>Auth::guard('admin')->user()->id,
        ]);

    }
    public function update($data,$id)
    {
        $admin=Admin::find($id);
        if(!$admin){
            return 0;
        }
        $photo=$admin->photo;
        if (isset($data["photo"])) {
            deleteImage("adminImage/" . $photo, "logo");
            $photo = UploadImage($data["image"], "adminImage", "logo");
        }
        return $admin->update([
            'name'=>$data['name'],
             'email'=>$data['email'],
              'password'=>Hash::make($data['password']),
              "phone"=>$data['phone'],
              "photo"=>$photo,
              "status"=>$data["status"]??1,
              "address"=>$data['address'],
              "admin_id"=>Auth::guard('admin')->user()->id,
        ]);

    }
    public function deleteAdmin($id){
        $admin = Admin::find($id);
        if(!$admin)
            return 0;

        $admin->delete();
        deleteImage("adminImage/" . $admin->photo, "logo");

        return $admin;
    }
}
