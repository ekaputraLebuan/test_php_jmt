<div id="kt_aside" class="aside py-9" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <div class="aside-logo flex-column-auto px-9 mb-9" id="kt_aside_logo">
        <a href="/">
            <img alt="Logo" src="{{ asset('template/media/logos/logo.png') }}" class="h-30px logo" />
        </a>
    </div>
    <div class="aside-menu flex-column-fluid ps-5 pe-3 mb-9" id="kt_aside_menu">
        <div class="w-100 hover-scroll-overlay-y d-flex pe-2" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu, #kt_aside_menu_wrapper" data-kt-scroll-offset="100">
            <div class="menu menu-column menu-rounded fw-bold my-auto" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link @if ($name == 'Dashboard') active @endif" href="/">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                                    <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                @can('pendaftaran')
                    <div class="menu-item">
                        <a class="menu-link @if ($name == 'Pasien') active @endif" href="/pasien">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                                        <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Data Pasien</span>
                        </a>
                    </div>
                @endcan
                

                <div class="menu-item">
                    <a class="menu-link @if ($name == 'Kunjungan' || $name == 'Detail Kunjungan') active @endif" href="/kunjungan-pasien">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                                    <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
                                </svg>
                            </span>
                        </span>
                        @can('pendaftaran')<span class="menu-title">Kunjungan Pasien</span>@endcan
                        @can('noregistrasi')<span class="menu-title">Daftar Pasien</span>@endcan
                    </a>
                </div>
                
                

                <div class="menu-item">
                    <a class="menu-link @if ($name == 'Obat') active @endif" href="/obat">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
                                    <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Data Obat</span>
                    </a>
                </div>
                
                
            </div>
        </div>
    </div>
    <div class="aside-footer flex-column-auto px-9" id="kt_aside_footer">
        <div class="d-flex flex-stack">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-circle symbol-40px">
                    <img src="{{ asset('template/media/avatars/150-26.jpg') }}" alt="photo" />
                </div>
                <div class="ms-2">
                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder lh-1">{{ Auth()->user()->nama }}</a>
                    <span class="text-muted fw-bold d-block fs-7 lh-1">{{ Auth()->user()->level->level }}</span>
                </div>
            </div>
            <div class="ms-1">
                <a href="/logout" class="btn btn-sm btn-icon btn-active-color-primary position-relative me-n2">
                    <i class="fas fa-power-off"></i>
                </a>
                
            </div>
        </div>
    </div>
</div>