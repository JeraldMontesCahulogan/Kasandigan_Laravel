<x-layout>

    {{-- javascript --}}
    @vite(['resources/js/signup.js'])

    <div class="flex lg:flex-row h-full md:flex-col">
        <div class="lg:w-2/5 w-full flex items-center justify-center  px-8 py-15">

            <div class="w-full flex flex-col justify-center items-center">
                <p class="text-3xl md:text-4xl font-bold text-primary text-center mb-5">SIGN UP</p>

                <div class="form-control w-full max-w-lg px-6 py-4 border shadow-2xl border-gray-300 rounded-2xl">
                    <form action="{{ route('signup') }}" method="post" class="flex flex-col gap-4">
                        @csrf

                        {{-- name --}}
                        <div class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600">
                            <label for="name" class="pl-1">Name</label>
                            <input type="text" placeholder="Example Name" name="name"
                                class="input input-bordered w-full @error('name') border-2 border-red-400 @enderror"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-error">{{ $message }}</p>
                            @enderror
                        </div>

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

                        {{-- username --}}
                        <div class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600">
                            <label for="username" class="pl-1">Username</label>
                            <input type="text" placeholder="ExampleJC2" name="username"
                                class="input input-bordered w-full @error('username') border-2 border-red-400 @enderror"
                                value="{{ old('username') }}">
                            @error('username')
                                <p class="mt-1 text-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- address --}}
                        {{-- <div class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600">
                            <label for="address" class="pl-1">Address</label>
                            <input type="text" placeholder="Purok 7, Camagong II"
                                class="mt-1 input input-bordered w-full @error('address') border-2 border-red-400 @enderror"
                                name="address" value="{{ old('address') }}">
                            @error('address')
                                <p class="mt-1 text-error">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        {{-- location --}}
                        <div class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600">
                            <label for="address_id" class="pl-1">Address</label>
                            <select name="address_id"
                                class="mt-1 select select-bordered w-full @error('address_id') border-2 border-red-400 @enderror">
                                <option value="" disabled selected>Choose a Location</option>
                                @foreach ($complaintsLocation as $complaintLocation)
                                    <option value="{{ $complaintLocation->id }}"
                                        {{ old('address_id') == $complaintLocation->id ? 'selected' : '' }}>
                                        {{ $complaintLocation->complaintLocation_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('address_id')
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

                        {{-- button --}}
                        <button class="btn btn-primary font-bold text-sm sm:text-md md:text-lg">Sign
                            Up</button>

                        {{-- navigate --}}
                        <div
                            class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600 flex justify-center">
                            <p>Already have an account? <a href="{{ route('login') }}"
                                    class="hover:underline text-primary">Login
                                    here</a></p>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <div class="hidden md:hidden relative lg:flex lg:flex-1 items-center justify-start py-20">

            <div>
                <p class="text-7xl font-bold text-info text-center mb-10">Be One Of Us!</p>

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
