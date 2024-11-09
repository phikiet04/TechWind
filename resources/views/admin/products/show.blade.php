@extends('admin.inc.app')
@section('title', 'Show Product')

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
                        <h4 class="mb-4">Product Details</h4>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <p class="form-control-plaintext">{{ $product->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <p class="form-control-plaintext">{{ $product->description }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <p class="form-control-plaintext">{{ $product->category->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <p class="form-control-plaintext">{{ $product->quantity }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <p class="form-control-plaintext">${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <div>
                                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid"
                                    alt="{{ $product->name }}">
                            </div>
                        </div>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit Product</a>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
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