<x-layout>

    {{-- javascript --}}
    @vite(['resources/js/login.js'])

    <div class="flex lg:flex-row h-full md:flex-col">

        <div class="lg:w-2/5 w-full flex items-center justify-center h-screen px-8">

            <div class="w-full flex flex-col items-center justify-center">

                <p class="text-3xl font-bold text-primary mb-5">SIGN IN</p>

                <div
                    class="form-control w-full max-w-md px-6 py-4 border shadow-2xl border-gray-300 rounded-2xl bg-neutral-50">

                    {{-- <p class="text-3xl font-bold text-neutral-700 text-center">SIGN IN</p> --}}

                    <form action="{{ route('login') }}" method="post" class="flex flex-col gap-4">
                        @csrf

                        {{-- email --}}
                        <div class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600">
                            <label for="email" class="pl-1">Email</label>
                            <input type="text" placeholder="example@gmail.com"
                                class="input input-bordered w-full @error('email') border-2 border-red-400 @enderror"
                                name="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-1 text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- password --}}
                        <div class="relative grow font-medium text-sm sm:text-md md:text-lg text-neutral-600">
                            <label for="password" class="pl-1">Password</label>
                            <div class="relative">
                                <input id="password" type="password" placeholder="•••••••"
                                    class="mt-1 input input-bordered w-full pr-10 @error('password') border-2 border-red-400 @enderror"
                                    name="password">
                                <span id="togglePassword" class="absolute right-5 top-2.5 cursor-pointer">
                                    <i class="fa fa-eye text-gray-400 hover:text-gray-500"></i>
                                </span>
                            </div>
                            @error('password')
                                <p class="mt-1 text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- barangay id --}}
                        <div class="relative grow font-medium text-sm sm:text-md md:text-lg text-neutral-600">
                            <label for="barangayID" class="pl-1">Barangay ID</label>
                            <div class="relative">
                                <input id="barangayID" type="password" placeholder="•••••••"
                                    class="mt-1 input input-bordered w-full pr-10 @error('barangayID') border-2 border-red-400 @enderror"
                                    name="barangayID">
                                <span id="toggleBarangayID" class="absolute right-5 top-2.5 cursor-pointer">
                                    <i class="fa fa-eye text-gray-400 hover:text-gray-500"></i>
                                </span>
                            </div>
                            @error('barangayID')
                                <p class="mt-1 text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <a href="{{ route('welcome') }}"><i
                                class="fa-solid fa-circle-arrow-left text-primary text-3xl absolute top-4 left-4"></i></a>

                        {{-- remember me --}}
                        <div class="flex items-center">
                            <input type="checkbox" class="checkbox border border-neutral-400" name="remember"
                                id="remember" />
                            <label for="remember"
                                class="pl-2 font-medium text-sm sm:text-md md:text-lg text-neutral-600">Remember
                                me</label>
                        </div>

                        @error('failed')
                            <p class="mt-1 text-error">{{ $message }}</p>
                        @enderror

                        {{-- button --}}
                        <button class="btn mt-1 btn-primary font-bold text-sm sm:text-md md:text-lg">Sign In</button>

                        {{-- navigate --}}
                        <div>
                            <div
                                class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600 flex justify-center">
                                <p>Don't have an account? <a href="{{ route('signup') }}"
                                        class="hover:underline text-primary">Sign up here</a></p>
                            </div>
                            <div
                                class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600 flex justify-center">

                                <!-- You can open the modal using ID.showModal() method -->
                                <a class="text-primary hover:underline cursor-pointer"
                                    onclick="document.getElementById('my_modal_3').showModal()">Forgot Password?</a>
                                <dialog id="my_modal_3" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <a class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                                                onclick="document.getElementById('my_modal_3').close()">✕</a>
                                        </form>
                                        <span class="font-bold text-2xl mb-1">Request a Password Reset Email</span>
                                        <form action="{{ route('password.request') }}" method="post"
                                            class="flex flex-col gap-4">
                                            @csrf

                                            {{-- email --}}
                                            <div
                                                class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600">
                                                <label for="email" class="pl-1">Email</label>
                                                <input type="text" placeholder="example@gmail.com"
                                                    class="input input-bordered w-full @error('email') border-2 border-red-400 @enderror"
                                                    name="email" value="{{ old('email') }}">
                                                @error('email')
                                                    <p class="mt-1 text-error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            {{-- button --}}
                                            <button
                                                class="btn mt-1 btn-primary font-bold text-sm sm:text-md md:text-lg">Submit</button>
                                        </form>
                                    </div>
                                </dialog>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="hidden md:hidden relative lg:flex lg:flex-1 items-center justify-start py-20">

            <div>
                <p class="text-7xl font-bold text-info text-center mb-10">Welcome Back!</p>

                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" style="z-index: -1;">
                    <div class="w-80 h-80 bg-blue-400 rounded-full"></div>
                </div>

                <div class="flex items-center justify-center w-full h-full">

                    <img src="{{ asset('images/loginB.svg') }}" alt="" class="w-260">

                </div>
            </div>
            {{-- 
            <p class="text-3xl font-bold text-primary text-center mb-5">Welcome Back</p>

            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" style="z-index: -1;">
                <div class="w-80 h-80 bg-blue-400 rounded-full"></div>
            </div>

            <div class="flex items-center justify-left w-full h-full">

                <img src="{{ asset('images/register.svg') }}" alt="">

            </div> --}}
        </div>
    </div>

</x-layout>
