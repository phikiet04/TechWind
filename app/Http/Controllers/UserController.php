<?php
namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserMeta;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::with('userMeta')->get();  // Lấy tất cả người dùng kèm theo thông tin meta (phone, address, etc.)
        return view('users.index', compact('users'));
    }

    // Hiển thị thông tin chi tiết một người dùng
    public function show($id)
    {
        $user = User::with('userMeta', 'orders', 'blogs')->findOrFail($id);
        return view('account', compact('user'));
    }

    // Cập nhật địa chỉ người dùng
    public function updateAddress(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to update your address.');
        }

        // Validate dữ liệu đầu vào
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        // Lấy userMeta của người dùng hiện tại
        $user = Auth::user(); // Get the authenticated user
        $userMeta = $user->userMeta;

        // If userMeta doesn't exist, create it
        if (!$userMeta) {
            $userMeta = $user->userMeta()->create(); // Create a new userMeta record if not present
        }

        // Cập nhật thông tin địa chỉ và điện thoại cho người dùng
        $userMeta->update([
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        // Trả về trang người dùng với thông báo thành công
        return redirect()->route('users.show', ['id' => $user->id])->with('success', 'Your address has been updated successfully.');
    }
    public function updateProfile(UpdateUserRequest $request)
    {
        // Lấy người dùng hiện tại
        $user = auth()->user();

        // Cập nhật thông tin cơ bản người dùng
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        // Nếu có mật khẩu mới, cập nhật mật khẩu
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Nếu có số điện thoại, cập nhật số điện thoại
        if ($request->filled('phone')) {
            $user->phone = $request->phone;
        }

        // Nếu có địa chỉ, cập nhật địa chỉ
        if ($request->filled('address')) {
            $user->address = $request->address;
        }

        // Nếu có vai trò, cập nhật vai trò
        if ($request->filled('role')) {
            $user->role = $request->role;
        }

        // Kiểm tra nếu có hình ảnh avatar được tải lên
        if ($request->hasFile('avatar')) {
            // Kiểm tra nếu có ảnh cũ, xóa ảnh cũ (nếu có)
            if ($user->userMeta && $user->userMeta->image) {
                // Xóa ảnh cũ nếu có
                Storage::delete('public/' . $user->userMeta->image);
            }

            // Lưu ảnh mới vào thư mục 'avatars' trong storage
            $avatarPath = $request->file('avatar')->store('avatars', 'public');

            // Cập nhật thông tin avatar trong userMeta (hoặc user nếu bạn lưu trực tiếp vào bảng users)
            $user->userMeta()->update(['image' => $avatarPath]);
        }


        // Lưu thông tin người dùng
        $user->save();

        // Trả về thông báo thành công
        return redirect()->route('users.show', ['id' => $user->id])->with('success', 'Profile updated successfully.');
    }

}
