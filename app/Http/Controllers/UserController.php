<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(request $request){
        $user = new User;
        $users = $user::paginate(10);
        foreach($users as $user){
            $user->birthday=Carbon::parse($user->birthday)->format('d-m-Y');
        }
        return view('users.list', compact('users'));
    }
    public function store(UserRequest $request){
        if($request->method('POST')){
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $request->image = uploadFile('image', $request->file('image'));
                $params = $request->except('_token', 'image');
                $params['password'] = Hash::make($request->password);
                $params['image'] = $request->image;
                $user = User::create($params);
                if($user->id){
                    Session::flash('success', 'Add User Succesfully');
                }
            }
        }
        $title = "Add new users";
        return view('users.store',compact('title'));
    }

    public function update(UserRequest $request,$id){
        $user = DB::table('users')->where('id', $id)->first();
        $title = "Update user information";
        if($request->isMethod('POST')){
            $params = $request->except('_token', 'image','password_confirmation');
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $resultDL=Storage::delete('/public/'.$user->image);
                if($resultDL){
                    $request->image = uploadFile('image', $request->file('image'));
                    $params['image'] = $request->image;
                }else{
                    $params['image'] = $user->image;
                }
            }
            if($request->password == $user->password){
                $params['password'] = $user->password;
            }else{
                $params['password'] = Hash::make($request->password);
            }
            $result = User::where('id',$id)->update($params);
            if($result){
                Session::flash('success', 'Update User Infomation Successfully');
                return redirect()->route('edit_user', ['id' => $id]);
            }
        }
        return view('users.update', compact(['user','title']));
    }

    public function destroy(Request $request, $id){
        $user=DB::table('users')->where('id', $id)->first();
        $imageDL = Storage::delete('/public/' . $user->image);
        $userDL = User::where('id',$id)->delete();
        if($userDL){
            Session::flash('success', 'Delete User Successfully');
            return redirect()->route('users');
        }
    }

}
