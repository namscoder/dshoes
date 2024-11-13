<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate(
                [
                    'email' => 'required|email',
                    'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/'
                ],
                [
                    'email.required' => "Chưa nhập email",
                    'email.email' => "Email không đúng định dạng",
                    'password.required' => "Chưa nhập mật khẩu",
                    'password.regex' => "Mật khẩu phải có ít nhất 1 chữ viết hoa, chữ thường, số và ký tự đặc biệt"
                ]
            );
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = DB::table('users')->where('email', $request->email)->first();
                if ($user->role == 0) {
                    return redirect()->route('home');
                } else {
                    return redirect()->route('admin');
                }
            } else {
                Session::flash('error', 'Thông tin tài khoản hoặc mật khẩu không chính xác');
                return redirect()->route('login');
            }
        }
        return view("auth.login");
    }
    public function register(AuthRequest $request)
    {

        if ($request->method('POST')) {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $filePath = $request->file('image')->store('images', 'public'); // Lưu file vào thư mục public/images
                $request->image = $filePath;
                $params = $request->except('_token', 'image');
                $params['password'] = Hash::make($request->password);
                $params['image'] = $filePath;
                $user = User::create($params);
                if ($user->id) {
                    Session::flash('success', 'Đăng ký thành công. Đăng nhập để tiếp tục mua hàng.');
                    return redirect()->route('login');
                }
            }
        }
        return view("auth.register");
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }

    public function profile(Request $request)
    {

        return view('auth.profile');
    }
    public function update_Avatar(Request $request)
    {
        if ($request->isMethod('POST')) {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $resultDL = Storage::delete('/public/' . Auth::user()->image);
                if ($resultDL || Auth::user()->image === '') {
                    $image = uploadFile('image', $request->file('image'));
                } else {
                    $image = Auth::user()->image;
                }
            }
            $img_ud = DB::table('users')->where('id', Auth::user()->id)->update(['image' => $image]);

            if ($img_ud) {
                Session::flash('success', 'Cập nhật ảnh đại diện thành công');
                return redirect()->route('profile');
            }
        }
    }
    public function update_Password(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (Hash::check($request->old_password, Auth::user()->password)) {
                $request->validate(
                    [
                        'password' =>  [
                            'required',
                            'confirmed',
                            'min:8',
                            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/'
                        ],
                    ],
                    [
                        'password.required' => "Mật khẩu không được để trống",
                        'password.confirmed' => "Mật khẩu không trùng khớp",
                        'password.min' | 'password.regex' => "Yêu cầu mật khẩu có ít nhất 8 ký tự, chứa các chữ cái và bao gồm các ký tự đặc biệt(*@!#...).",
                    ]
                );
                $params = $request->except('_token', 'password_confirmation');
                $pw_ud = DB::table("users")->where("id", "=", Auth::user()->id)->update(["password" => Hash::make($params['password'])]);
                if ($pw_ud) {
                    Session::flash("success_pw", "Cập nhật mật khẩu thành công");
                    return redirect()->route("profile");
                }
            } else {
                Session::flash("error_pw", "Vui lòng nhập đúng mật khẩu cũ của bạn");
                return redirect()->route("profile");
            }
        }
    }
    public function update_Profile(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate(
                [
                    'name' => 'required',
                    'email' => [
                        'required',
                        'email',

                        Rule::unique('users')->ignore(Auth::user()->id)
                    ],
                    'phone_number' => [
                        'required',
                        'regex:/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/',

                        Rule::unique('users')->ignore(Auth::user()->id)
                    ],
                    'address' => 'required',
                    'birthday' => 'required',
                    'gender' => 'required',
                ],
                [
                    'name.required' => "Tên không được để trống",
                    'email.required' => "Email không được để trống",
                    'email.email' => "Email không đúng định dạng",
                    'email.unique' => "Email đã được đăng ký",
                    'phone_number.required' => "Số điện thoại không được để trống",
                    'phone_number.regex' => "Số điện thoại không đúng định dạng",
                    'phone_number.unique' => "Số điện thoại đã được đăng ký",
                    'address.required' => "Địa chỉ không được để trống",
                    'birthday.required' => "Ngày sinh không được để trống",
                    'gender.required' => "Giới tính chưa được chọn",
                ]
            );
            $params = $request->except('_token');
            $user_UD = DB::table("users")->where("id", "=", Auth::user()->id)->update([
                "name" => $params['name'],
                "email" => $params['email'],
                "phone_number" => $params['phone_number'],
                "address" => $params['address'],
                "birthday" => $params['birthday'],
                "gender" => $params['gender']
            ]);
            if ($user_UD) {
                Session::flash("success_profile", "Cập nhật thông tin thành công");
                return redirect()->route("profile");
            } else {
                Session::flash("success_profile", "Cập nhật thông tin thành công");
                return redirect()->route("profile");
            }
        }
    }
}
