<nav x-data="{ open: false }" class="bg-yellow-400 border-b-2 border-yellow-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('welcome') }}">
                    <x-application-logo  width="100" class="block h-9 w-auto fill-current text-black" />
                </a>
                <div class="hidden lg:block ml-4">
                    <x-application-title-logo  width="100" class="block h-9 w-auto fill-current text-black" />
                </div>
            </div>
            
            <!-- Navigation Links -->
            <div class="hidden space-x-8 md:block lg:block">

                <!--ダッシュボード-->
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <i class="fa-solid fa-user mr-2"></i>{{ __('Dashboard') }}
                </x-nav-link>

                <!--投稿フォーム-->
                <x-nav-link :href="route('quiz.create')" :active="request()->routeIs('quiz.create')">
                    <i class="fa-solid fa-plus mr-2"></i>{{ __('投稿を作成') }}
                </x-nav-link>

                <!--みんなの投稿-->
                <x-nav-link :href="route('quiz.index')" :active="request()->routeIs('quiz.index')">
                    <i class="fa-solid fa-clock-rotate-left mr-2"></i>{{ __('みんなの投稿') }}
                </x-nav-link>

                <!--ランキング-->
                <x-nav-link :href="route('ranking')" :active="request()->routeIs('ranking')">
                    <i class="fa-solid fa-ranking-star mr-2"></i>{{ __('ランキング') }}
                </x-nav-link>
            </div>

            <!--Header Links-->
            <div class="md:hidden lg:hidden">
                <ul class="menu menu-compact menu-horizontal bg-yellow-100 text-black rounded-box">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quiz.create') }}">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quiz.index') }}">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ranking') }}">
                            <i class="fa-solid fa-ranking-star"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <div class="avatar">
                                    <div class="w-6 rounded-full">
                                        <img src="{{ asset($my_status->icon_path) }}" />
                                    </div>
                                </div>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fa-solid fa-address-card mr-2"></i>{{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i>{{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-black hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-yellow-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-100">
        <div class="pt-2 pb-3 px-6 space-y-1">

            <!--ダッシュボード-->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="fa-solid fa-user mr-2"></i>{{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!--投稿フォーム-->
            <x-responsive-nav-link :href="route('quiz.create')" :active="request()->routeIs('quiz.create')">
                <i class="fa-solid fa-plus mr-2"></i>{{ __('投稿を作成') }}
            </x-responsive-nav-link>

            <!--みんなの投稿-->
            <x-responsive-nav-link :href="route('quiz.index')" :active="request()->routeIs('quiz.index')">
                <i class="fa-solid fa-clock-rotate-left mr-2"></i>{{ __('みんなの投稿') }}
            </x-responsive-nav-link>

            <!--ランキング-->
            <x-responsive-nav-link :href="route('ranking')" :active="request()->routeIs('ranking')">
                <i class="fa-solid fa-ranking-star mr-2"></i>{{ __('ランキング') }}
            </x-responsive-nav-link>
        </div>

        <div class="border border-gray-400 rounded mx-6"></div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 px-6">
            <div class="px-2 flex items-center gap-2">
                <div class="avatar">
                    <div class="w-10 rounded-full">
                        <img src="{{ asset($my_status->icon_path) }}" />
                    </div>
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fa-solid fa-address-card mr-2"></i>{{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>{{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
