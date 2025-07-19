<x-layout>

    <div class="flex lg:flex-row h-full md:flex-col">

        <div class="lg:w-2/5 w-full flex items-center justify-center h-screen px-8">

            <div class="w-full flex flex-col items-center justify-center">

                <p class="text-3xl font-bold text-primary mb-5">Reset Your Password</p>

                <div
                    class="form-control w-full max-w-md px-6 py-4 border shadow-2xl border-gray-300 rounded-2xl bg-neutral-50">

                    {{-- <p class="text-3xl font-bold text-neutral-700 text-center">SIGN IN</p> --}}

                    <form action="{{ route('password.update') }}" method="post" class="flex flex-col gap-4">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

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

                        {{-- confirm password --}}
                        <div class="relative grow font-medium text-sm sm:text-md md:text-lg text-neutral-600">
                            <label for="password_confirmation" class="pl-1">Confirm Password</label>
                            <div class="relative">
                                <input id="password_confirmation" type="password" placeholder="•••••••"
                                    class="mt-1 input input-bordered w-full pr-10 @error('password') border-2 border-red-400 @enderror"
                                    name="password_confirmation">
                                <span id="toggleConfirmPassword" class="absolute right-5 top-2.5 cursor-pointer">
                                    <i class="fa fa-eye text-gray-400 hover:text-gray-500"></i>
                                </span>
                            </div>
                            @error('password')
                                <p class="mt-1 text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <a href="{{ route('login') }}"><i
                                class="fa-solid fa-circle-arrow-left text-primary text-3xl absolute top-4 left-4"></i></a>

                        {{-- button --}}
                        <button class="btn btn-primary font-bold text-sm sm:text-md md:text-lg">Reset Password</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="hidden md:hidden relative lg:flex lg:flex-1 items-center justify-start py-20">

            <div>
                <p class="text-6xl font-bold text-info text-center mb-10">Keep Your Account Safe!</p>

                <div class="flex items-center justify-center w-full h-full">

                    <img src="{{ asset('images/reset1.png') }}" alt="" class="w-240">

                </div>
            </div>
        </div>
    </div>
</x-layout>
