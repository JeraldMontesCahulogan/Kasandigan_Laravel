<x-layout>

    <div class="pb-4 px-4 md:pb-8 md:px-8">
        {{-- Header and Submit New Complaint --}}
        <div class="mt-8 flex flex-col md:flex-row justify-between">
            <h1
                class="text-4xl font-bold mb-5 md:mb-0 bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 bg-clip-text text-transparent">
                Feedback Dashboard</h1>
        </div>

        {{-- Complaints Graph --}}
        <div>
            {{-- Upper --}}
            <div class="flex flex-col xl:flex-row xl:gap-7">
                {{-- Chart --}}
                <div class="border border-neutral-300 p-5 rounded-2xl w-full xl:w-1/3 xl:max-w-[40%] mt-7">
                    <h2 class="font-semibold text-xl">Rating Distribution</h2>

                    @php
                        $totalFeedbacks = $feedbackAll->count() ?: 1; // Avoid division by zero
                        $ratings = [
                            'excellent' => [
                                'label' => 'Excellent',
                                'color' => 'bg-green-500',
                                'count' => $feedbackAll->where('rating', 'excellent')->count(),
                            ],
                            'good' => [
                                'label' => 'Good',
                                'color' => 'bg-blue-500',
                                'count' => $feedbackAll->where('rating', 'good')->count(),
                            ],
                            'fair' => [
                                'label' => 'Fair',
                                'color' => 'bg-yellow-500',
                                'count' => $feedbackAll->where('rating', 'fair')->count(),
                            ],
                            'poor' => [
                                'label' => 'Poor',
                                'color' => 'bg-red-500',
                                'count' => $feedbackAll->where('rating', 'poor')->count(),
                            ],
                        ];
                    @endphp

                    @foreach ($ratings as $rating)
                        @php
                            $percentage = round(($rating['count'] / $totalFeedbacks) * 100);
                        @endphp
                        <div class="mt-4">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 {{ $rating['color'] }} rounded-full"></span>
                                    <span class="text-sm">{{ $rating['label'] }}</span>
                                </div>
                                <span class="text-sm font-medium">{{ $percentage }}%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full mt-1">
                                <div class="h-full {{ $rating['color'] }} rounded-full"
                                    style="width: {{ $percentage }}%;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>


                {{-- More Details --}}
                <div class="w-full xl:grow mt-7 flex flex-col gap-5">

                    {{-- total and this week --}}
                    <div class="flex flex-wrap gap-4">

                        {{-- total feedbacks --}}
                        <div class="border grow border-neutral-300 p-5 rounded-2xl h-fit">
                            <div class="text-lg text-neutral-600">Total Feedbacks</div>
                            <div class="flex justify-between">
                                <div class="text-2xl font-semibold  text-neutral-800">
                                    {{ $feedbackAll->count() }}
                                </div>
                                <div class="p-1.75 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chart-pie text-blue-600">
                                        <path
                                            d="M21 12c.552 0 1.005-.449.95-.998a10 10 0 0 0-8.953-8.951c-.55-.055-.998.398-.998.95v8a1 1 0 0 0 1 1z" />
                                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="border grow border-neutral-300 p-5 rounded-2xl h-fit">
                            <div class="text-lg text-neutral-600">Satisfactory Rate</div>
                            <div class="flex justify-between">
                                <div class="text-2xl font-semibold  text-neutral-800">
                                    {{ $feedbackAll->count() ? intval((($feedbackAll->where('rating', 'excellent')->count() + $feedbackAll->where('rating', 'good')->count()) / $feedbackAll->count()) * 100) . '%' : '0%' }}
                                </div>
                                <div class="p-1.75 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-thumbs-up text-green-500">
                                        <path d="M7 10v12" />
                                        <path
                                            d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- new this week --}}
                        <button class="border grow border-neutral-300 p-5 rounded-2xl h-fit cursor-pointer"
                            onclick="my_modal_3.showModal()">
                            <div class="text-lg text-neutral-600 text-left">New This Week</div>
                            <div class="flex justify-between">
                                <div class="text-2xl font-semibold text-neutral-800">
                                    {{ $feedbackAll->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}
                                </div>
                                <div class="p-2 rounded-full flex items-center justify-center text-neutral-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar">
                                        <path d="M8 2v4" />
                                        <path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                    </svg>
                                </div>
                            </div>
                        </button>

                        {{-- New this week modal --}}
                        <dialog id="my_modal_3" class="modal">
                            <div class="modal-box w-11/12 max-w-5xl">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-2xl font-bold mt-2">Feedback This Week</h3>
                                <div class="overflow-y-auto max-h-[55vh] mt-3">
                                    <div class="mt-5 overflow-x-auto">
                                        <table class="table table:sm md:table-md lg:table-lg">
                                            <thead class="bg-neutral-200">
                                                <tr class="text-sm md:text-md lg:text-lg text-neutral-700">
                                                    <th>ID</th>
                                                    <th class="text-center">Date</th>
                                                    <th>Feedback</th>
                                                    <th>Improvement Suggestion</th>
                                                    <th class="text-center">Rating</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($feedbackAll->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]) as $feedback)
                                                    <tr class="hover">

                                                        <td>{{ $feedback->id }}</td>

                                                        <th class="text-center font-normal">
                                                            {{ $feedback->created_at->format('Y-m-d') }}</th>

                                                        <td>{{ $feedback->service_feedback !== null ? Str::limit($feedback->service_feedback, 60) . (strlen($feedback->service_feedback) > 60 ? '...' : '') : 'N/A' }}
                                                        </td>

                                                        <td>{{ $feedback->improvement_suggestions !== null ? Str::limit($feedback->improvement_suggestions, 60) . (strlen($feedback->improvement_suggestions) > 60 ? '...' : '') : 'N/A' }}
                                                        </td>

                                                        <td>
                                                            <div
                                                                class="badge text-xs md:text-md lg:text-lg
                                              {{ $feedback->rating == 'good'
                                                  ? 'badge-info'
                                                  : ($feedback->rating == 'poor'
                                                      ? 'badge-error'
                                                      : ($feedback->rating == 'excellent'
                                                          ? 'badge-success'
                                                          : 'badge-warning')) }} 
                                              mt-2 py-3 px-2 text-lg font-medium">
                                                                {{ $feedback->rating }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="flex items-center justify-center gap-5">

                                                                <!-- View Details Button and Modal -->
                                                                <button
                                                                    class="btn border btn-xs md:btn-sm lg:btn-md border-neutral-400"
                                                                    onclick="document.getElementById('view_modal_{{ $feedback->id }}').showModal()">
                                                                    Details
                                                                </button>
                                                                <dialog id="view_modal_{{ $feedback->id }}"
                                                                    class="modal">
                                                                    <div class="modal-box">
                                                                        <form method="dialog">
                                                                            <button
                                                                                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                                                        </form>
                                                                        <h3 class="text-2xl font-bold">Feedback Details
                                                                        </h3>

                                                                        <div class="space-y-4">
                                                                            <div class="text-lg mt-6">
                                                                                <div class="flex gap-2">
                                                                                    <span class="font-bold">Name:</span>
                                                                                    <div class="relative w-full">
                                                                                        @php
                                                                                            $isGuest =
                                                                                                $feedback->isQuest == 1;
                                                                                            $isAnonymous =
                                                                                                $feedback->anonymous ==
                                                                                                '1';
                                                                                            $name = $isGuest
                                                                                                ? 'Guest'
                                                                                                : ($isAnonymous
                                                                                                    ? 'Anonymous'
                                                                                                    : ($feedback->user
                                                                                                        ? $feedback
                                                                                                            ->user->name
                                                                                                        : 'Unknown User'));
                                                                                        @endphp

                                                                                        <input
                                                                                            id="complainant{{ $feedback->id }}"
                                                                                            type="{{ !$isGuest && !$isAnonymous ? 'password' : 'text' }}"
                                                                                            value="{{ $name }}"
                                                                                            disabled>

                                                                                        @if (!$isGuest && !$isAnonymous)
                                                                                            <span
                                                                                                id="toggleComplainant{{ $feedback->id }}"
                                                                                                class="absolute top-0.5 right-1 cursor-pointer">
                                                                                                <i
                                                                                                    class="fa fa-eye text-gray-400 hover:text-gray-500 w-full"></i>
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>

                                                                                @if (!$isGuest && !$isAnonymous)
                                                                                    <script>
                                                                                        function toggleVisibility(inputId, iconId) {
                                                                                            const input = document.getElementById(inputId);
                                                                                            const icon = document.getElementById(iconId).querySelector("i");

                                                                                            if (input.type === "password") {
                                                                                                input.type = "text";
                                                                                                icon.classList.replace("fa-eye", "fa-eye-slash");
                                                                                            } else {
                                                                                                input.type = "password";
                                                                                                icon.classList.replace("fa-eye-slash", "fa-eye");
                                                                                            }
                                                                                        }

                                                                                        document.getElementById(`toggleComplainant{{ $feedback->id }}`).addEventListener("click", () =>
                                                                                            toggleVisibility(`complainant{{ $feedback->id }}`, `toggleComplainant{{ $feedback->id }}`)
                                                                                        );
                                                                                    </script>
                                                                                @endif
                                                                            </div>

                                                                            <div class="text-lg">
                                                                                <span class="font-bold">Rating:</span>
                                                                                {{ $feedback->rating }}
                                                                            </div>

                                                                            <div class="text-lg">
                                                                                <span class="font-bold">Service
                                                                                    Feedback:</span>
                                                                                {{ $feedback->service_feedback }}
                                                                            </div>

                                                                            <div class="text-lg">
                                                                                <span class="font-bold">Improvement
                                                                                    Suggestions:</span>
                                                                                {{ $feedback->improvement_suggestions }}
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </dialog>

                                                                <!-- Delete Icon -->
                                                                <form
                                                                    action="{{ route('feedbacks.destroy', $feedback->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button>
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="lucide lucide-trash w-7 h-7 p-1  lg:w-10 lg:h-10 rounded-lg bg-neutral-200 lg:p-2 hover:bg-red-200 hover:text-red-600 cursor-pointer">
                                                                            <path d="M3 6h18" />
                                                                            <path
                                                                                d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                                            <path
                                                                                d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                                        </svg>
                                                                    </button>
                                                                </form>


                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                @if ($feedbackAll->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->isEmpty())
                                                    <tr>
                                                        <td colspan="5" class="text-center py-4">No feedback found
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </dialog>

                    </div>

                    {{-- detailed analysis --}}
                    <div class="border grow border-neutral-300 p-5 rounded-2xl">
                        <h2 class="text-xl font-semibold text-neutral-800">Detailed Analysis</h2>

                        <div class="flex flex-col xl:flex-row gap-3 mt-3">
                            <div class="flex w-full gap-3">
                                <div
                                    class="w-1/2 border border-neutral-300 flex justify-center items-center p-3 rounded-xl">
                                    <div class="flex flex-col items-center justify-center gap-1">
                                        <div class="p-1.75 flex items-center justify-center rounded-full bg-green-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-thumbs-up text-green-500">
                                                <path d="M7 10v12" />
                                                <path
                                                    d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z" />
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-neutral-500">Excellent</span>
                                        <span
                                            class="font-semibold text-neutral-800 text-2xl">{{ $feedbackAll->where('rating', 'excellent')->count() }}</span>
                                    </div>
                                </div>
                                <div
                                    class="w-1/2 border border-neutral-300 flex justify-center items-center p-3 rounded-xl">
                                    <div class="flex flex-col items-center justify-center gap-1">
                                        <div class="p-1.75 flex items-center justify-center rounded-full bg-blue-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-smile text-blue-500">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M8 14s1.5 2 4 2 4-2 4-2" />
                                                <line x1="9" x2="9.01" y1="9" y2="9" />
                                                <line x1="15" x2="15.01" y1="9" y2="9" />
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-neutral-500">Good</span>
                                        <span
                                            class="font-semibold text-neutral-800 text-2xl">{{ $feedbackAll->where('rating', 'good')->count() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex w-full gap-3">
                                <div
                                    class="w-1/2 border border-neutral-300 flex justify-center items-center p-3 rounded-xl">
                                    <div class="flex flex-col items-center justify-center gap-1">
                                        <div
                                            class="p-1.75 flex items-center justify-center rounded-full bg-yellow-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-annoyed text-orange-400">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M8 15h8" />
                                                <path d="M8 9h2" />
                                                <path d="M14 9h2" />
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-neutral-500">Fair</span>
                                        <span
                                            class="font-semibold text-neutral-800 text-2xl">{{ $feedbackAll->where('rating', 'fair')->count() }}</span>
                                    </div>
                                </div>
                                <div
                                    class="w-1/2 border border-neutral-300 flex justify-center items-center p-3 rounded-xl">
                                    <div class="flex flex-col items-center justify-center gap-1">
                                        <div class="p-1.75 flex items-center justify-center rounded-full bg-red-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-thumbs-down text-red-500">
                                                <path d="M17 14V2" />
                                                <path
                                                    d="M9 18.12 10 14H4.17a2 2 0 0 1-1.92-2.56l2.33-8A2 2 0 0 1 6.5 2H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.76a2 2 0 0 0-1.79 1.11L12 22a3.13 3.13 0 0 1-3-3.88Z" />
                                            </svg>
                                        </div>
                                        <span class="font-semibold text-neutral-500">Poor</span>
                                        <span
                                            class="font-semibold text-neutral-800 text-2xl">{{ $feedbackAll->where('rating', 'poor')->count() }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="p-3 lg:p-7 border border-neutral-300 rounded-2xl mt-7">

            <h1
                class="text-4xl font-semibold bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 bg-clip-text text-transparent">
                Lists Of Feedbacks</h1>

            <div>
                <p class="mt-6 text-lg font-semibold">Filter by:</p>

                <!-- Filtering and Search Form -->

                <form method="GET" class=" mt-2 flex flex-col lg:flex-row gap-2">

                    <div class="flex w-full flex-col md:flex-row grow gap-2">
                        <input type="text" name="id" placeholder="Enter ID"
                            class="input input-bordered border border-neutral-300 cursor-pointer shadow-md w-full md:w-1/2"
                            value="{{ request('id') }}">

                        <select name="rating"
                            class="select select-bordered border border-neutral-300 cursor-pointer shadow-md w-full md:w-1/2">
                            <option value="">Select rating</option>
                            <option value="excellent" {{ request('rating') == 'excellent' ? 'selected' : '' }}>
                                Excellent
                            </option>
                            <option value="good" {{ request('rating') == 'good' ? 'selected' : '' }}>Good</option>
                            <option value="fair" {{ request('rating') == 'fair' ? 'selected' : '' }}>Fair</option>
                            <option value="poor" {{ request('rating') == 'poor' ? 'selected' : '' }}>Poor</option>
                        </select>

                    </div>

                    <div class="flex w-full flex-col md:flex-row grow gap-2">
                        <label
                            class="input input-bordered flex items-center border border-neutral-300 cursor-pointer shadow-md w-full md:w-1/2">
                            <input type="text" name="search" value="{{ request('search') }}" class="grow"
                                placeholder="Search in feedback or improvement" />
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="h-4 w-4 opacity-70">
                                <path fill-rule="evenodd"
                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </label>

                        <input type="date" name="date"
                            class="input input-bordered border border-neutral-300 cursor-pointer shadow-md w-full md:w-1/2"
                            value="{{ request('date') }}">
                    </div>

                    <div class="flex w-full flex-col md:flex-row grow gap-2">
                        <button type="submit" class="btn btn-info w-full lg:w-fit md:w-1/2">Apply
                            Filter</button>
                        <a href="{{ request()->url() }}"
                            class="btn bg-neutral-300 text-neutral-800 text-md border border-neutral-500 w-full lg:w-fit md:w-1/2">Clear
                            Filter
                        </a>
                    </div>


                </form>
            </div>

            @php
                // Filter feedbacks based on request parameters (id, category, status, date)
                if (request('id') || request('rating') || request('search') || request('date')) {
                    $filteredFeedbacks = $feedbackAll->filter(function ($feedback) {
                        $matches = true;
                        if (request('id')) {
                            $matches = $matches && $feedback->id == request('id');
                        }
                        if (request('rating')) {
                            $matches = $matches && $feedback->rating == request('rating');
                        }
                        if (request('search')) {
                            $search = request('search');
                            $matches =
                                $matches &&
                                (Str::contains($feedback->service_feedback, $search) ||
                                    Str::contains($feedback->improvement_suggestions, $search));
                        }
                        if (request('date')) {
                            $matches = $matches && $feedback->created_at->toDateString() == request('date');
                        }
                        return $matches;
                    });
                } else {
                    $filteredFeedbacks = $feedbacks;
                }

                // Fetch filtered results
                $filteredFeedbacks = $filteredFeedbacks->sortByDesc('created_at');
            @endphp

            <div class="mt-10 overflow-x-auto">
                <table class="table table:sm md:table-md lg:table-lg">
                    <thead class="bg-neutral-200">
                        <tr class="text-sm md:text-md lg:text-lg text-neutral-700">
                            <th>ID</th>
                            <th class="text-center">Date</th>
                            <th>Feedback</th>
                            <th>Improvement Suggestion</th>
                            <th class="text-center">Rating</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filteredFeedbacks as $feedback)
                            <tr class="hover">

                                <td>{{ $feedback->id }}</td>

                                <th class="text-center font-normal">{{ $feedback->created_at->format('Y-m-d') }}</th>

                                <td>{{ $feedback->service_feedback !== null ? Str::limit($feedback->service_feedback, 60) . (strlen($feedback->service_feedback) > 60 ? '...' : '') : 'N/A' }}
                                </td>

                                <td>{{ $feedback->improvement_suggestions !== null ? Str::limit($feedback->improvement_suggestions, 60) . (strlen($feedback->improvement_suggestions) > 60 ? '...' : '') : 'N/A' }}
                                </td>

                                <td>
                                    <div
                                        class="badge text-xs md:text-md lg:text-lg
                          {{ $feedback->rating == 'good'
                              ? 'badge-info'
                              : ($feedback->rating == 'poor'
                                  ? 'badge-error'
                                  : ($feedback->rating == 'excellent'
                                      ? 'badge-success'
                                      : 'badge-warning')) }} 
                          mt-2 py-3 px-2 text-lg font-medium">
                                        {{ $feedback->rating }}
                                    </div>
                                </td>

                                <td>
                                    <div class="flex items-center justify-center gap-5">

                                        <!-- View Details Button and Modal -->
                                        <button class="btn border btn-xs md:btn-sm lg:btn-md border-neutral-400"
                                            onclick="document.getElementById('view_modal_{{ $feedback->id }}').showModal()">
                                            Details
                                        </button>
                                        <dialog id="view_modal_{{ $feedback->id }}" class="modal">
                                            <div class="modal-box">
                                                <form method="dialog">
                                                    <button
                                                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                                </form>
                                                <h3 class="text-2xl font-bold">Feedback Details</h3>

                                                <div class="space-y-4">
                                                    <div class="text-lg mt-6">
                                                        <span class="font-bold">Name:</span>
                                                        {{ $feedback->anonymous == '1' ? 'Anonymous' : ($feedback->user ? $feedback->user->name : 'Unknown User') }}
                                                    </div>
                                                    <div class="text-lg"><span class="font-bold">Rating:</span>
                                                        {{ $feedback->rating }}</div>

                                                    <div class="text-lg"><span class="font-bold">Service
                                                            Feedback:</span> {{ $feedback->service_feedback }}</div>

                                                    <div class="text-lg"><span class="font-bold">Improvement
                                                            Suggestions:</span>
                                                        {{ $feedback->improvement_suggestions }}</div>
                                                </div>
                                            </div>
                                        </dialog>

                                        <!-- Delete Icon -->
                                        <form action="{{ route('feedbacks.destroy', $feedback->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-trash w-7 h-7 p-1  lg:w-10 lg:h-10 rounded-lg bg-neutral-200 lg:p-2 hover:bg-red-200 hover:text-red-600 cursor-pointer">
                                                    <path d="M3 6h18" />
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if ($filteredFeedbacks->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-4">No feedback found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>

        <div class="mt-5">
            {{ $feedbacks->links() }}
        </div>

    </div>

</x-layout>
