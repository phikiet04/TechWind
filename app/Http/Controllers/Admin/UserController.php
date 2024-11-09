<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy trường sắp xếp và hướng sắp xếp từ query string
        $sortField = $request->get('sort', 'id'); // Mặc định sắp xếp theo 'id'
        $sortDirection = $request->get('direction', 'asc'); // Mặc định sắp xếp tăng dần

        // Lấy danh sách người dùng và sắp xếp theo trường và hướng đã chọn
        $users = User::orderBy($sortField, $sortDirection)->paginate(10);

        return view('admin.users.index', compact('users', 'sortField', 'sortDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create'); // Return the view for the create form
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user', // Validate role
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        \Log::info('Start creating user.', ['email' => $request->email]);

        // Create the user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hash the password
        $user->save(); // Save the user

        \Log::info('User created successfully.', ['user_id' => $user->id]);

        // Handle UserMeta (phone, address, role)
        $userMeta = new UserMeta();
        $userMeta->user_id = $user->id;
        $userMeta->phone = $request->phone;
        $userMeta->address = $request->address;
        $userMeta->role = $request->role;  // Store role in user_meta

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/users', 'public');
            $userMeta->image = $imagePath;  // Store image in user_meta
        }

        $userMeta->save(); // Save the user meta (including role and image)

        \Log::info('UserMeta created successfully.', ['user_id' => $user->id]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
    public function update(UpdateUserRequest $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Exclude current user's email from uniqueness check
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user', // Validate role
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        \Log::info('Start updating user.', ['user_id' => $id]);

        // Find the user by ID
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // If password is provided, hash and update it
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save(); // Save the user data

        \Log::info('User updated successfully.', ['user_id' => $user->id]);

        // Update user meta (phone, address, role)
        $userMeta = $user->userMeta;
        $userMeta->phone = $request->phone;
        $userMeta->address = $request->address;
        $userMeta->role = $request->role;  // Update role in user_meta

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($userMeta->image && \Storage::exists('public/' . $userMeta->image)) {
                \Storage::delete('public/' . $userMeta->image);
            }

            // Store the new image in 'images/users'
            $imagePath = $request->file('image')->store('images/users', 'public');
            $userMeta->image = $imagePath;  // Update image in user_meta
        }

        $userMeta->save(); // Save the updated user meta (including role and image)

        \Log::info('UserMeta updated successfully.', ['user_id' => $user->id]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::with('userMeta')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::with('userMeta')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $userMeta = $user->userMeta; // Retrieve associated user meta (may be null)

        // Check if userMeta exists before attempting to delete image
        if ($userMeta) {
            // Delete associated image from storage if it exists
            if ($userMeta->image && \Storage::exists('public/' . $userMeta->image)) {
                \Storage::delete('public/' . $userMeta->image);
            }

            // Delete the associated user meta
            $userMeta->delete();
        }

        // Delete the user record
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

}
