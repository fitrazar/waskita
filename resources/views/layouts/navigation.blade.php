<div class="w-64 bg-primary-red shadow-lg text-white lg:block hidden">
    <!-- Logo and Name -->
    <div class="p-6 text-white flex items-center space-x-4">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full">
        <div>
            <h1 class="text-xl font-bold">Waskita AIDS</h1>
            <span class="text-sm">Online Campaign</span>
        </div>
    </div>

    <!-- Menu Items -->
    <ul class="menu p-4 w-full space-y-5 text-base">
        <li class="mb-2">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-white hover:text-primary-yellow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M13 5v6m0 0h6m-6 0l7 7m0 0l-7 7-7-7m7-7H5" />
                </svg>
                <span>Dashboard</span>
            </a>
        </li>
        @auth
            <li class="mb-2">
                <a href="{{ route('admin.material.index') }}"
                    class="flex items-center space-x-2 text-white hover:text-primary-yellow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3M4 4h16v16H4z" />
                    </svg>
                    <span>Materi</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.quiz.index') }}"
                    class="flex items-center space-x-2 text-white hover:text-primary-yellow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3h14M12 12v6m0-6v-6m0 0H7m5 0h5" />
                    </svg>
                    <span>Quiz</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.video.index') }}"
                    class="flex items-center space-x-2 text-white hover:text-primary-yellow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.55 2.27M9 10L4.45 7.73M9 10l6 3v6M9 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4v2h6V5h4a2 2 0 012 2v12a2 2 0 01-2 2h-4v-6l-6-3z" />
                    </svg>
                    <span>Video Edukasi</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('admin.contact.index') }}"
                    class="flex items-center space-x-2 text-white hover:text-primary-yellow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 8h20M2 12h20M2 16h20" />
                    </svg>
                    <span>Kontak</span>
                </a>
            </li>
        @else
        @endauth


    </ul>
</div>

<div class="btm-nav lg:hidden shadow-sm z-10 bg-primary-red text-white">
    <a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-house" class="h-5 w-5"></i>
        <span class="btm-nav-label text-xs">Dashboard</span>
    </a>
</div>
