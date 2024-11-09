<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserMeta; // Thêm import cho UserMeta
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\RegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->create($request->validated());

        // Thêm thông tin vào bảng user_meta
        UserMeta::create([
            'user_id' => $user->id,
            'phone' => $request->input('phone'), // Lấy thông tin từ request
            'address' => $request->input('address'), // Lấy thông tin từ request
            'role' => 'user',
            'image' => $request->input('image'), // Lấy thông tin từ request
        ]);
        $user->sendEmailVerificationNotification();

        // Đăng nhập người dùng
        auth()->login($user);
        if ($request->input('role') === 'admin') {
            return redirect()->route('admin.home');
        }

        // Chuyển hướng đến trang mong muốn
        return redirect()->route('verification.notice');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

}