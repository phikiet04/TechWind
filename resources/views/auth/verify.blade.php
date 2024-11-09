    @extends('layouts.app')

    @section('content')
    <section
        class="md:h-screen py-36 flex items-center bg-[url('../../assets/images/cta.html')] bg-no-repeat bg-center bg-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black"></div>
        <div class="container relative">
            <div class="flex justify-center">
                <div class="max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
                    <a href="index.html"><img src="assets/images/logo-icon-64.png" class="mx-auto" alt="" /></a>
                    <h5 class="my-6 text-xl font-semibold">{{ __('Verify Your Email Address') }}</h5>
                    <div class="text-start">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p>
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="text-indigo-600 hover:underline">
                                    {{ __('click here to request another') }}
                                </button>.
                            </form>
                        </p>
                        <p class="text-slate-400 mt-4">
                            {{ __('If you do not see the email, please check your spam or junk folder.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
