@extends('layouts.app')

@section('content')
<section
    class="md:h-screen py-36 flex items-center bg-[url('../../assets/images/cta.html')] bg-no-repeat bg-center bg-cover">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black"></div>
    <div class="container relative">
        <div class="flex justify-center">
            <div
                class="max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
                <h5 class="my-6 text-xl font-semibold">{{ __('Reset Password') }}</h5>

                <div class="text-start">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email"
                                class="block text-md font-medium text-gray-700">{{ __('Email Address') }}</label>
                            <input id="email" type="email"
                                class="py-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection