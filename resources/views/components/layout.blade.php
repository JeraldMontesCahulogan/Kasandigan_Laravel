<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/layout.js'])
    <title>{{ env('APP_NAME') }}</title>
    <style>
        @media screen and (max-width: 1024px) {
            .shrink+main {
                margin-left: 0px !important;
            }

            main {
                margin-left: 0px !important;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const main = document.querySelector('main');

            function updateLayout() {
                if (window.innerWidth <= 1024) {
                    sidebar.classList.add('shrink');
                } else {
                    sidebar.classList.remove('shrink');
                }
            }

            window.addEventListener('resize', updateLayout);
            updateLayout();
        });
    </script>
</head>

<body class="flex flex-col h-screen">

    @if (session('status'))
        <script>
            setTimeout(function() {
                const successMessage = document.createElement('div');
                successMessage.role = 'alert';
                successMessage.className =
                    'fixed rounded-lg top-5 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-4 mt-8 mr-4 bg-secondary border border-none text-sm md:text-md lg:text-lg text-neutral-800 font-semibold rounded transition-opacity duration-1000 alert alert-success z-50';
                successMessage.id = 'success-message';
                successMessage.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ session('status') }}</span>
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
    @endif

    @if (session('success'))
        <script>
            setTimeout(function() {
                const successMessage = document.createElement('div');
                successMessage.role = 'alert';
                successMessage.className =
                    'fixed rounded-lg top-5 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-4 mt-8 mr-4 bg-secondary border border-none text-sm md:text-md lg:text-lg text-neutral-800 font-semibold rounded transition-opacity duration-1000 alert alert-success z-50';
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
    @endif

    @if (session('error'))
        <script>
            setTimeout(function() {
                const errorMessage = document.createElement('div');
                errorMessage.role = 'alert';
                errorMessage.className =
                    'fixed rounded-lg top-5 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-4 mt-8 mr-4 bg-red-600 border border-none text-sm md:text-md lg:text-lg text-white font-semibold rounded transition-opacity duration-1000 alert alert-danger z-50';
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
    @endif

    <script>
        window.isUserOfficial =
            @auth {{ auth()->user()->role === 'official' || auth()->user()->role === 'admin' ? 'true' : 'false' }}
        @else
            false
        @endauth ;

        document.addEventListener("DOMContentLoaded", () => {
            const sidebar = document.getElementById("sidebar");
            const toggle = document.getElementById("menu-toggle");
            const toggleReverse = document.getElementById("menu-toggle-reverse");
            const navLinks = document.querySelectorAll(".navLink");
            const currentPath = window.location.pathname;

            // Load sidebar state from localStorage
            if (localStorage.getItem("sidebarState") === "shrink") {
                sidebar.classList.add("shrink");
                toggle.classList.add("hidden");
                toggleReverse.classList.remove("hidden");
            } else {
                sidebar.classList.remove("shrink");
                toggle.classList.remove("hidden");
                toggleReverse.classList.add("hidden");
            }

            // Highlight active nav link based on role
            navLinks.forEach((link) => {
                // Remove both bg classes first
                link.classList.remove("bg-indigo-600", "bg-blue-600");

                if (link.href.includes(currentPath)) {
                    const colorClass = window.isUserOfficial ? "bg-indigo-600" : "bg-blue-600";
                    link.classList.add(colorClass);
                }
            });
        });
    </script>


    @auth

        <aside id="sidebar"
            class="w-58 {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'bg-indigo-500' : 'bg-blue-500' }} text-white px-3 pt-8 pb-4 fixed transition-width duration-300 h-full rounded-br-xl rounded-tr-xl flex-col z-50 hidden lg:flex">
            <div id="logo" class="flex items-center space-x-2 mb-6">
                <img src="{{ asset('images/kasandigan.png') }}" alt="Logo" class="w-11 h-11 bg-white rounded-full">
                <p class="text-xl font-bold sidebar-content">KASANDIGAN</p>
            </div>

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'official')
                <p class="text-3xl text-center font-semibold tracking-widest">
                    {{ auth()->user()->role == 'admin' ? 'ADMIN' : 'OFFICIAL' }}</p>
            @endif

            <nav class="h-full">
                <ul class="flex flex-col justify-between h-full">
                    <div class="space-y-8 mt-10">
                        <li>
                            <a href="{{ route('landing') }}" id="navLinkDashboard"
                                class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                title="Dashboard">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-table-2 mr-4">
                                    <path
                                        d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18" />
                                </svg>
                                <span class="sidebar-content whitespace-nowrap font-semibold">Dashboard</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('allComplaints') }}" id="navLinkDashboard"
                                class="navLink flex py-2 px-4 rounded-lg hover:bg-indigo-600 items-center"
                                title="Dashboard">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-file-icon lucide-file mr-4">
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                </svg>
                                <span class="sidebar-content whitespace-nowrap font-semibold">All Complaints</span>
                            </a>
                        </li>


                        @if (auth()->user()->role === 'official' || auth()->user()->role === 'admin')
                            <li>
                                <a href="{{ route('feedbacks') }}" id="navLinkFeedback"
                                    class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                    title="Provide Feedback">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-message-square-more mr-4">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                        <path d="M8 10h.01" />
                                        <path d="M12 10h.01" />
                                        <path d="M16 10h.01" />
                                    </svg>
                                    <span class="sidebar-content whitespace-nowrap font-semibold">Feedbacks</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->role == 'admin')
                            <li>
                                <a href="{{ route('barangayData') }}" id="navLinkBarangayData"
                                    class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                    title="Barangay Data">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user mr-4">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    <span class="sidebar-content whitespace-nowrap font-semibold">Barangay Data</span>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('profile') }}" id="navLinkProfile"
                                class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                title="Profile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-user mr-4">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                                <span class="sidebar-content whitespace-nowrap font-semibold">Profile</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('provideFeedback') }}" id="navLinkFeedback"
                                class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                title="Provide Feedback">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-message-square-share mr-4">
                                    <path d="M21 12v3a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h7" />
                                    <path d="M16 3h5v5" />
                                    <path d="m16 8 5-5" />
                                </svg>
                                <span class="sidebar-content whitespace-nowrap font-semibold">Provide Feedback</span>
                            </a>
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="post" class="mt-4">
                                @csrf
                                <button id="navLinkLogout"
                                    class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} w-full text-start items-center"
                                    title="Logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-log-out mr-4">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        <polyline points="16 17 21 12 16 7" />
                                        <line x1="21" x2="9" y1="12" y2="12" />
                                    </svg>
                                    <span class="sidebar-content whitespace-nowrap font-semibold">Logout</span>
                                </button>
                            </form>
                        </li>
                    </div>

                    <div>
                        <li class="w-full flex items-center justify-center">
                            <a href="{{ route('profile') }}"
                                class="navLinks flex-1 flex py-2 px-3 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                title="User Profile">
                                <div class="avatar flex justify-center mr-3">
                                    <div class="w-8 rounded-full">
                                        <img
                                            src="{{ auth()->user()->profilePic ? asset('storage/' . auth()->user()->profilePic) : asset('images/user-placeholder.jpg') }}" />
                                    </div>
                                </div>
                                <span
                                    class="sidebar-content whitespace-nowrap text-[13px]">&#64;{{ auth()->user()->username }}</span>
                            </a>

                            <div id="menu-toggle"
                                class="py-2 px-2 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} cursor-pointer rotate-180">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-panel-right">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="M15 3v18" />
                                </svg>
                            </div>
                        </li>
                    </div>
                </ul>
            </nav>


            <div id="menu-toggle-reverse"
                class="py-2 px-2 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} absolute bottom-17 left-6 cursor-pointer rotate-180 hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-panel-right">
                    <rect width="18" height="18" x="3" y="3" rx="2" />
                    <path d="M15 3v18" />
                </svg>
            </div>
        </aside>

        {{-- navbar --}}


    @endauth

    <main class="flex-1 @auth ml-58 @else @endauth transition-margin duration-300">

        @auth

            <div class="navbar bg-base-100 shadow-sm lg:hidden w-full flex sticky top-0 z-50">
                <!-- Navbar Start -->
                <div class="navbar-start">
                    <div class="drawer z-40">
                        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                        <div class="drawer-content flex items-center">
                            <!-- Hamburger button -->
                            <label for="my-drawer" class="btn btn-ghost btn-circle drawer-button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                            </label>

                            <a href="{{ route('landing') }}" class="cursor-pointer flex items-center">
                                <img src="{{ asset('images/kasandigan.png') }}" alt="Logo"
                                    class="w-9 h-9 sm:w-10 sm:h-10 bg-white rounded-full sm:ml-2">
                                <span class="sm:text-lg font-semibold text-neutral-800 ml-1.5">KASANDIGAN</span>
                            </a>
                        </div>

                        <div class="drawer-side">
                            <label for="my-drawer" class="drawer-overlay"></label>
                            <ul
                                class="flex flex-col min-h-full h-screen w-60 p-4  {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'bg-indigo-500' : 'bg-blue-500' }} text-white rounded-br-2xl rounded-tr-2xl">

                                <div id="logo" class="flex items-center space-x-2 mb-3 mt-1">
                                    <img src="{{ asset('images/kasandigan.png') }}" alt="Logo"
                                        class="w-11 h-11 bg-white rounded-full">
                                    <p class="text-xl font-bold sidebar-content">KASANDIGAN</p>
                                </div>

                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'official')
                                    <p class="text-xl text-center font-semibold tracking-widest">
                                        {{ auth()->user()->role == 'admin' ? 'ADMIN' : 'OFFICIAL' }}</p>
                                @endif

                                <div class="flex flex-col h-full justify-between">
                                    <div class="space-y-6 mt-6">
                                        <li>
                                            <a href="{{ route('landing') }}" id="navLinkDashboard"
                                                class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                                title="Dashboard">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-table-2 mr-4">
                                                    <path
                                                        d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 1-2-2V9m0 0h18" />
                                                </svg>
                                                <span
                                                    class="sidebar-content whitespace-nowrap font-semibold">Dashboard</span>
                                            </a>
                                        </li>

                                        @if (auth()->user()->role == 'admin')
                                            <li>
                                                <a href="{{ route('barangayData') }}" id="navLinkBarangayData"
                                                    class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                                    title="Barangay Data">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-user mr-4">
                                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                        <circle cx="12" cy="7" r="4" />
                                                    </svg>
                                                    <span class="sidebar-content whitespace-nowrap font-semibold">Barangay
                                                        Data</span>
                                                </a>
                                            </li>
                                        @endif

                                        <li>
                                            <a href="{{ route('allComplaints') }}" id="navLinkDashboard"
                                                class="navLink flex py-2 px-4 rounded-lg hover:bg-indigo-600 items-center"
                                                title="Dashboard">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-file-icon lucide-file mr-4">
                                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                                </svg>
                                                <span class="sidebar-content whitespace-nowrap font-semibold">All
                                                    Complaints</span>
                                            </a>
                                        </li>

                                        @if (auth()->user()->role === 'official' || auth()->user()->role === 'admin')
                                            <li>
                                                <a href="{{ route('feedbacks') }}" id="navLinkFeedback"
                                                    class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                                    title="Provide Feedback">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-message-square-more mr-4">
                                                        <path
                                                            d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                                        <path d="M8 10h.01" />
                                                        <path d="M12 10h.01" />
                                                        <path d="M16 10h.01" />
                                                    </svg>
                                                    <span
                                                        class="sidebar-content whitespace-nowrap font-semibold">Feedbacks</span>
                                                </a>
                                            </li>
                                        @endif

                                        <li>
                                            <a href="{{ route('profile') }}" id="navLinkProfile"
                                                class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                                title="Profile">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user mr-4">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg>
                                                <span
                                                    class="sidebar-content whitespace-nowrap font-semibold">Profile</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('provideFeedback') }}" id="navLinkFeedback"
                                                class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                                title="Provide Feedback">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-message-square-share mr-4">
                                                    <path d="M21 12v3a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h7" />
                                                    <path d="M16 3h5v5" />
                                                    <path d="m16 8 5-5" />
                                                </svg>
                                                <span class="sidebar-content whitespace-nowrap font-semibold">Provide
                                                    Feedback</span>
                                            </a>
                                        </li>

                                        <li>
                                            <form action="{{ route('logout') }}" method="post" class="mt-4">
                                                @csrf
                                                <button id="navLinkLogout"
                                                    class="navLink flex py-2 px-4 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} w-full text-start items-center"
                                                    title="Logout">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-log-out mr-4">
                                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                                        <polyline points="16 17 21 12 16 7" />
                                                        <line x1="21" x2="9" y1="12"
                                                            y2="12" />
                                                    </svg>
                                                    <span
                                                        class="sidebar-content whitespace-nowrap font-semibold">Logout</span>
                                                </button>
                                            </form>
                                        </li>
                                    </div>

                                    <div>
                                        <li class="w-full flex items-center justify-center">
                                            <a href="{{ route('profile') }}"
                                                class="navLinks flex-1 flex py-2 px-3 rounded-lg {{ auth()->user()->role == 'official' || auth()->user()->role == 'admin' ? 'hover:bg-indigo-600' : 'hover:bg-blue-600' }} items-center"
                                                title="User Profile">
                                                <div class="avatar flex justify-center mr-3">
                                                    <div class="w-8 rounded-full">
                                                        <img
                                                            src="{{ auth()->user()->profilePic ? asset('storage/' . auth()->user()->profilePic) : asset('images/user-placeholder.jpg') }}" />
                                                    </div>
                                                </div>
                                                <span
                                                    class="sidebar-content whitespace-nowrap text-[13px]">{{ auth()->user()->username }}</span>
                                            </a>
                                        </li>
                                    </div>
                                </div>

                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Navbar End -->
                <div class="navbar-end flex gap-2">
                    <a href="{{ route('profile') }}">
                        <div class="avatar flex justify-center mr-3">
                            <div class="w-9 sm:w-10 rounded-full">
                                <img
                                    src="{{ auth()->user()->profilePic ? asset('storage/' . auth()->user()->profilePic) : asset('images/user-placeholder.jpg') }}" />
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endauth

        {{ $slot }}
    </main>

</body>

</html>
