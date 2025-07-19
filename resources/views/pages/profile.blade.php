<x-layout>

    <div class="py-4 px-4 md:py-8 md:px-8">
        <p
            class="text-4xl font-bold text-center lg:text-left bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 bg-clip-text text-transparent">
            User Profile</p>

        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8 mt-4 md:mt-8">
            <div class="h-full rounded-xl shadow-2xl w-80 sm:w-90 md:w-100 pb-8">

                <div
                    class="bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 h-33 md:h-37 lg:h-40 relative rounded-t-xl">
                    <div
                        class="avatar absolute -bottom-12 md:-bottom-14 lg:-bottom-16 left-1/2 transform -translate-x-1/2">
                        <div
                            class="ring-white ring-offset-base-100 w-24 md:w-28 lg:w-33 rounded-full ring-2 ring-offset-2">
                            <a href="{{ asset('storage/' . $user->profilePic) }}" target="_blank">
                                <img
                                    src="{{ $user->profilePic ? asset('storage/' . $user->profilePic) : asset('images/user-placeholder.jpg') }}" />
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-15 md:mt-17 lg:mt-20 flex flex-col mb-6">
                    <span class=" text-2xl font-semibold text-neutral-700 tracking-wide">{{ $user->name }}</span>
                    @if (auth()->user()->role == 'official')
                        <span class="text-md text-neutral-600 font-semibold uppercase">Admin</span>
                    @endif
                    <span class="text-md text-neutral-600">{{ $user->username }}</span>
                </div>

                <div class="mb-8 px-4 flex justify-center flex-col items-center">
                    <p class="text-center text-lg font-semibold text-neutral-600 mb-1">Complaints</p>

                    <div class="grid grid-cols-2 gap-x-6 gap-y-2">
                        <div class="grid grid-cols-[auto_1fr_auto] items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-alert text-yellow-500">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" x2="12" y1="8" y2="12" />
                                <line x1="12" x2="12.01" y1="16" y2="16" />
                            </svg>
                            <p>Pending:</p>
                            <p class="font-semibold">{{ $pending }}</p>
                        </div>

                        <div class="grid grid-cols-[auto_1fr_auto] items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clock text-info">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            <p>Processing:</p>
                            <p class="font-semibold">{{ $processing }}</p>
                        </div>

                        <div class="grid grid-cols-[auto_1fr_auto] items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-check text-success">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m9 12 2 2 4-4" />
                            </svg>
                            <p>Solved:</p>
                            <p class="font-semibold">{{ $solved }}</p>
                        </div>

                        <div class="grid grid-cols-[auto_1fr_auto] items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-x text-neutral-600">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m15 9-6 6" />
                                <path d="m9 9 6 6" />
                            </svg>
                            <p>Closed:</p>
                            <p class="font-semibold">{{ $closed }}</p>
                        </div>
                    </div>


                </div>

                <div class="px-4 flex flex-col gap-4">
                    <div class="flex gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-mail w-6 h-6 text-info">
                            <rect width="20" height="16" x="2" y="4" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                        <span>{{ $user->email }}</span>
                    </div>

                    <div class="flex gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-map-pin w-6 h-6 text-info">
                            <path
                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <span>{{ $user->location->complaintLocation_name }}</span>
                    </div>

                    @if ($user->contact_number)
                        <div class="flex gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-phone w-6 h-6 text-info">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            <span>{{ $user->contact_number }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="shadow-2xl border border-neutral-300 rounded-2xl lg:flex-1 p-6">
                <div>
                    <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-pencil-line">
                            <path d="M12 20h9" />
                            <path
                                d="M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z" />
                            <path d="m15 5 3 3" />
                        </svg>
                        <span class="text-xl">Edit Profile</span>
                    </div>
                </div>
                <div>
                    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data"
                        class="flex flex-col gap-5 mt-5">
                        @csrf
                        @method('PUT')

                        <div class="flex sm:flex-row flex-col gap-4">
                            {{-- Name --}}
                            <div
                                class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600 sm:w-1/2 w-full">
                                <label for="name" class="pl-1">Name</label>
                                <input type="text" placeholder="{{ $user->name }}" name="name"
                                    class="input input-bordered w-full @error('name') border-2 border-red-400 @enderror"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <p class="mt-1 text-error">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Username --}}
                            <div
                                class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600 sm:w-1/2 w-full">
                                <label for="username" class="pl-1">Username</label>
                                <input type="text" placeholder="{{ $user->username }}" name="username"
                                    class="input input-bordered w-full @error('username') border-2 border-red-400 @enderror"
                                    value="{{ old('username', $user->username) }}">
                                @error('username')
                                    <p class="mt-1 text-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex sm:flex-row flex-col gap-4">
                            {{-- Email --}}
                            <div
                                class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600 sm:w-1/2 w-full">
                                <label for="email" class="pl-1">Email</label>
                                <input type="email" placeholder="{{ $user->email }}"
                                    class="input input-bordered w-full @error('email') border-2 border-red-400 @enderror"
                                    name="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <p class="mt-1 text-error">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div
                                class="grow font-medium text-sm sm:text-md md:text-lg text-neutral-600 sm:w-1/2 w-full">
                                <label for="contact_number" class="pl-1">Phone</label>
                                <input type="text" placeholder="{{ $user->contact_number ?? '09123456789' }}"
                                    class="input input-bordered w-full @error('contact_number') border-2 border-red-400 @enderror"
                                    name="contact_number" value="{{ old('contact_number', $user->contact_number) }}">
                                @error('contact_number')
                                    <p class="mt-1 text-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <label class="label" for="location">
                                <span class="label-text md:text-lg">Location</span>
                            </label>
                            <select name="address_id" class="select select-bordered text-neutral-800 w-full" required>
                                <option value="" {{ old('address_id') == $user->address_id ? '' : 'selected' }}
                                    disabled>
                                    Choose a Location</option>
                                @foreach ($complaintsLocation as $complaintLocation)
                                    <option value="{{ $complaintLocation->id }}"
                                        {{ old('address_id') == $complaintLocation->id ? 'selected' : '' }}>
                                        {{ $complaintLocation->complaintLocation_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Profile Picture --}}
                        <div class="mb-3">
                            <label class="label" for="profilePic">
                                <span class="label-text text-lg text-neutral-600 mb-1">Profile Picture</span>
                            </label>
                            <input type="file" class="file-input file-input-bordered w-full" name="profilePic" />
                            <div class="flex justify-start items-center gap-2 mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-info-circle text-orange-400">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg>
                                <p class="text-sm tracking-wide italic text-neutral-600">
                                    Leave empty if you don't want to change your profile picture.
                                </p>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <button class="btn btn-info font-semibold text-sm sm:text-md md:text-lg w-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-save w-5 h-5">
                                <path
                                    d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                                <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                                <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                            </svg>
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Your Pending Complaints --}}
        <div class="border border-gray-300 p-8 rounded-2xl mt-15">
            <h1
                class="text-4xl font-bold mb-5 md:mb-0 bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 bg-clip-text text-transparent">
                List Of Your Pending Complaints
            </h1>

            <div class="overflow-x-auto  mt-10">
                <table class="table table-auto md:table-md lg:table-lg">
                    <!-- head -->
                    <thead class="bg-neutral-200">
                        <tr class="text-lg text-neutral-700">

                            <th class="text-center">ID</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Time</th>
                            <th>Category</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($complaints as $key => $complaint)
                            <tr class="hover:bg-base-200">

                                <td class="text-center">{{ $complaint->id }}</td>
                                <td class="text-center">{{ $complaint->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">{{ $complaint->created_at->format('h:i A') }}</td>
                                <td>{{ $complaint->category->complaintCategory_name }}</td>
                                <td class="text-center">
                                    <div
                                        class="badge {{ $complaint->status == 'processing'
                                            ? 'badge-info'
                                            : ($complaint->status == 'closed'
                                                ? 'bg-neutral-700 text-neutral-200'
                                                : ($complaint->status == 'solved'
                                                    ? 'badge-success'
                                                    : 'badge-warning')) }} mt-2 py-3 px-2 font-medium">
                                        {{ $complaint->status }}</div>
                                </td>

                                {{-- MODALS --}}
                                <td class="flex flex-row justify-center md:gap-3 gap-1.5">

                                    {{-- VIEW BUTTON --}}
                                    <button
                                        class="p-1 sm:p-2 rounded-lg border border-neutral-400 hover:bg-neutral-300 hover:text-neutral-800 btn text-xs sm:text-base"
                                        onclick="document.getElementById('view_modal_1{{ $complaint->id }}').showModal()">
                                        Details
                                    </button>
                                    <dialog id="view_modal_1{{ $complaint->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog" class="mb-6">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>

                                            {{-- COMPLAINT CARD --}}
                                            <div class="card bg-base-100 w-full shadow-xl">
                                                <figure>
                                                    <a href="{{ asset('storage/' . $complaint->attachment) }}"
                                                        target="_blank" class="max-h-[350px] w-full object-cover">
                                                        <img src="{{ $complaint->attachment ? asset('storage/' . $complaint->attachment) : asset('images/placeholder-image.jpg') }}"
                                                            alt="Attachment">
                                                    </a>
                                                </figure>

                                                <div class="card-body space-y-2">

                                                    <div
                                                        class="flex flex-col gap-2.5 md:gap-0 md:flex-row align-center mt-1">
                                                        <div class="grow text-lg flex gap-2">
                                                            <span class="font-bold">Status:</span>
                                                            <div
                                                                class="badge {{ $complaint->status == 'processing'
                                                                    ? 'badge-info'
                                                                    : ($complaint->status == 'closed'
                                                                        ? 'badge-neutral'
                                                                        : ($complaint->status == 'solved'
                                                                            ? 'badge-success'
                                                                            : 'badge-warning')) }} py-3 px-2 font-bold">
                                                                {{ $complaint->status }}</div>
                                                        </div>
                                                        <div class="text-lg"><span class="font-bold">Filed
                                                                Date:</span>
                                                            {{ $complaint->created_at->diffForHumans() }}</div>
                                                    </div>

                                                    <div class="text-lg"><span class="font-bold">Category:</span>
                                                        {{ $complaint->category->complaintCategory_name }}</div>

                                                    <div class="text-lg"><span class="font-bold">Location:</span>
                                                        {{ $complaint->location->complaintLocation_name }}</div>

                                                    <div class="text-lg flex gap-2 w-full"><span
                                                            class="font-bold">Complainant:</span>
                                                        <div class="relative w-full">
                                                            <input id="complainant1{{ $complaint->id }}"
                                                                type="password" value="{{ $complaint->user->name }}"
                                                                disabled>
                                                            <span id="toggleComplainant1{{ $complaint->id }}"
                                                                class="absolute top-0.5 right-1 cursor-pointer">
                                                                <i
                                                                    class="fa fa-eye text-gray-400 hover:text-gray-500 w-full"></i>
                                                            </span>
                                                        </div>

                                                        <script>
                                                            function toggleVisibility(inputId, iconId) {
                                                                const input = document.getElementById(inputId);
                                                                const icon = document.getElementById(iconId).querySelector("i");

                                                                if (input.type === "password") {
                                                                    input.type = "text";
                                                                    icon.classList.replace("fa-eye", "fa-eye-slash"); // Change to eye-slash
                                                                } else {
                                                                    input.type = "password";
                                                                    icon.classList.replace("fa-eye-slash", "fa-eye"); // Change to eye
                                                                }
                                                            }
                                                            document.getElementById("toggleComplainant1{{ $complaint->id }}").addEventListener("click", () => toggleVisibility(
                                                                "complainant1{{ $complaint->id }}",
                                                                "toggleComplainant1{{ $complaint->id }}"));
                                                        </script>
                                                    </div>

                                                    <div class="text-lg"><span class="font-bold">Description:</span>
                                                        {{ $complaint->description }}</div>

                                                </div>
                                            </div>

                                        </div>
                                    </dialog>

                                    {{-- UPDATE BUTTON --}}


                                    <button class="p-2 rounded-lg hover:bg-orange-200 hover:text-orange-500 btn"
                                        onclick="document.getElementById('update_modal_{{ $complaint->id }}').showModal()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="lucide lucide-pencil-line w-4 h-4 md:w-6 md:h-6">
                                            <path d="M12 20h9" />
                                            <path
                                                d="M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z" />
                                            <path d="m15 5 3 3" />
                                        </svg>
                                    </button>
                                    <dialog id="update_modal_{{ $complaint->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h3 class="text-3xl font-bold mb-5">Update Complaint</h3>

                                            {{-- Modal Content --}}
                                            <div class="space-y-3">

                                                <form method="post"
                                                    action="{{ route('allComplaints.update', $complaint->id) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    {{-- category --}}
                                                    <div class="flex flex-col w-full mt-4">
                                                        <label class="label" for="complaintCategory_id">
                                                            <span class="label-text md:text-lg">Category</span>
                                                        </label>
                                                        <select name="complaintCategory_id"
                                                            class="select validator select-bordered text-neutral-800 w-full"
                                                            required>
                                                            <option value=""
                                                                {{ old('complaintCategory_id', $complaint->category->id) == '' ? 'selected' : '' }}
                                                                disabled>
                                                                Choose a Category</option>
                                                            @foreach ($complaintsCategory as $complaintCategory)
                                                                <option value="{{ $complaintCategory->id }}"
                                                                    {{ old('complaintCategory_id', $complaint->category->id) == $complaintCategory->id ? 'selected' : '' }}>
                                                                    {{ $complaintCategory->complaintCategory_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="validator-hint text-[17px]">This field is
                                                            required
                                                        </div>
                                                    </div>

                                                    {{-- description --}}
                                                    <div class="flex flex-col">
                                                        <label class="label" for="description">
                                                            <span class="label-text md:text-lg">Description</span>
                                                        </label>
                                                        <textarea class="textarea validator w-full" type="text" name="description" required
                                                            placeholder="Enter description">{{ old('description', $complaint->description) }}</textarea>
                                                        <div class="validator-hint text-[17px]">This field is
                                                            required
                                                        </div>
                                                    </div>

                                                    {{-- location --}}
                                                    <div class="flex flex-col w-full">
                                                        <label class="label" for="complaintLocation_id">
                                                            <span class="label-text md:text-lg">Location</span>
                                                        </label>
                                                        <select name="complaintLocation_id"
                                                            class="select validator select-bordered text-neutral-800 w-full"
                                                            required>
                                                            <option value=""
                                                                {{ old('complaintLocation_id', $complaint->location->id) == '' ? 'selected' : '' }}
                                                                disabled>
                                                                Choose a Location</option>
                                                            @foreach ($complaintsLocation as $complaintLocation)
                                                                <option value="{{ $complaintLocation->id }}"
                                                                    {{ old('complaintLocation_id', $complaint->location->id) == $complaintLocation->id ? 'selected' : '' }}>
                                                                    {{ $complaintLocation->complaintLocation_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="validator-hint text-[17px]">This field is
                                                            required
                                                        </div>
                                                    </div>

                                                    {{-- status --}}
                                                    @if (Auth::user()->role === 'official' || Auth::user()->role === 'admin')
                                                        <div class="flex flex-col">
                                                            <label class="label" for="status">
                                                                <span class="label-text md:text-lg">Status</span>
                                                            </label>
                                                            <select name="status"
                                                                class="select validator select-bordered text-neutral-800 w-full"
                                                                required>
                                                                <option value="" disabled>Choose a Status
                                                                </option>
                                                                <option value="pending"
                                                                    {{ old('status', $complaint->status) == 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option value="processing"
                                                                    {{ old('status', $complaint->status) == 'processing' ? 'selected' : '' }}>
                                                                    Processing</option>
                                                                <option value="solved"
                                                                    {{ old('status', $complaint->status) == 'solved' ? 'selected' : '' }}>
                                                                    Solved</option>
                                                                <option value="closed"
                                                                    {{ old('status', $complaint->status) == 'closed' ? 'selected' : '' }}>
                                                                    Closed</option>
                                                            </select>
                                                            <div class="validator-hint text-[17px]">This field is
                                                                required
                                                            </div>
                                                        </div>
                                                    @endif

                                                    {{-- Attachment --}}
                                                    <div class="mb-3">
                                                        <label class="label" for="attachment">
                                                            <span class="label-text text-lg mb-1">Attachment</span>
                                                        </label>

                                                        {{-- Show existing attachment if available --}}
                                                        @if ($complaint->attachment)
                                                            <div class="mb-2">
                                                                <span class="text-sm text-gray-500">Current
                                                                    Attachment:</span>
                                                                <br />
                                                                <a href="{{ asset('storage/' . $complaint->attachment) }}"
                                                                    target="_blank"
                                                                    class="text-blue-500 hover:underline">
                                                                    View Current Attachment
                                                                </a>
                                                            </div>
                                                        @endif

                                                        {{-- Attachment --}}
                                                        <div class="mb-3">
                                                            <div class="flex gap-3">

                                                                <!-- Camera Capture -->
                                                                <div class="flex items-center gap-2">
                                                                    <button type="button" id="openCamera1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="lucide lucide-camera-icon lucide-camera w-8 h-8 text-neutral-500 cursor-pointer">
                                                                            <path
                                                                                d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                                                            <circle cx="12" cy="13"
                                                                                r="3" />
                                                                        </svg>
                                                                    </button>
                                                                </div>

                                                                <!-- File Input -->
                                                                <div class="flex items-center gap-2 flex-1">
                                                                    <input type="file" id="attachment1"
                                                                        name="attachment"
                                                                        class="file-input file-input-bordered w-full" />
                                                                </div>

                                                            </div>

                                                            <!-- Video Stream (Hidden by Default) -->
                                                            <video id="video1"
                                                                class="hidden w-64 h-48 rounded-lg mt-3 mx-auto"></video>

                                                            <!-- Canvas for Captured Image (Hidden) -->
                                                            <canvas id="canvas1" class="hidden"></canvas>

                                                            <!-- Capture & Close Buttons -->
                                                            <div id="captureControls1" class="hidden mt-2">
                                                                <div class="flex justify-center gap-2">
                                                                    <button type="button" id="switchCamera1"
                                                                        class="bg-yellow-500 text-white px-4 py-2 rounded flex gap-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="lucide lucide-refresh-cw-icon lucide-refresh-cw h-5 w-5">
                                                                            <path
                                                                                d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8" />
                                                                            <path d="M21 3v5h-5" />
                                                                            <path
                                                                                d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16" />
                                                                            <path d="M8 16H3v5" />
                                                                        </svg>
                                                                        <span class="hidden xs:block sm:inline">Switch
                                                                            Camera</span>
                                                                    </button>
                                                                    <button type="button" id="captureImage1"
                                                                        class="bg-green-500 text-white px-4 py-2 rounded flex gap-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="lucide lucide-camera-icon lucide-camera h-5 w-5">
                                                                            <path
                                                                                d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                                                            <circle cx="12" cy="13"
                                                                                r="3" />
                                                                        </svg>
                                                                        <span
                                                                            class="hidden xs:block sm:inline">Capture</span>
                                                                    </button>
                                                                    <button type="button" id="closeCamera1"
                                                                        class="bg-red-500 text-white px-4 py-2 rounded flex gap-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="lucide lucide-circle-x-icon lucide-circle-x h-5 w-5">
                                                                            <circle cx="12" cy="12"
                                                                                r="10" />
                                                                            <path d="m15 9-6 6" />
                                                                            <path d="m9 9 6 6" />
                                                                        </svg>
                                                                        <span
                                                                            class="hidden xs:block sm:inline">Close</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Script for Camera Control -->
                                                        <script>
                                                            document.addEventListener("DOMContentLoaded", () => {
                                                                const openCameraBtn = document.getElementById("openCamera1");
                                                                const switchCameraBtn = document.getElementById("switchCamera1");
                                                                const captureImageBtn = document.getElementById("captureImage1");
                                                                const closeCameraBtn = document.getElementById("closeCamera1");

                                                                const video = document.getElementById("video1");
                                                                const canvas = document.getElementById("canvas1");
                                                                const attachmentInput = document.getElementById("attachment1");
                                                                const captureControls = document.getElementById("captureControls1");

                                                                let stream;
                                                                let useFrontCamera = true;

                                                                // Function to Start Camera
                                                                async function startCamera() {
                                                                    if (stream) {
                                                                        stream.getTracks().forEach(track => track.stop());
                                                                    }

                                                                    try {
                                                                        stream = await navigator.mediaDevices.getUserMedia({
                                                                            video: {
                                                                                facingMode: useFrontCamera ? "user" : "environment"
                                                                            }
                                                                        });

                                                                        video.srcObject = stream;
                                                                        video.play();

                                                                        // Show video and controls
                                                                        video.classList.remove("hidden");
                                                                        captureControls.classList.remove("hidden");
                                                                    } catch (error) {
                                                                        console.error("Error accessing camera:", error);
                                                                        alert("Failed to access camera. Please allow camera permissions.");
                                                                    }
                                                                }

                                                                // Open Camera
                                                                openCameraBtn.addEventListener("click", startCamera);

                                                                // Switch Camera
                                                                switchCameraBtn.addEventListener("click", () => {
                                                                    useFrontCamera = !useFrontCamera;
                                                                    startCamera();
                                                                });

                                                                // Capture Image
                                                                captureImageBtn.addEventListener("click", () => {
                                                                    const context = canvas.getContext("2d");
                                                                    canvas.width = video.videoWidth;
                                                                    canvas.height = video.videoHeight;
                                                                    context.drawImage(video, 0, 0, canvas.width, canvas.height);

                                                                    // Convert image to data URL
                                                                    canvas.toBlob(blob => {
                                                                        const file = new File([blob], "captured_image.png", {
                                                                            type: "image/png"
                                                                        });

                                                                        // Assign to input field
                                                                        const dataTransfer = new DataTransfer();
                                                                        dataTransfer.items.add(file);
                                                                        attachmentInput.files = dataTransfer.files;

                                                                        // Hide camera after capturing
                                                                        stopCamera();
                                                                    }, "image/png");
                                                                });

                                                                // Close Camera
                                                                closeCameraBtn.addEventListener("click", stopCamera);

                                                                function stopCamera() {
                                                                    if (stream) {
                                                                        stream.getTracks().forEach(track => track.stop());
                                                                    }
                                                                    video.classList.add("hidden");
                                                                    captureControls.classList.add("hidden");
                                                                }
                                                            });
                                                        </script>

                                                        <div class="flex justify-start items-center gap-2 mt-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-info-circle text-orange-400">
                                                                <circle cx="12" cy="12" r="10" />
                                                                <line x1="12" y1="8" x2="12"
                                                                    y2="12" />
                                                                <line x1="12" y1="16" x2="12.01"
                                                                    y2="16" />
                                                            </svg>
                                                            <p class="text-sm tracking-wide italic text-neutral-600">
                                                                Leave empty if you don't want to
                                                                change the attachment.</p>
                                                        </div>
                                                    </div>

                                                    <button
                                                        class="btn btn-info mt-2 w-full font-bold text-lg">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </dialog>

                                    {{-- DELETE BUTTON --}}
                                    <form action="{{ route('allComplaints.destroy', $complaint->id) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-2 rounded-lg hover:bg-red-200 hover:text-red-500 btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-trash w-4 h-4 md:w-6 md:h-6">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            </svg>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                        @if ($complaints->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-4">No complaints found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>


    </div>

</x-layout>
