<x-layout>

    {{-- @if (session('success'))
        <script>
            setTimeout(function() {
                const successMessage = document.createElement('div');
                successMessage.role = 'alert';
                successMessage.className =
                    'fixed rounded-lg top-5 right-1/2 transform -translate-x-1/2 -translate-y-1/2 p-4 mt-8 mr-4 bg-secondary border border-none text-lg text-neutral-800 font-semibold rounded transition-opacity duration-1000 alert alert-success';
                successMessage.id = 'success-message';
                successMessage.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('success') }}</span>
                            `;
                document.body.appendChild(successMessage);

                setTimeout(function() {
                    successMessage.style.opacity = 1;
                }, 200);

                setTimeout(function() {
                    successMessage.style.opacity = 0;
                }, 3500);

                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 4000);
            }, 500);
        </script>
    @endif --}}

    {{-- @if (session('error'))
        <script>
            setTimeout(function() {
                const errorMessage = document.createElement('div');
                errorMessage.role = 'alert';
                errorMessage.className =
                    'fixed rounded-lg top-5 right-70 transform -translate-x-1/2 -translate-y-1/2 p-4 mt-8 mr-4 bg-red-600 border border-none text-lg text-white font-semibold rounded transition-opacity duration-1000 alert alert-danger';
                errorMessage.id = 'error-message';
                errorMessage.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M12 3a9 9 0 110 18 9 9 0 010-18z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                `;
                document.body.appendChild(errorMessage);

                setTimeout(function() {
                    errorMessage.style.opacity = 1;
                }, 200);

                setTimeout(function() {
                    errorMessage.style.opacity = 0;
                }, 3500);

                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 4000);
            }, 500);
        </script>
    @endif --}}

    <div class="py-4 px-4 md:py-8 md:px-8 gap-5">

        <p
            class="lg:text-5xl text-4xl font-bold text-center lg:text-left bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 bg-clip-text text-transparent mb-2">
            Barangay Data
        </p>
        <p class="mb-10 lg:text-2xl md:text-xl text-lg text-center lg:text-left">
            Manage Barangay ID, Complaint Categories and Locations
        </p>

        <div class="border border-neutral-300 rounded-2xl p-3 w-fit mb-5">
            <span class="md:text-2xl text-xl font-semibold">Barangay ID</span>

            <ul class="list-disc pt-2.5">
                @foreach ($barangayID as $barangay)
                    <li class="flex items-center lg:gap-10 md:gap-8 gap-5 mb-2">
                        <span class="lg:text-2xl md:text-xl text-lg">{{ $barangay->barangay_id }}</span>
                        <button class="btn btn-primary md:text-lg text-md"
                            onclick="document.getElementById('updateBarangayID_{{ $barangay->id }}').showModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-refresh-cw-icon lucide-refresh-cw mr-1 md:h-5 md:w-5 h-4 w-4">
                                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8" />
                                <path d="M21 3v5h-5" />
                                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16" />
                                <path d="M8 16H3v5" />
                            </svg>
                            Update
                        </button>

                        <!-- Unique Modal for Each Barangay ID -->
                        <dialog id="updateBarangayID_{{ $barangay->id }}" class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="lg:text-2xl md:text-xl text-lg font-semibold lg:mb-6 md:mb-4 mb-2">Update
                                    Barangay ID</h3>

                                <form action="{{ route('barangayData.updateBarangayID', $barangay->id) }}"
                                    method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="w-full">
                                        <label for="barangay_id" class="md:text-xl text-lg">Barangay ID</label>
                                        <input type="text" name="barangay_id" id="barangay_id"
                                            value="{{ $barangay->barangay_id }}"
                                            class="input input-bordered w-full lg:text-2xl md:text-xl text-lg md:mt-1 mt-0.5" />

                                        <button type="submit"
                                            class="btn btn-primary md:text-lg text-md mt-4">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </dialog>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex gap-6 lg:flex-row flex-col">
            <div class="border border-neutral-300 p-3 flex-1 rounded-2xl">
                <span class="md:text-2xl text-xl font-semibold">Complaint's Category</span>

                @if ($complaintsCategory->count() == 0)
                    <p class="mt-5 text-red-500 text-center md:text-xl text:lg">No Complaint's Category</p>
                @endif

                <ul class="list-disc pt-4 mb-4">
                    @foreach ($complaintsCategory as $complaintCategory)
                        <li class="flex items-center gap-4 mb-2 bg-stone-100 px-2 py-1 rounded-xl">
                            <div class="flex justify-between items-center w-full">
                                <span class="lg:text-xl text-lg">{{ $complaintCategory->complaintCategory_name }}</span>
                                <div class="flex gap-3">
                                    <form method="post"
                                        action="{{ route('barangayData.destroy', $complaintCategory->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn md:text-lg text-md  btn-error" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="lucide lucide-trash-icon lucide-trash mr-0 md:mr-1 md:h-5 md:w-5 h-4 w-4">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            </svg>
                                            <span class="hidden md:block">Delete</span>
                                        </button>
                                    </form>

                                    <button class="btn btn-primary md:text-lg text-md"
                                        onclick="my_modal_update{{ $complaintCategory->id }}.showModal()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="lucide lucide-refresh-cw-icon lucide-refresh-cw mr-0 md:mr-1 md:h-5 md:w-5 h-4 w-4">
                                            <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8" />
                                            <path d="M21 3v5h-5" />
                                            <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16" />
                                            <path d="M8 16H3v5" />
                                        </svg>
                                        <span class="hidden md:block">Update</span>
                                    </button>
                                    <dialog id="my_modal_update{{ $complaintCategory->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h3
                                                class="lg:text-2xl md:text-xl text-lg font-semibold lg:mb-6 md:mb-4 mb-2">
                                                Update
                                                Complaint Category</h3>
                                            <form action="{{ route('barangayData.update', $complaintCategory->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="w-full">
                                                    <label for="complaintCategory_name"
                                                        class="md:text-xl text-lg">Complaint Category Name</label>
                                                    <input type="text" name="complaintCategory_name"
                                                        id="complaintCategory_name"
                                                        value="{{ $complaintCategory->complaintCategory_name }}"
                                                        class="input input-bordered w-full lg:text-2xl md:text-xl text-lg md:mt-1 mt-0.5" />

                                                    <button type="submit"
                                                        class="btn btn-primary md:text-lg text-md mt-4">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </dialog>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <form action="{{ url('/barangayData/createCategory') }}" method="post">
                    @csrf
                    <div class="w-full flex justify-between items-center gap-2">
                        <input type="text" name="complaintCategory_name" id="complaintCategory_name"
                            class="input input-bordered w-full validator" placeholder="New Category Name" required />
                        <button type="submit" class="btn btn-primary md:text-lg text-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-plus-icon lucide-plus mr-1 md:h-5 md:w-5 h-4 w-4">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            Add Category
                        </button>
                    </div>
                </form>
            </div>

            <div class="border border-neutral-300 p-3 flex-1 rounded-2xl">
                <p class="md:text-2xl text-xl font-semibold">Location</p>

                <ul class="list-disc pt-4 mb-4">
                    @foreach ($complaintsLocation as $complaintLocation)
                        <li class="flex items-center gap-4 mb-2 bg-stone-100 px-2 py-1 rounded-xl">
                            <div class="flex justify-between items-center w-full">
                                <span
                                    class="lg:text-xl text-lg">{{ $complaintLocation->complaintLocation_name }}</span>
                                <div class="flex gap-3">
                                    <form method="post"
                                        action="{{ route('barangayData.destroyLocation', $complaintLocation->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn md:text-lg text-md  btn-error" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-trash-icon lucide-trash mr-0 md:mr-1 md:h-5 md:w-5 h-4 w-4">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            </svg>
                                            <span class="hidden md:block">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <button class="btn btn-primary md:text-lg text-md"
                                onclick="my_modal_updateLocation{{ $complaintLocation->id }}.showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-refresh-cw-icon lucide-refresh-cw mr-0 md:mr-1 md:h-5 md:w-5 h-4 w-4">
                                    <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8" />
                                    <path d="M21 3v5h-5" />
                                    <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16" />
                                    <path d="M8 16H3v5" />
                                </svg>
                                <span class="hidden md:block">Update</span>
                            </button>
                            <dialog id="my_modal_updateLocation{{ $complaintLocation->id }}" class="modal">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button
                                            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="lg:text-2xl md:text-xl text-lg font-semibold lg:mb-6 md:mb-4 mb-2">
                                        Update Location</h3>
                                    <form action="{{ route('barangayData.updateLocation', $complaintLocation->id) }}"
                                        method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="w-full">
                                            <label for="complaintLocation_name" class="md:text-xl text-lg">Complaint
                                                Location Name</label>
                                            <input type="text" name="complaintLocation_name"
                                                id="complaintLocation_name"
                                                value="{{ $complaintLocation->complaintLocation_name }}"
                                                class="input input-bordered w-full lg:text-2xl md:text-xl text-lg md:mt-1 mt-0.5" />

                                            <button type="submit"
                                                class="btn btn-primary md:text-lg text-md mt-4">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </dialog>
                        </li>
                    @endforeach
                </ul>

                <form action="{{ url('/barangayData/createLocation') }}" method="post">
                    @csrf
                    <div class="w-full">
                        <div class="w-full flex justify-between items-center gap-2">
                            <input type="text" name="complaintLocation_name" id="complaintLocation_name"
                                class="input input-bordered w-full validator" placeholder="New Location Name"
                                required />

                            <button type="submit" class="btn btn-primary md:text-lg text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-plus-icon lucide-plus mr-1 md:h-5 md:w-5 h-4 w-4">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                                Add Location
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>



    </div>
</x-layout>
