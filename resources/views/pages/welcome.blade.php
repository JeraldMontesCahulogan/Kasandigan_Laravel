<x-layout class="max-w-7xl mx-auto">
    @vite(['resources/js/welcome.js'])
    <header class="m-auto bg-sky-100 sticky top-0 z-30 lg:relative">
        <nav class="sm:px-4 lg:container lg:mx-auto pb-2 pt-2 md:pt-5 lg:pt-8">
            <div class="navbar">
                <div class="avatar items-center">
                    <div class="ring-primary ring-offset-base-100 w-9 sm:w-15 rounded-full">
                        <img src="{{ asset('images/kasandigan.png') }}" alt="">
                    </div>
                    <p class="ml-2 text-md md:text-2xl font-semibold tracking-wide text-neutral-700">KASANDIGAN</p>
                </div>
                <div class="flex-1 flex items-center justify-start">
                    <a href="#features" id="scrollToFeatures"
                        class="items-center justify-center text-neutral-600 pl-10 hidden lg:block ">
                        <p class="text-xl hover:bg-sky-200 hover:text-sky-800 py-1.5 xl:px-3 px-1.5 rounded-3xl">
                            Features</p>
                    </a>
                    <a href="#testimonials" id="scrollToFeaturesTo"
                        class="items-center justify-center text-neutral-600 pl-10 hidden lg:block">
                        <p class="text-xl hover:bg-sky-200 hover:text-sky-800 py-1.5  xl:px-3 px-1.5 rounded-3xl">
                            Testimonials</p>
                    </a>
                    <a href="#feedbacks" id="scrollToFeedbackTo"
                        class="items-center justify-center text-neutral-600 pl-10 hidden lg:block">
                        <p class="text-xl hover:bg-sky-200 hover:text-sky-800 py-1.5  xl:px-3 px-1.5 rounded-3xl">
                            Feedback</p>
                    </a>
                </div>
                <div class="flex-none">
                    <ul class="menu menu-horizontal p-0">
                        <li class="hidden lg:block"><button
                                class="btn btn-sm sm:btn-md bg-transparent rounded-4xl mr-5 hover:bg-sky-200 hover:text-sky-800"><a
                                    href="{{ route('login') }}"
                                    class="text-xl font-light text-neutral-600 hover:text-sky-800">Sign
                                    in</a></button></li>
                        <button class="btn btn-sm sm:btn-md btn-primary rounded-4xl" style="padding: 0.5rem 1rem"><a
                                href="{{ route('signup') }}" class="text-md sm:text-lg">Get Started Today</a></button>
                    </ul>
                </div>
                <div class="dropdown dropdown-end lg:hidden">
                    <label for="menuToggle" tabindex="0" class="btn btn-circle swap swap-rotate">
                        <input type="checkbox" id="menuToggle" class="hidden" />
                        <svg class="swap-off fill-current w-5 h-5 sm:w-8 sm:h-8" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path d="M64,384H448V341.33H64Zm0-106.67H448V234.67H64ZM64,128v42.67H448V128Z" />
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li>
                            <a href="#features" id="scrollToFeaturesNav"
                                class="flex items-center justify-center text-neutral-600">
                                <p class="text-xl">Features</p>
                            </a>
                        </li>
                        <li><a href="#testimonials" id="scrollToFeaturesToNav"
                                class="flex items-center justify-center text-neutral-600">
                                <p class="text-xl">Testimonials</p>
                            </a>
                        </li>
                        <li><a href="#feedbacks" id="scrollToFeedbackToNav"
                                class="flex items-center justify-center text-neutral-600">
                                <p class="text-xl">Feedback</p>
                            </a>
                        </li>
                        <li><a href="{{ route('login') }}"
                                class="flex items-center justify-center text-neutral-600 text-xl">Sign in</a></li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>
    <div class="flex flex-col">
        <section class="px-1.5 pb-10 md:pb-20 lg:pb-35 bg-gradient-to-b from-sky-100 via-white to-sky-100">
            <div class="container mx-auto flex flex-col xl:flex-row items-center justify-center ">
                <div class="flex flex-col w-full xl:w-1/2">
                    <div class="flex font-bold">
                        <p class="text-4xl md:text-6xl xl:text-7xl text-center xl:text-start "
                            style="background: linear-gradient(to right, #2A52BE, #0091EA); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1.1;">
                            Barangay Complaints made simple for better community service.</p>
                    </div>
                    <div class="flex flex-col mt-5 text-neutral-700">
                        <p style="line-height: 1.5" class="text-lg md:text-xl xl:text-2xl text-center xl:text-start">
                            File complaints easily and track their progress.
                            Your voice matters to us, we handle your issues with utmost professionalism.</p>
                    </div>
                    <div class="mt-10 flex flex-row gap-5 w-full xl:w-1/2 items-center justify-center xl:justify-start">
                        <button
                            class="btn btn-sm sm:btn-md lg:btn-lg btn-primary text-lg rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300">
                            <a href="{{ route('signup') }}" class="flex gap-1 items-center">Get Started <svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-arrow-right">
                                    <path d="M5 12h14" />
                                    <path d="m12 5 7 7-7 7" />
                                </svg></a>
                        </button>
                        <a href="#features" id="scrollingToFeatures"><button
                                class="btn btn-sm sm:btn-md lg:btn-lg border border-neutral-400 text-lg font-medium rounded-3xl text-neutral-700">
                                Learn More
                            </button></a>
                    </div>
                </div>
                <div class="w-full xl:w-1/2 pl-0 xl:pl-60 flex justify-center items-center">
                    <div class="m-auto">
                        <lord-icon src="https://cdn.lordicon.com/tobsqthh.json" trigger="loop" delay="5500"
                            colors="primary:#d1e3fa,secondary:#242424,tertiary:#1663c7"
                            class="w-80 h-80 md:w-110 md:h-110 xl:w-160 xl:h-160">
                        </lord-icon>
                    </div>
                </div>
            </div>
            <script src="https://cdn.lordicon.com/lordicon.js"></script>
        </section>

        <section id="features"
            class="bg-gradient-to-l from-blue-400 via-blue-500 to-blue-600 w-full pt-14 md:pt-20 lg:pt-28 pb-14 md:pb-20 lg:pb-28 px-1.5">
            <div class="flex flex-col items-center justify-center text-center">
                <p class="text-4xl md:text-5xl font-bold text-blue-50">Everything you need to manage complaints.</p>
                <p class="text-xl md:text-2xl text-blue-50 mt-5 max-w-180">We've simplified every step of the complaint
                    process,
                    from
                    submission to resolution.</p>
            </div>
            <div class="flex flex-col xl:flex-row mt-7 md:mt-15">
                <div class="w-full xl:w-1/2 px-10">
                    <div id="carousel" class="carousel rounded-3xl mb-10">
                        <div id="item1" class="carousel-item w-full">
                            <img src="{{ asset('images/first.png') }}" class="w-full h-auto" />
                        </div>
                        <div id="item2" class="carousel-item w-full">
                            <img src="{{ asset('images/second.png') }}" class="w-full h-auto" />
                        </div>
                        <div id="item3" class="carousel-item w-full">
                            <img src="{{ asset('images/third.png') }}" class="w-full h-auto" />
                        </div>
                    </div>
                </div>
                <div class="w-full xl:w-1/2 flex items-center justify-center xl:justify-start">
                    <div class="flex flex-col justify-center gap-7 sm:gap-10 px-10">
                        <a href="javascript:void(0)" id="link-item1"
                            class="flex flex-col p-5 rounded-xl transition-all duration-300 transform text-center sm:text-left"
                            onclick="setCurrent('link-item1', 'link-item2', 'link-item3'); changeImage('first.png');">
                            <p class="font-bold text-xl sm:text-2xl md:text-3xl text-blue-50 mb-1">Complaint Management
                            </p>
                            <p class="text-md sm:text-lg md:text-xl text-blue-50">Easily submit, track, and manage
                                complaints with our
                                intuitive interface.</p>
                        </a>
                        <a href="javascript:void(0)" id="link-item2"
                            class="flex flex-col p-5 rounded-xl transition-all duration-300 transform text-center sm:text-left"
                            onclick="setCurrent('link-item2', 'link-item1', 'link-item3'); changeImage('second.png');">
                            <p class="font-bold text-xl sm:text-2xl md:text-3xl text-blue-50 mb-1">Feedback Feature
                            </p>
                            <p class="text-md sm:text-lg md:text-xl text-blue-50">Easily provide your feedback or
                                comments on the resolution of your complaints.
                            </p>
                        </a>
                        <a href="javascript:void(0)" id="link-item3"
                            class="flex flex-col p-5 rounded-xl transition-all duration-300 transform text-center sm:text-left"
                            onclick="setCurrent('link-item3', 'link-item1', 'link-item2'); changeImage('third.png');">
                            <p class="font-bold text-xl sm:text-2xl md:text-3xl text-blue-50 mb-1">Analytics Dashboard
                            </p>
                            <p class="text-md sm:text-lg md:text-xl text-blue-50">Comprehensive reports and insights
                                for barangay officials.
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section
            class="w-full pt-14 md:pt-20 lg:pt-28 pb-14 md:pb-20 lg:pb-30 px-1.5 bg-gradient-to-b from-sky-100 via-white to-sky-100">
            <div class="flex flex-col items-center justify-center text-center text-neutral-700">
                <p class="text-4xl md:text-5xl font-bold">Simplify everyday community tasks.</p>
                <p class="text-xl md:text-2xl mt-5 max-w-180">Our intuitive complaint system makes it easy to submit
                    and manage
                    your concerns with just a few clicks.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-15 w-full mt-7 md:mt-15 px-1.5 lg:pt-8">
                <div class="flex flex-col items-center w-80 md:w-96">
                    <div class="bg-blue-200 rounded-full w-fit p-4 text-blue-500 mb-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-file-text w-12 h-12">
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            <path d="M10 9H8" />
                            <path d="M16 13H8" />
                            <path d="M16 17H8" />
                        </svg>
                    </div>
                    <p class="text-lg md:text-2xl font-semibold mb-1">File a Complaint</p>
                    <p class="text-center md:text-xl">Easily submit detailed complaints with our user-friendly form.
                        Attach photos and documents as evidence.</p>
                </div>

                <div class="flex flex-col items-center w-80 md:w-96">
                    <div class="bg-blue-200 rounded-full w-fit p-4 text-blue-500 mb-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-file-text w-12 h-12">
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            <path d="M10 9H8" />
                            <path d="M16 13H8" />
                            <path d="M16 17H8" />
                        </svg>
                    </div>
                    <p class="text-lg md:text-2xl font-semibold mb-1">Track Progress</p>
                    <p class="text-center md:text-xl">Monitor the status of your complaints in real-time. Get updates
                        at every stage of the resolution process.</p>
                </div>

                <div class="flex flex-col items-center w-80  md:w-96">
                    <div class="bg-blue-200 rounded-full w-fit p-4 text-blue-500 mb-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-file-text w-12 h-12">
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            <path d="M10 9H8" />
                            <path d="M16 13H8" />
                            <path d="M16 17H8" />
                        </svg>
                    </div>
                    <p class="text-lg md:text-2xl font-semibold mb-1">Get Resolution</p>
                    <p class="text-center md:text-xl">Receive official responses and resolutions from barangay
                        officials directly through the platform.</p>
                </div>
            </div>
        </section>

        <section id="testimonials"
            class="bg-neutral-100 w-full pt-14 md:pt-20 lg:pt-28 pb-14 md:pb-20 lg:pb-28 px-1.5 bg-gradient-to-b from-sky-100 via-white to-sky-100">
            <div class="flex flex-col items-center justify-center text-center text-neutral-700">
                <p class="text-4xl md:text-5xl font-bold">Loved by citizens and officials alike.</p>
                <p class="text-xl md:text-2xl mt-5 max-w-180">See what our users are saying about how our system has
                    improved
                    community engagement.</p>
            </div>
            <div>
                <div class="flex flex-wrap justify-center text-neutral-700 mt-7 gap-8 md:mt-15 px-1.5">
                    <div
                        class="flex flex-col w-80 md:w-96 shadow-2xl border border-neutral-200 p-8 rounded-2xl justify-between gap-5">
                        <p class="md:text-xl">This system has made filing complaints so much easier. I was able to
                            report an issue with our
                            street lights and it was fixed within days!</p>
                        <div class="flex">
                            <div>
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img
                                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col ml-3">
                                <span class="font-semibold md:text-lg">Maria Santos</span>
                                <span class="leading-none text-sm">Resident</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-col w-80 md:w-96 shadow-2xl border border-neutral-200 p-8 rounded-2xl justify-between gap-5">
                        <p class="md:text-xl">As a barangay official, this platform has streamlined our complaint
                            management process. We can now respond faster and more efficiently.</p>
                        <div class="flex">
                            <div>
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img
                                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col ml-3">
                                <span class="font-semibold md:text-lg">Juan Dela Cruz</span>
                                <span class="leading-none text-sm">Barangay Captain</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-col w-80 md:w-96 shadow-2xl border border-neutral-200 p-8 rounded-2xl justify-between gap-5">
                        <p class="md:text-xl">The transparency of this system is amazing. I can track the status of my
                            complaint and see exactly what actions are being taken.</p>
                        <div class="flex">
                            <div>
                                <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img
                                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col ml-3">
                                <span class="font-semibold md:text-lg">Pedro Reyes</span>
                                <span class="leading-none text-sm">Community Member</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="feedbacks"
            class="w-full pt-14 md:pt-20 pb-14 md:pb-20 px-1.5 flex flex-col xl:flex-row justify-between items-center bg-gradient-to-b from-sky-100 via-white to-sky-100">
            <div class="w-full xl:w-1/2 flex items-center justify-center xl:justify-end ">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/feedback.png') }}" class="w-1/2" alt="">
                    <div
                        class="flex flex-col justify-center lg:gap-4 md:gap-2 gap-1 lg:text-7xl md:text-6xl sm:text-5xl text-3xl font-bold w-1/2">
                        <p
                            class="bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 bg-clip-text text-transparent">
                            Share</p>
                        <p
                            class="bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 bg-clip-text text-transparent">
                            Your</p>
                        <p
                            class="bg-gradient-to-r from-blue-700 via-blue-500 to-blue-700 bg-clip-text text-transparent">
                            Thoughts!</p>
                    </div>
                </div>

            </div>
            <div class="w-full xl:w-1/2 flex items-center justify-center xl:justify-start xl:pl-20 px-3">
                <div
                    class="overflow-x-auto flex flex-col  justify-center items-center w-100 sm:w-125 border border-neutral-200 shadow-2xl rounded-2xl md:p-6 p-4">
                    <form method="post" action="{{ url('/feedbackQuest') }}" class="flex flex-col gap-4">
                        @csrf

                        {{-- rating --}}
                        <div>
                            <label class="label mb-0.5" for="rating">
                                <span class="label-text md:text-lg text-sm text-neutral-700 font-medium">How
                                    would you
                                    rate
                                    our
                                    service?</span>
                            </label>
                            <div class="flex justify-start gap-2 sm:gap-6">
                                <div class="flex gap-2">
                                    <input type="radio" id="radio-1" name="rating"
                                        class="radio radio-success border border-neutral-400" value="excellent"
                                        required />
                                    <label for="radio-1"
                                        class="md:text-lg text-sm font-medium text-neutral-700">Excellent</label>
                                </div>

                                <div class="flex gap-2">
                                    <input type="radio" id="radio-2" name="rating"
                                        class="radio border radio-info border-neutral-400" value="good" required />
                                    <label for="radio-2"
                                        class="md:text-lg text-sm font-medium text-neutral-700">Good</label>
                                </div>

                                <div class="flex gap-2">
                                    <input type="radio" id="radio-3" name="rating"
                                        class="radio border radio-warning border-neutral-400" value="fair"
                                        required />
                                    <label for="radio-3"
                                        class="md:text-lg text-sm font-medium text-neutral-700">Fair</label>
                                </div>

                                <div class="flex gap-2">
                                    <input type="radio" id="radio-4" name="rating"
                                        class="radio border radio-error border-neutral-400" value="poor" required />
                                    <label for="radio-4"
                                        class="md:text-lg text-sm font-medium text-neutral-700">Poor</label>
                                </div>
                            </div>
                        </div>

                        {{-- description --}}
                        <div class="font-medium">
                            <label class="label" for="service_feedback">
                                <span class="label-text md:text-lg text-sm text-neutral-700">What do you
                                    think about our
                                    barangay's
                                    service?</span>
                            </label>
                            <textarea class="textarea textarea-bordered w-full" placeholder="Please share your thoughts..."
                                name="service_feedback"></textarea>
                        </div>

                        {{-- description --}}
                        <div class="font-medium">
                            <label class="label" for="improvement_suggestions">
                                <span class="label-text md:text-lg text-sm text-neutral-700">What can we do
                                    to improve our
                                    service?</span>
                            </label>
                            <textarea class="textarea  textarea-bordered w-full" placeholder="Your suggestions for improvement"
                                name="improvement_suggestions"></textarea>
                        </div>

                        <button class="btn btn-info font-bold text-lg py-4.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send mr-2">
                                <path
                                    d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z" />
                                <path d="m21.854 2.147-10.94 10.939" />
                            </svg>
                            Submit
                        </button>

                        <p class="text-sm flex items-center gap-2 text-neutral-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-circle-check-big w-5 h-5">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                <path d="m9 11 3 3L22 4" />
                            </svg>
                            All feedback is reviewed by our barangay officials within 48 hours.
                        </p>

                    </form>
                </div>
            </div>
        </section>

        <section
            class="w-full pt-14 md:pt-20 lg:pt-28 pb-14 md:pb-20 px-1.5 bg-gradient-to-l from-blue-400 via-blue-500 to-blue-600 flex flex-col items-center justify-center">
            <div class="flex flex-col items-center justify-center text-center text-blue-50">
                <p class="text-4xl md:text-5xl font-bold">Get started today</p>
                <p class="text-xl md:text-2xl mt-5 max-w-180">Be the voice that makes a difference in your barangay.
                    Sign up and submit your first complaint in minutes.</p>
            </div>
            <a href="{{ route('signup') }}">
                <button class="btn btn-sm sm:btn-md lg:btn-lg text-lg font-medium rounded-3xl text-neutral-700 mt-8">
                    Get Started Now
                </button>
            </a>
        </section>

        <footer class="footer footer-horizontal footer-center bg-neutral-100 text-base-content rounded p-10">
            <nav class="grid grid-flow-col gap-4">
                <a id="scrollToFeaturesFooter" class="link link-hover" href="#features">Features</a>
                <a id="scrollToTestimonialsFooter" class="link link-hover" href="#testimonials">Testimonials</a>
                <a id="scrollToFeedbackFooter" class="link link-hover" href="#feedbacks">Feedback</a>
            </nav>
            <nav>
                <div class="grid grid-flow-col gap-4">
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                            </path>
                        </svg>
                    </a>
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z">
                            </path>
                        </svg>
                    </a>
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-current">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z">
                            </path>
                        </svg>
                    </a>
                </div>
            </nav>
            <aside>
                <p>Copyright © {{ date('Y') }} - All rights reserved by Kasandigan</p>
            </aside>
        </footer>


        {{-- javascript for carousel --}}
        <script>
            // Function to set the current selected item in feature
            function setCurrent(selectedId, otherId1, otherId2) {
                document.getElementById(selectedId).classList.add('backdrop-blur-[6px]', 'backdrop-saturate-[183%]',
                    'bg-[rgba(17,25,40,0.16)]', 'scale-105');
                document.getElementById(otherId1).classList.remove('backdrop-blur-[6px]', 'backdrop-saturate-[183%]',
                    'bg-[rgba(17,25,40,0.16)]', 'scale-105');
                document.getElementById(otherId2).classList.remove('backdrop-blur-[6px]', 'backdrop-saturate-[183%]',
                    'bg-[rgba(17,25,40,0.16)]', 'scale-105');
            }
            // Function to change the image
            function changeImage(imageName) {
                const items = document.querySelectorAll('.carousel-item');
                items.forEach(item => item.classList.add('hidden'));
                const selectedItem = Array.from(items).find(item => item.querySelector('img').src.includes(imageName));
                if (selectedItem) {
                    selectedItem.classList.remove('hidden');
                }
            }
            setCurrent('link-item1', 'link-item2', 'link-item3');
            changeImage('first.png');
        </script>
    </div>
</x-layout>
