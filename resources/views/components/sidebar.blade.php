<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('dashboard') }}">
            <h1 class="text-white w-bold">REIMBURSEMENT</h1>
        </a>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2"
                                        fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                        rx="2" fill="currentColor" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                @hasanyrole('Direktur')
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->is(['users*', 'role*']) ? 'show' : '' }}">
                        <span class="menu-link {{ request()->is(['users*', 'role*'])}}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="8" y="3" width="8"
                                            height="8" rx="4" fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">User Management</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('user.*') ? 'active' : '' }}"
                                    href="{{ route('user.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">User</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endhasanyrole
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('sreimbursement*') ? 'active' : '' }}"
                        href="{{ route('reimbursement.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
                                    <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
                                    <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
                                    </svg>
                            </span>
                        </span>
                        <span class="menu-title"> Reimbursement</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click">
                <span class="btn-label">Logout</span>
                <span class="svg-icon btn-icon svg-icon-2 m-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M20 12h-9.5m7.5 3l3-3l-3-3m-5-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5a2 2 0 0 0 2-2v-1" />
                    </svg>
                </span>
            </a>
        </form>
    </div>
</div>
