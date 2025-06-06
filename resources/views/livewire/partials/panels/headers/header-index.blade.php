<div>
    <!--  Header Start -->
    <header
        class="left-0 bg-[var(--bg-1)] backdrop-blur-sm md:pl-[300px] border-b-[1px]  content-transition fixed z-20  full-container w-full  text-sm "
        x-bind:class="{ 'content-full-header': sidebarHidden }">
        <div class="container py-3 w-full">

            <!-- ========== HEADER ========== -->

            <nav class="flex justify-between items-center w-full" aria-label="Global">
                <ul class="flex gap-4 items-center icon-nav">
                    <li class="relative text-2xl">
                        <button @click="sidebarHidden = !sidebarHidden"
                            class="text-gray-600 focus:outline-none dark:text-gray-400" aria-label="Toggle Sidebar">
                            <i class="ti"
                                :class="sidebarHidden ? 'ti-layout-sidebar-left-expand' : 'ti-layout-sidebar-right-expand'"></i>
                        </button>
                    </li>
                    <li class="relative">
                        <div class=" relative inline-flex " x-on:click="$slideOpen('notification-area')">
                            <div
                                class="inline-flex relative text-gray-600 dark:text-gray-400  icon-hover dark:text-accentDark-4">
                                <i class="ti ti-bell-ringing text-xl md:text-2xl relative z-[1]"></i>
                                @if ($this->countNotification > 0)
                                    <div
                                        class="absolute inline-flex items-center justify-center  text-white text-[11px] font-medium  bg-blue-600 w-2 h-2 rounded-full -top-[1px] -right-[6px]">
                                    </div>
                                @endif
                            </div>
                            <div class="bg-white  transition-[opacity,margin] border border-border-1 rounded-md duration opacity-0 mt-2 min-w-max   w-[400px] hidden z-[12] relative"
                                aria-labelledby="">
                                <div>
                                    <h3 class="px-6 py-3 text-base font-semibold text-gray-600">Notifikasi
                                    </h3>

                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="relative text-2xl">
                        <button x-on:click="darkTheme = !darkTheme"
                            class="text-gray-600 focus:outline-none dark:text-gray-400" aria-label="Toggle Sidebar">
                            <i class="ti" x-bind:class="{ 'ti-sun': darkTheme, 'ti-moon-stars': !darkTheme }"></i>
                        </button>
                    </li>
                </ul>
                <div class="flex gap-4 items-center sm:gap-8">
                    <livewire:partials.panels.headers.user-menu />
                </div>
            </nav>

            <!-- ========== END HEADER ========== -->
        </div>
    </header>
    <!--  Header End -->
    <livewire:partials.panels.headers.notification />
</div>
