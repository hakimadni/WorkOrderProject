    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true">
            {{-- <div class="menu-item">
                <div class="menu-content pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Main Menu</span>
                </div>
            </div> --}}
            <div class="menu-item">
                <a class="menu-link" href="{{ route('dashboard') }}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                    fill="black" />
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                    fill="black" />
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>
            <div class="menu-item">
                <div class="menu-content pt-8 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Main Menu</span>
                </div>
            </div>
            @php
                $user = auth()->user();
                $currentRoute = Route::currentRouteName(); // Get current route name

                if ($user && !empty($permissions)) {
                    // Extract allowed menu IDs from session permissions
                    $permissionMenuIds = collect($permissions)->where('can_read', 1)->pluck('menu_id')->toArray();

                    // Fetch submenus directly related to permissions
                    $subMenus = \App\Models\Menu::whereIn('id', $permissionMenuIds)
                        ->whereNotNull('parent_id')
                        ->whereNotNull('showed')
                        ->get();

                    // Collect parent IDs from the submenus
                    $parentIds = $subMenus->pluck('parent_id')->toArray();

                    // Merge parent IDs with permissionMenuIds to include parent menus explicitly set in permissions
                    $menuIds = array_unique(array_merge($permissionMenuIds, $parentIds));

                    // Fetch parent menus
                    $menus = \App\Models\Menu::whereIn('id', $menuIds)
                        ->whereNull('parent_id') // Only parent menus
                        ->whereNotNull('showed')
                        ->orderBy('no_menu')
                        ->get();
                } else {
                    // User is not authenticated or no permissions available
                    $menus = collect(); // Empty parent menu collection
                    $subMenus = collect(); // Empty submenu collection
                }
            @endphp

            @foreach ($menus as $menu)
                @php
                    // Check if this menu has any submenus
                    $hasSubMenus = $subMenus->where('parent_id', $menu->id)->isNotEmpty();

                    // Determine if this menu or its submenu is active
                    $isActive = $menu->route && str_contains($currentRoute, $menu->route); // Check parent menu
                    $hasActiveSubmenu = $subMenus
                        ->where('parent_id', $menu->id)
                        ->pluck('route')
                        ->contains(function ($route) use ($currentRoute) {
                            return str_contains($currentRoute, $route);
                        });
                @endphp

                <div class="menu-item mb-1 {{ $hasSubMenus ? 'menu-accordion' : '' }} {{ !$hasSubMenus ? 'menu-item-clickable' : '' }}
        {{ $isActive || $hasActiveSubmenu ? 'active' : '' }}"
                    data-kt-menu-trigger="{{ $hasSubMenus ? 'click' : '' }}">

                    <a class="menu-link {{ $isActive ? 'active' : '' }}"
                        href="{{ $menu->route ? route($menu->route . '.index') : '#' }}">
                        <span class="menu-icon">{!! $menu->icon !!}</span>
                        <span class="menu-title">{{ $menu->name }}</span>
                        @if ($hasSubMenus)
                            <span class="menu-arrow"></span>
                        @endif
                    </a>

                    @if ($hasSubMenus)
                        <div class="menu-sub menu-sub-accordion {{ $hasActiveSubmenu ? 'show' : '' }}">
                            @foreach ($subMenus->where('parent_id', $menu->id) as $submenu)
                                @php
                                    $isSubmenuActive = $submenu->route && str_contains($currentRoute, $submenu->route);
                                @endphp
                                <div class="menu-item">
                                    <a class="menu-link {{ $isSubmenuActive ? 'active' : '' }}"
                                        href="{{ $submenu->route ? route($submenu->route . '.index') : '#' }}">
                                        <span class="menu-icon">{!! $submenu->icon !!}</span>
                                        <span class="menu-title">{{ $submenu->name }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const menuAccordions = document.querySelectorAll('.menu-accordion');

                    // Initialize accordion-style menus (for menus with submenus)
                    menuAccordions.forEach((menu) => {
                        const trigger = menu.querySelector('[data-kt-menu-trigger="click"]');
                        if (trigger) {
                            trigger.addEventListener('click', function() {
                                const submenu = menu.querySelector('.menu-sub');
                                submenu.classList.toggle('open'); // Toggle submenu visibility
                            });
                        }
                    });

                    // Add event listener for non-parent clickable menus (if needed)
                    const menuItems = document.querySelectorAll('.menu-item-clickable');
                    menuItems.forEach((item) => {
                        item.addEventListener('click', function() {
                            // Perform any action or route navigation here for non-parent menus
                            window.location.href = item.querySelector('a').href; // Example of navigation
                        });
                    });
                });
            </script>
        </div>
    </div>
    <!--end::Aside Menu-->
