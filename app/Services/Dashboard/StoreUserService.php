<?php
namespace App\Services\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StoreUserService
{

    /**
     * store
     *
     * @param  mixed $data
     * @return mixed
     */
    public function store($data):mixed
    {
       return User::create([
            'name'=>$data['name'],
             'email'=>$data['email'],
              'password'=>Hash::make($data['password']),
              "admin_id"=>Auth::guard('admin')->user()->id,
        ]);
    }
    /**
     * update
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return mixed
     */
    public function update($data,int $id):mixed
    {
       $user= User::find($id);
       if(isset($user))
       $user->update([
            'name'=>$data['name'],
             'email'=>$data['email'],
              'password'=>Hash::make($data['password']),
              "admin_id"=>Auth::guard('admin')->user()->id,
        ]);
        else return 0;
        return 1;
    }
    /**
     * deleteUser
     *
     * @param  mixed $id
     * @return mixed
     */
    public function deleteUser($id):mixed
    {
        $user= User::find($id);
        if(isset($user))
        $user->delete();
        return 1;

    }
}
