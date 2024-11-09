@extends('layouts.app')

@section('title', 'Checkout Success')

@section('content')
    <section class="relative md:py-24 py-16">
        <div class="container">
            <div class="text-center">
                <h2 class="text-2xl font-semibold">Thank you for your order!</h2>
                <p>Your order has been successfully placed. We will process it shortly.</p>
                <a href="{{route('home')}}" class="mt-4 inline-block py-2 px-4 bg-indigo-600 text-white rounded-md">Back to Home</a>
            </div>
        </div>
    </section>
@endsection
