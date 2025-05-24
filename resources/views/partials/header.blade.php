<div id="kt_header" class="header">
    <div class="container d-flex align-items-center justify-content-between" id="kt_header_container">
        <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-5 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
            
            
            @if($name == 'Dashboard')
                <h1 class="d-flex flex-column text-dark fw-bolder my-0 fs-1">
                    {{ $pageTitle }}
                    <small class="text-muted fs-6 fw-bold ms-1 pt-1">{{ $pageSubTitle }}</small>
                </h1>
            @else 
            <h1 class="d-flex flex-column text-dark fw-bolder my-0 fs-1">{{ $pageTitle }}</h1>
            <ul class="breadcrumb breadcrumb-dot fw-bold fs-base my-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/" class="text-muted text-hover-primary">
                        <i class="bi bi-grid-fill"></i>
                    </a>
                </li>
                <li class="breadcrumb-item text-muted">{{ $name }}</li>
                <li class="breadcrumb-item text-dark">{{ $pageSubTitle }}</li>
            </ul>
            @endif
            
        </div>
        <div class="d-flex d-lg-none align-items-center ms-n2 me-2">
            <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
                <span class="svg-icon svg-icon-1 mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                    </svg>
                </span>
            </div>
            <a href="/" class="d-flex align-items-center">
                <img alt="Logo" src="{{ asset('template/media/logos/logo.png') }}" class="h-20px" />
            </a>
        </div>
        
    </div>
</div>