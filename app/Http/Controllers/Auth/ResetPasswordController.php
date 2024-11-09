<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Đảm bảo bạn đã import Auth

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/home';

    public function reset(ResetPasswordRequest $request)
    {
        // Tìm người dùng qua email
        $user = User::where('email', $request->email)->first();

        // Nếu không tìm thấy người dùng, trả về lỗi
        if (!$user) {
            return back()->withErrors(['email' => __('Email không tồn tại.')]);
        }

        // Gọi phương thức resetPassword với đối tượng User
        return $this->resetPassword($request, $user);
    }

    protected function resetPassword(ResetPasswordRequest $request, User $user)
    {
        // Đặt mật khẩu cho người dùng
        $user->password = bcrypt($request->password);
        $user->save();

        // Đăng nhập người dùng (nếu cần)
        Auth::login($user); // Đăng nhập tự động sau khi reset

        // Thông báo thành công
        return redirect($this->redirectTo)->with('status', __('Mật khẩu đã được đặt lại thành công.'));
    }
}
