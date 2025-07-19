<x-layout>
    <div class="pb-4 px-4 md:pb-8 md:px-8">

        <div class="mt-5 flex justify-between items-center" {{ auth()->user()->email_verified_at ? 'hidden' : '' }}>
            <div role="alert" class="alert alert-warning w-fit">
                <span class="font-semibold text-xl uppercase">Ask your barangay captain to verify your account so you can
                    add a complaint.</span>
            </div>

            <form action="{{ route('verification.resend') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-info text-lg py-6">Resend Email Verification</button>
            </form>
        </div>

        {{-- Header and Submit New Complaint --}}
        <div class="mt-8 flex flex-col md:flex-row justify-between">
            {{-- <h1 class="text-4xl font-bold mb-5 md:mb-0">Complaint Dashboard</h1> --}}
            <h1
                class="text-4xl font-bold mb-5 md:mb-0 bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 bg-clip-text text-transparent">
                Complaints for the Month of {{ date('F Y') }}
            </h1>

            <button class="btn btn-info shadow-lg tracking-wider" onclick="my_modal_5.showModal()"
                {{ auth()->user()->email_verified_at ? '' : 'disabled' }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                Submit New Complaint
            </button>

            {{-- Add New Complaint Modal --}}
            <dialog id="my_modal_5" class="modal max-w-2xl mx-auto">
                <div class="modal-box p-5 md:p-10">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>

                    {{-- Modal Content --}}
                    <div class="space-y-3">

                        <div class="flex items-center justify-center mb-5">
                            <h1 class="text-xl md:text-4xl font-bold">Submit New Complaint</h1>
                        </div>

                        <form method="post" action="{{ url('/dashboard/create') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- category --}}
                            <div class="flex flex-col w-full">
                                <label class="label" for="category">
                                    <span class="label-text md:text-lg">Category</span>
                                </label>
                                <select name="category" class="select validator select-bordered text-neutral-800 w-full"
                                    required>
                                    <option value="" {{ old('category') == '' ? 'selected' : '' }} disabled>
                                        Choose a Category</option>
                                    @foreach ($complaintsCategory as $complaintCategory)
                                        <option value="{{ $complaintCategory->id }}"
                                            {{ old('category') == $complaintCategory->id ? 'selected' : '' }}>
                                            {{ $complaintCategory->complaintCategory_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="validator-hint text-[17px]">This field is required</div>
                            </div>

                            {{-- description --}}
                            <div class="flex flex-col">
                                <label class="label" for="description">
                                    <span class="label-text md:text-lg">Description</span>
                                </label>
                                <textarea class="textarea validator w-full" type="text" name="description" value="{{ old('description') }}" required
                                    placeholder="Naglisod ug tulog kay banha ang videoke"></textarea>
                                <div class="validator-hint text-[17px]">This field is required</div>
                            </div>

                            {{-- location --}}
                            <div class="flex flex-col w-full">
                                <label class="label" for="location">
                                    <span class="label-text md:text-lg">Location</span>
                                </label>
                                <select name="location" class="select validator select-bordered text-neutral-800 w-full"
                                    required>
                                    <option value="" {{ old('location') == '' ? 'selected' : '' }} disabled>
                                        Choose a Location</option>
                                    @foreach ($complaintsLocation as $complaintLocation)
                                        <option value="{{ $complaintLocation->id }}"
                                            {{ old('location') == $complaintLocation->id ? 'selected' : '' }}>
                                            {{ $complaintLocation->complaintLocation_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="validator-hint text-[17px]">This field is required</div>
                            </div>

                            {{-- Attachment --}}
                            <div class="mb-3">
                                <label class="label" for="attachment">
                                    <span class="label-text text-lg">Attachment</span>
                                </label>

                                <div class="flex gap-3">

                                    <!-- Camera Capture -->
                                    <div class="flex items-center gap-2">
                                        <button type="button" id="openCamera">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="lucide lucide-camera-icon lucide-camera w-8 h-8 text-neutral-500 cursor-pointer">
                                                <path
                                                    d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                                <circle cx="12" cy="13" r="3" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- File Input -->
                                    <div class="flex items-center gap-2 flex-1">
                                        <input type="file" id="attachment" name="attachment"
                                            class="file-input file-input-bordered w-full" />
                                    </div>

                                </div>

                                <!-- Video Stream (Hidden by Default) -->
                                <video id="video" class="hidden w-64 h-48 rounded-lg mt-3 mx-auto"></video>

                                <!-- Canvas for Captured Image (Hidden) -->
                                <canvas id="canvas" class="hidden"></canvas>

                                <!-- Capture & Close Buttons -->
                                <div id="captureControls" class="hidden mt-2">
                                    <div class="flex justify-center gap-2">
                                        <button type="button" id="switchCamera"
                                            class="bg-yellow-500 text-white px-4 py-2 rounded flex gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="lucide lucide-refresh-cw-icon lucide-refresh-cw h-5 w-5">
                                                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8" />
                                                <path d="M21 3v5h-5" />
                                                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16" />
                                                <path d="M8 16H3v5" />
                                            </svg>
                                            <span class="hidden xs:block sm:inline">Switch Camera</span>
                                        </button>
                                        <button type="button" id="captureImage"
                                            class="bg-green-500 text-white px-4 py-2 rounded flex gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-camera-icon lucide-camera h-5 w-5">
                                                <path
                                                    d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                                <circle cx="12" cy="13" r="3" />
                                            </svg>
                                            <span class="hidden xs:block sm:inline">Capture</span>
                                        </button>
                                        <button type="button" id="closeCamera"
                                            class="bg-red-500 text-white px-4 py-2 rounded flex gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-x-icon lucide-circle-x h-5 w-5">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="m15 9-6 6" />
                                                <path d="m9 9 6 6" />
                                            </svg>
                                            <span class="hidden xs:block sm:inline">Close</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Script for Camera Control -->
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    const openCameraBtn = document.getElementById("openCamera");
                                    const switchCameraBtn = document.getElementById("switchCamera");
                                    const captureImageBtn = document.getElementById("captureImage");
                                    const closeCameraBtn = document.getElementById("closeCamera");

                                    const video = document.getElementById("video");
                                    const canvas = document.getElementById("canvas");
                                    const attachmentInput = document.getElementById("attachment");
                                    const captureControls = document.getElementById("captureControls");

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



                            <button class="btn btn-info mt-2 w-full font-bold text-lg">Submit</button>
                        </form>
                    </div>

                </div>
            </dialog>

        </div>


        {{-- Complaints Graph --}}
        <div>
            <!-- Load amCharts Library -->
            <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
            <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
            <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
            <script>
                am4core.ready(function() {
                    am4core.useTheme(am4themes_animated);

                    var chart = am4core.create("pieChart3D", am4charts.PieChart3D);

                    if ({{ count($data) }} < 1) {
                        var noComplaintText = chart.chartContainer.createChild(am4core.Label);
                        noComplaintText.text = "No complaints posted yet";
                        noComplaintText.fill = am4core.color("#6c757d");
                        noComplaintText.fontSize = 20;
                        noComplaintText.align = "center";
                        noComplaintText.valign = "middle";
                    } else {
                        chart.data = [
                            @foreach ($labels as $index => $label)
                                {
                                    category: "{{ $label }}",
                                    value: {{ $data[$index] }}
                                },
                            @endforeach
                        ];

                        var pieSeries = chart.series.push(new am4charts.PieSeries3D());
                        pieSeries.dataFields.value = "value";
                        pieSeries.dataFields.category = "category";

                        // Custom colors based on complaint status
                        var colorMap = {
                            "closed": am4core.color("#808080"),
                            "solved": am4core.color("#4CAF50"),
                            "pending": am4core.color("#FFC300"),
                            "processing": am4core.color("#36A2EB")
                        };

                        // Apply color based on category
                        pieSeries.slices.template.adapter.add("fill", function(fill, target) {
                            return colorMap[target.dataItem.category] || fill;
                        });
                    }
                });
            </script>

            {{-- Charts --}}
            <div class="flex flex-col xl:flex-row xl:gap-7">
                {{-- 3D Pie Chart --}}
                <div class="border border-neutral-300 p-5 rounded-2xl w-full xl:w-1/2 mt-7">
                    <h2 class="text-2xl font-semibold text-neutral-800">Complaint Status</h2>
                    <p class="text-md text-neutral-500">Distribution of all complaints by status</p>
                    <div id="pieChart3D" class="h-[150px] sm:h-[400px] text-[8px] sm:text-[15px]"></div>
                </div>

                {{-- More Details --}}
                <div class="w-full xl:w-1/2 mt-7 flex flex-col gap-5">

                    {{-- total and this week --}}
                    <div class="flex gap-4">

                        <div class="border grow border-neutral-300 p-5 rounded-2xl h-fit">
                            <div class="text-lg text-neutral-600">Total Complaints</div>
                            <div class="flex justify-between">
                                <div class="text-2xl font-semibold  text-neutral-800">
                                    {{-- $complaintsToDisplay --}}
                                    {{ $complaints->count() }}
                                </div>
                                <div class="p-1.75 rounded-full bg-neutral-300 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chart-column">
                                        <path d="M3 3v16a2 2 0 0 0 2 2h16" />
                                        <path d="M18 17V9" />
                                        <path d="M13 17V5" />
                                        <path d="M8 17v-3" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <button class="border grow border-neutral-300 p-5 rounded-2xl h-fit cursor-pointer"
                            onclick="my_modal_3.showModal()">
                            <div class="text-lg text-neutral-600 text-left">New This Week</div>
                            <div class="flex justify-between">
                                <div class="text-2xl font-semibold text-neutral-800">
                                    {{-- $complaintsToDisplay --}}
                                    {{ $complaints->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}
                                </div>
                                <div
                                    class="p-2 rounded-full bg-blue-200 flex items-center justify-center text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-calendar">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                    </svg>
                                </div>
                            </div>
                        </button>

                        {{-- complaint this week modal --}}
                        <dialog id="my_modal_3" class="modal">
                            <div class="modal-box w-11/12 max-w-5xl">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-2xl font-bold">Complaints This Week</h3>
                                <div class="overflow-y-auto max-h-[55vh] mt-3">
                                    <table class="table text-neutral-800 table-auto md:table-md lg:table-lg">
                                        <!-- head -->
                                        <thead class="bg-neutral-200">
                                            <tr class="text-lg text-neutral-700">

                                                <th class="text-center">ID</th>
                                                <th class="text-center">Day</th>
                                                <th class="text-center">Time</th>
                                                <th>Category</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($complaints->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->all() as $complaint)
                                                <tr class="hover:bg-base-200">

                                                    <td class="text-center">{{ $complaint->id }}</td>
                                                    <td class="text-center">{{ $complaint->created_at->format('l') }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $complaint->created_at->format('g:i A') }}</td>
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
                                                            onclick="document.getElementById('view_modal_{{ $complaint->id }}').showModal()">
                                                            Details
                                                        </button>
                                                        <dialog id="view_modal_{{ $complaint->id }}" class="modal">
                                                            <div class="modal-box">
                                                                <form method="dialog" class="mb-6">
                                                                    <button
                                                                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                                                </form>

                                                                {{-- COMPLAINT CARD --}}
                                                                <div class="card bg-base-100 w-full shadow-xl">
                                                                    <figure><img
                                                                            src="{{ asset('/images/first.png') }}"
                                                                            alt="Shoes" />
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
                                                                            <div class="text-lg"><span
                                                                                    class="font-bold">Filed
                                                                                    Date:</span>
                                                                                {{ $complaint->created_at->diffForHumans() }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="text-lg"><span
                                                                                class="font-bold">Category:</span>
                                                                            {{ $complaint->category->complaintCategory_name }}
                                                                        </div>

                                                                        <div class="text-lg"><span
                                                                                class="font-bold">Location:</span>
                                                                            {{ $complaint->location->complaintLocation_name }}
                                                                        </div>

                                                                        <div class="text-lg flex gap-2 w-full"><span
                                                                                class="font-bold">Complainant:</span>
                                                                            <div class="relative w-full">
                                                                                <input
                                                                                    id="complainant{{ $complaint->id }}"
                                                                                    type="password"
                                                                                    value="{{ $complaint->user->name }}"
                                                                                    disabled>
                                                                                <span
                                                                                    id="toggleComplainant{{ $complaint->id }}"
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
                                                                                document.getElementById(`toggleComplainant{{ $complaint->id }}`).addEventListener("click", () => toggleVisibility(
                                                                                    `complainant{{ $complaint->id }}`,
                                                                                    `toggleComplainant{{ $complaint->id }}`));
                                                                            </script>
                                                                        </div>

                                                                        <div class="text-lg"><span
                                                                                class="font-bold">Description:</span>
                                                                            {{ $complaint->description }}</div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </dialog>

                                                        {{-- UPDATE BUTTON --}}


                                                        <button
                                                            class="p-2 rounded-lg  hover:bg-orange-200 hover:text-orange-500 btn"
                                                            onclick="document.getElementById('update_modal_1{{ $complaint->id }}').showModal()">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-pencil-line w-4 h-4 md:w-6 md:h-6">
                                                                <path d="M12 20h9" />
                                                                <path
                                                                    d="M16.376 3.622a1 1 0 0 1 3.002 3.002L7.368 18.635a2 2 0 0 1-.855.506l-2.872.838a.5.5 0 0 1-.62-.62l.838-2.872a2 2 0 0 1 .506-.854z" />
                                                                <path d="m15 5 3 3" />
                                                            </svg>
                                                        </button>
                                                        <dialog id="update_modal_1{{ $complaint->id }}"
                                                            class="modal">
                                                            <div class="modal-box">
                                                                <form method="dialog">
                                                                    <button
                                                                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                                                </form>
                                                                <h3 class="text-3xl font-bold">Update Complaint</h3>
                                                                {{-- Modal Content --}}
                                                                <div class="space-y-3">

                                                                    <form method="post"
                                                                        action="{{ route('complaints.update', $complaint->id) }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        {{-- category --}}
                                                                        <div class="flex flex-col w-full mt-4">
                                                                            <label class="label"
                                                                                for="complaintCategory_id">
                                                                                <span
                                                                                    class="label-text md:text-lg">Category</span>
                                                                            </label>
                                                                            <select name="complaintCategory_id"
                                                                                class="select validator select-bordered text-neutral-800 w-full"
                                                                                required>
                                                                                <option value=""
                                                                                    {{ old('complaintCategory_id', $complaint->category->id) == '' ? 'selected' : '' }}
                                                                                    disabled>
                                                                                    Choose a Category</option>
                                                                                @foreach ($complaintsCategory as $complaintCategory)
                                                                                    <option
                                                                                        value="{{ $complaintCategory->id }}"
                                                                                        {{ old('complaintCategory_id', $complaint->category->id) == $complaintCategory->id ? 'selected' : '' }}>
                                                                                        {{ $complaintCategory->complaintCategory_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            <div class="validator-hint text-[17px]">
                                                                                This field is required
                                                                            </div>
                                                                        </div>

                                                                        {{-- description --}}
                                                                        <div class="flex flex-col">
                                                                            <label class="label" for="description">
                                                                                <span
                                                                                    class="label-text md:text-lg">Description</span>
                                                                            </label>
                                                                            <textarea class="textarea validator w-full" type="text" name="description" required
                                                                                placeholder="Enter description">{{ old('description', $complaint->description) }}</textarea>
                                                                            <div class="validator-hint text-[17px]">
                                                                                This field is required
                                                                            </div>
                                                                        </div>

                                                                        {{-- location --}}
                                                                        <div class="flex flex-col w-full">
                                                                            <label class="label"
                                                                                for="complaintLocation_id">
                                                                                <span
                                                                                    class="label-text md:text-lg">Location</span>
                                                                            </label>
                                                                            <select name="complaintLocation_id"
                                                                                class="select validator select-bordered text-neutral-800 w-full"
                                                                                required>
                                                                                <option value=""
                                                                                    {{ old('complaintLocation_id', $complaint->location->id) == '' ? 'selected' : '' }}
                                                                                    disabled>
                                                                                    Choose a Location</option>
                                                                                @foreach ($complaintsLocation as $complaintLocation)
                                                                                    <option
                                                                                        value="{{ $complaintLocation->id }}"
                                                                                        {{ old('complaintLocation_id', $complaint->location->id) == $complaintLocation->id ? 'selected' : '' }}>
                                                                                        {{ $complaintLocation->complaintLocation_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            <div class="validator-hint text-[17px]">
                                                                                This field is required
                                                                            </div>
                                                                        </div>

                                                                        {{-- status --}}
                                                                        @if (Auth::user()->role === 'official' || Auth::user()->role === 'admin')
                                                                            <div class="flex flex-col">
                                                                                <label class="label" for="status">
                                                                                    <span
                                                                                        class="label-text md:text-lg">Status</span>
                                                                                </label>
                                                                                <select name="status"
                                                                                    class="select validator select-bordered text-neutral-800 w-full"
                                                                                    required>
                                                                                    <option value="" disabled>
                                                                                        Choose a Status</option>
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
                                                                                <div
                                                                                    class="validator-hint text-[17px]">
                                                                                    This field is required
                                                                                </div>
                                                                            </div>
                                                                        @endif

                                                                        {{-- Attachment --}}
                                                                        <div class="mb-3">
                                                                            <label class="label" for="attachment">
                                                                                <span
                                                                                    class="label-text text-lg mb-1">Attachment</span>
                                                                            </label>

                                                                            {{-- Show existing attachment if available --}}
                                                                            @if ($complaint->attachment)
                                                                                <div class="mb-2">
                                                                                    <span
                                                                                        class="text-sm text-gray-500">Current
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
                                                                                    <div
                                                                                        class="flex items-center gap-2">
                                                                                        <button type="button"
                                                                                            id="openCamera1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="lucide lucide-camera-icon lucide-camera w-8 h-8 text-neutral-500 cursor-pointer">
                                                                                                <path
                                                                                                    d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                                                                                <circle cx="12"
                                                                                                    cy="13"
                                                                                                    r="3" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>

                                                                                    <!-- File Input -->
                                                                                    <div
                                                                                        class="flex items-center gap-2 flex-1">
                                                                                        <input type="file"
                                                                                            id="attachment1"
                                                                                            name="attachment"
                                                                                            class="file-input file-input-bordered w-full" />
                                                                                    </div>

                                                                                </div>

                                                                                <!-- Video Stream (Hidden by Default) -->
                                                                                <video id="video1"
                                                                                    class="hidden w-64 h-48 rounded-lg mt-3 mx-auto"></video>

                                                                                <!-- Canvas for Captured Image (Hidden) -->
                                                                                <canvas id="canvas1"
                                                                                    class="hidden"></canvas>

                                                                                <!-- Capture & Close Buttons -->
                                                                                <div id="captureControls1"
                                                                                    class="hidden mt-2">
                                                                                    <div
                                                                                        class="flex justify-center gap-2">
                                                                                        <button type="button"
                                                                                            id="switchCamera1"
                                                                                            class="bg-yellow-500 text-white px-4 py-2 rounded flex gap-2">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
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
                                                                                            <span
                                                                                                class="hidden xs:block sm:inline">Switch
                                                                                                Camera</span>
                                                                                        </button>
                                                                                        <button type="button"
                                                                                            id="captureImage1"
                                                                                            class="bg-green-500 text-white px-4 py-2 rounded flex gap-2">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="lucide lucide-camera-icon lucide-camera h-5 w-5">
                                                                                                <path
                                                                                                    d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                                                                                <circle cx="12"
                                                                                                    cy="13"
                                                                                                    r="3" />
                                                                                            </svg>
                                                                                            <span
                                                                                                class="hidden xs:block sm:inline">Capture</span>
                                                                                        </button>
                                                                                        <button type="button"
                                                                                            id="closeCamera1"
                                                                                            class="bg-red-500 text-white px-4 py-2 rounded flex gap-2">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="lucide lucide-circle-x-icon lucide-circle-x h-5 w-5">
                                                                                                <circle cx="12"
                                                                                                    cy="12"
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

                                                                            <div
                                                                                class="flex justify-start items-center gap-2 mt-3">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="20" height="20"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="lucide lucide-info-circle text-orange-400">
                                                                                    <circle cx="12"
                                                                                        cy="12" r="10" />
                                                                                    <line x1="12"
                                                                                        y1="8" x2="12"
                                                                                        y2="12" />
                                                                                    <line x1="12"
                                                                                        y1="16" x2="12.01"
                                                                                        y2="16" />
                                                                                </svg>
                                                                                <p
                                                                                    class="text-sm tracking-wide italic text-neutral-600">
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
                                                        <form
                                                            action="{{ route('complaints.destroy', $complaint->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="p-2 rounded-lg  hover:bg-red-200 hover:text-red-500 btn">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
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

                                            @if ($complaints->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center py-4">No complaints found
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </dialog>

                    </div>

                    {{-- detailed analysis --}}
                    <div class="border grow border-neutral-300 p-5 rounded-2xl">
                        <h2 class="text-xl font-semibold text-neutral-800">Detailed Analysis</h2>

                        <!-- Toggle Buttons -->
                        <div class="gap-2 flex bg-[#ededed] bg-opacity-10 p-1 rounded-md w-fit mt-2">
                            <button class="bg-[#ededed] px-1 rounded-md py-0.5 cursor-pointer"
                                onclick="changeView('Overview')" id="overviewBtn">Overview</button>
                            <button class="bg-[#ededed] px-1 rounded-md py-0.5 cursor-pointer"
                                onclick="changeView('Categories')" id="categoriesBtn">Categories</button>
                        </div>

                        <!-- Views -->
                        <div id="textChange" class="w">
                            <!-- Overview Section (Default) -->
                            <div id="overviewDiv" class="mt-4">
                                <div class="mt-2 flex gap-4 justify-center align-center">
                                    <div
                                        class="border border-neutral-300 p-3 rounded-lg w-1/2 flex items-center justify-center">
                                        <div class="flex flex-col items-center justify-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-check text-success">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="m9 12 2 2 4-4" />
                                            </svg>
                                            <span style="font-weight: 550"
                                                class="text-sm text-neutral-500">Solved</span>
                                            <div class="text-2xl font-semibold text-neutral-800">
                                                {{-- $complaintsToDisplay --}}
                                                {{ $complaints->where('status', 'solved')->count() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="border border-neutral-300 p-3 rounded-lg w-1/2 flex items-center justify-center">
                                        <div class="flex flex-col items-center justify-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-x text-neutral-600">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="m15 9-6 6" />
                                                <path d="m9 9 6 6" />
                                            </svg>
                                            <span style="font-weight: 550"
                                                class="text-sm text-neutral-500">Closed</span>
                                            <div class="text-2xl font-semibold text-neutral-800">
                                                {{-- $complaintsToDisplay --}}
                                                {{ $complaints->where('status', 'closed')->count() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-4 justify-center align-center mt-4">
                                    <div
                                        class="border border-neutral-300 p-3 rounded-lg w-1/2 flex items-center justify-center">
                                        <div class="flex flex-col items-center justify-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-clock text-info">
                                                <circle cx="12" cy="12" r="10" />
                                                <polyline points="12 6 12 12 16 14" />
                                            </svg>
                                            <span style="font-weight: 550"
                                                class="text-sm text-neutral-500">Processing</span>
                                            <div class="text-2xl font-semibold text-neutral-800">
                                                {{-- $complaintsToDisplay --}}
                                                {{ $complaints->where('status', 'processing')->count() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="border border-neutral-300 p-3 rounded-lg w-1/2 flex items-center justify-center">
                                        <div class="flex flex-col items-center justify-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-alert text-yellow-500">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="12" x2="12" y1="8" y2="12" />
                                                <line x1="12" x2="12.01" y1="16" y2="16" />
                                            </svg>
                                            <span style="font-weight: 550"
                                                class="text-sm text-neutral-500">Pending</span>
                                            <div class="text-2xl font-semibold text-neutral-800">
                                                {{-- $complaintsToDisplay --}}
                                                {{ $complaints->where('status', 'pending')->count() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Categories Section (Initially Hidden) -->
                            <!-- categories bar graph -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <div id="categoriesDiv" class="hidden p-4 bg-white shadow-md rounded-lg mt-4">
                                <!-- Chart Container -->
                                <canvas id="categoriesChart" class="w-full max-h-[250px]"></canvas>

                                <!-- Category Labels and Values -->
                                <table class="w-full mt-4 text-sm font-sans border-collapse">
                                    @foreach ($categoryLabels as $index => $category)
                                        <tr class="flex justify-between border-b border-neutral-300 py-2">
                                            <td class="pr-4 font-medium text-gray-700">{{ $category }}</td>
                                            <td class="font-semibold text-blue-500">{{ $categoryData[$index] }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var ctx = document.getElementById('categoriesChart').getContext('2d');

                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: [
                                                @foreach ($categoryLabels as $category)
                                                    '{{ $category }}',
                                                @endforeach
                                            ],
                                            datasets: [{
                                                label: 'Categories',
                                                data: [
                                                    @foreach ($categoryData as $category)
                                                        {{ $category }},
                                                    @endforeach
                                                ],
                                                backgroundColor: '#4285F4', // Blue color
                                                borderRadius: 5,
                                                barThickness: 40 // Adjusted for better spacing
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            scales: {
                                                x: {
                                                    grid: {
                                                        display: false
                                                    },
                                                    ticks: {
                                                        display: false
                                                    }
                                                },
                                                y: {
                                                    beginAtZero: true,
                                                    ticks: {
                                                        stepSize: 5
                                                    }
                                                }
                                            },
                                            plugins: {
                                                legend: {
                                                    display: false
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>

                    {{-- button switcher --}}
                    <script>
                        // Function to handle view change
                        function changeView(view) {
                            const overviewBtn = document.getElementById('overviewBtn');
                            const categoriesBtn = document.getElementById('categoriesBtn');
                            const overviewDiv = document.getElementById('overviewDiv');
                            const categoriesDiv = document.getElementById('categoriesDiv');

                            if (view === 'Overview') {
                                overviewBtn.classList.add('bg-white');
                                overviewBtn.classList.remove('bg-[#ededed]');
                                categoriesBtn.classList.remove('bg-white');
                                categoriesBtn.classList.add('bg-[#ededed]');
                                overviewDiv.classList.remove('hidden');
                                categoriesDiv.classList.add('hidden');
                            } else if (view === 'Categories') {
                                overviewBtn.classList.remove('bg-white');
                                overviewBtn.classList.add('bg-[#ededed]');
                                categoriesBtn.classList.add('bg-white');
                                categoriesBtn.classList.remove('bg-[#ededed]');
                                overviewDiv.classList.add('hidden');
                                categoriesDiv.classList.remove('hidden');
                            }

                            // Save selected view to localStorage
                            localStorage.setItem('view', view);
                        }

                        // Function to load saved view from localStorage
                        function loadSavedView() {
                            const savedView = localStorage.getItem('view') || 'Overview'; // Default to Overview if no value is stored
                            changeView(savedView);
                        }

                        // Load view on page load
                        document.addEventListener("DOMContentLoaded", loadSavedView);
                    </script>

                </div>
            </div>
        </div>

        {{-- Complaints Lists --}}
        <div class="border border-gray-300 p-8 rounded-2xl mt-7">



            <h1
                class="text-4xl font-semibold bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 bg-clip-text text-transparent">
                @if (auth()->user()->role == 'official' || auth()->user()->role == 'admin')
                    All Complaints For This Month
                @else
                    Your Complaints For The Month
                @endif
            </h1>

            <div>
                <p class="mt-6 text-lg font-semibold text-neutral-700">Filter by:</p>

                <!-- Filtering Form -->
                <form method="GET" class=" mt-2 flex flex-col lg:flex-row gap-2">

                    <div class="flex w-full flex-col md:flex-row grow gap-2">
                        <input type="text" name="id" placeholder="Enter ID"
                            class="input input-bordered border border-neutral-300 cursor-pointer shadow-md w-full md:w-1/2"
                            value="{{ request('id') }}">

                        <select name="category"
                            class="select select-bordered border border-neutral-300 cursor-pointer shadow-md w-full md:w-1/2">
                            <option value="" {{ request('category') == '' ? 'selected' : '' }} disabled>
                                Choose a Category</option>
                            @foreach ($complaintsCategory as $complaintCategory)
                                <option value="{{ $complaintCategory->complaintCategory_name }}"
                                    {{ request('category') == $complaintCategory->complaintCategory_name ? 'selected' : '' }}>
                                    {{ $complaintCategory->complaintCategory_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex w-full flex-col md:flex-row grow gap-2">
                        <select name="status"
                            class="select select-bordered border border-neutral-300 cursor-pointer shadow-md w-full md:w-1/2">
                            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Choose a Status
                            </option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>
                                Processing
                            </option>
                            <option value="solved" {{ request('status') == 'solved' ? 'selected' : '' }}>Solved
                            </option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed
                            </option>
                        </select>

                        <input type="date" name="date"
                            class="input input-bordered border border-neutral-300 shadow-md cursor-pointer w-full md:w-1/2"
                            value="{{ request('date') }}">
                    </div>

                    <div class="flex w-full flex-col md:flex-row grow gap-2">
                        <button type="submit" class="btn btn-info w-full lg:w-fit md:w-1/2">
                            Apply Filter
                        </button>

                        <a href="{{ request()->url() }}"
                            class="btn bg-neutral-300 text-neutral-800 text-md border border-neutral-500 w-full lg:w-fit md:w-1/2">Clear
                            Filter
                        </a>
                    </div>

                </form>
            </div>

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

                        @php

                            if (request('id') || request('category') || request('status') || request('date')) {
                                // Filter complaints based on request parameters (id, category, status, date)
                                $filteredComplaints = $complaints->filter(function ($complaint) {
                                    $matches = true;

                                    if (request('id')) {
                                        $matches = $matches && $complaint->id == request('id');
                                    }

                                    if (request('category')) {
                                        $matches =
                                            $matches &&
                                            $complaint->category->complaintCategory_name == request('category');
                                    }

                                    if (request('status')) {
                                        $matches = $matches && $complaint->status == request('status');
                                    }

                                    if (request('date')) {
                                        $matches =
                                            $matches && $complaint->created_at->toDateString() == request('date');
                                    }

                                    return $matches;
                                });
                            } else {
                                $filteredComplaints = $complaintsToPaginate;
                            }

                            $sortedComplaints = $filteredComplaints->sortByDesc(function ($complaint) {
                                return $complaint->created_at;
                            });
                        @endphp

                        @foreach ($sortedComplaints as $complaint)
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
                                                    action="{{ route('complaints.update', $complaint->id) }}"
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
                                                        <div class="validator-hint text-[17px]">This field is required
                                                        </div>
                                                    </div>

                                                    {{-- description --}}
                                                    <div class="flex flex-col">
                                                        <label class="label" for="description">
                                                            <span class="label-text md:text-lg">Description</span>
                                                        </label>
                                                        <textarea class="textarea validator w-full" type="text" name="description" required
                                                            placeholder="Enter description">{{ old('description', $complaint->description) }}</textarea>
                                                        <div class="validator-hint text-[17px]">This field is required
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
                                                        <div class="validator-hint text-[17px]">This field is required
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
                                                                    <button type="button" id="openCamera2">
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
                                                                    <input type="file" id="attachment2"
                                                                        name="attachment"
                                                                        class="file-input file-input-bordered w-full" />
                                                                </div>

                                                            </div>

                                                            <!-- Video Stream (Hidden by Default) -->
                                                            <video id="video2"
                                                                class="hidden w-64 h-48 rounded-lg mt-3 mx-auto"></video>

                                                            <!-- Canvas for Captured Image (Hidden) -->
                                                            <canvas id="canvas2" class="hidden"></canvas>

                                                            <!-- Capture & Close Buttons -->
                                                            <div id="captureControls2" class="hidden mt-2">
                                                                <div class="flex justify-center gap-2">
                                                                    <button type="button" id="switchCamera2"
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
                                                                    <button type="button" id="captureImage2"
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
                                                                    <button type="button" id="closeCamera2"
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
                                                                const openCameraBtn = document.getElementById("openCamera2");
                                                                const switchCameraBtn = document.getElementById("switchCamera2");
                                                                const captureImageBtn = document.getElementById("captureImage2");
                                                                const closeCameraBtn = document.getElementById("closeCamera2");

                                                                const video = document.getElementById("video2");
                                                                const canvas = document.getElementById("canvas2");
                                                                const attachmentInput = document.getElementById("attachment2");
                                                                const captureControls = document.getElementById("captureControls2");

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
                                    <form action="{{ route('complaints.destroy', $complaint->id) }}" method="post">
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

                        @if ($filteredComplaints->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-4">No complaints found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $complaintsToPaginate->links() }}
            </div>

        </div>

    </div>

</x-layout>
