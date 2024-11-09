@extends('admin.inc.sidebar')
@section('title', 'User Profile')

@section('content')

<div class="main">

    <nav class="navbar navbar-expand px-3 border-bottom">
        <button class="btn" id="sidebar-toggle" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                        <img src="{{ asset('image/profile.jpg') }}" class="avatar img-fluid rounded"
                            alt="Profile Picture">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content p-5">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-4 pt-4 pb-2">
                        <h4>User Profile</h4>
                        <div class="mb-3">
                            <label class="form-label">Profile Picture</label>
                            <div>
                                <img src="{{ asset('storage/' . $user->image) }}" class="img-fluid rounded"
                                    alt="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <p class="form-control-plaintext">{{ $user->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <p class="form-control-plaintext">{{ $user->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <p class="form-control-plaintext">{{ ucfirst($user->role) }}</p>
                        </div>
                        <h5>User Meta</h5>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <p class="form-control-plaintext">{{ $user->address ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <p class="form-control-plaintext">{{ $user->phone ?? 'N/A' }}</p>
                        </div>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit User</a>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <a href="#" class="theme-toggle">
        <i class="fa-regular fa-moon"></i>
        <i class="fa-regular fa-sun"></i>
    </a>
</div>

@endsection