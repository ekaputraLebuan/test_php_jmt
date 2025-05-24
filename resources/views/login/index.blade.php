<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
        <base href="{{ URL::to('/') }}" />
        <title>{{ $title }} | {{ env("APP_NAME") }} </title>
        <meta charset="utf-8" />
        <meta name="description" content="{{ env('APP_DESC') }}" />
        <meta name="keywords" content="{{ env('APP_DESC') }}, {{ env('APP_NAME') }}, Webiste, Website Rumah Sakit, Kupang, Kota Kupang, NTT, Nusa Tenggara Timur" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="{{ env('APP_TITLE') }}" />
        <meta property="og:url" content="{{ env('APP_URL') }}" />
        <meta property="og:site_name" content="{{ env('APP_TITLE') }}" />
        <link rel="canonical" href="{{ env('APP_URL') }}" />
        <link rel="shortcut icon" href="{{ asset('template/media/logos/icon.png') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link href="{{ asset('template/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ asset('template/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template/css/resetstyle.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="bg-body">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #F2C98A">
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<p class="fw-bold fs-2" style="color: #986923;">Discover Amazing Bussiness
							<br />with great build tools</p>
						</div>
						<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" 
                        style="background-image: url({{ asset('template/media/illustrations/login.png') }}"></div>
					</div>
				</div>
				
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<div class="d-flex flex-center flex-column flex-column-fluid">
							
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post" action="/login/authenticate">
								@csrf
                                <div class="text-left mb-10">
                                    <h1 class="fw-bolder fs-2qx text-dark">Welcome to Klinik.</h1>
									<p class="text-dark mb-3">Please enter your detail </p>
								</div>
								<div class="fv-row mb-10">
									<label for="username" class="form-label fs-7 fw-bolder text-dark">Username</label>
									<input id="username" class="form-control form-control-solid @error('username') is-invalid @enderror" type="text" name="username" autocomplete="off" 
									/>
									@error('username')
										<div class="fv-plugins-message-container invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="fv-row mb-10">
									<label for="password" class="form-label fw-bolder text-dark fs-7">Password</label>
									<input id="password" class="form-control form-control-solid @error('password') is-invalid @enderror" type="password" name="password" autocomplete="off" />
									@error('password')
										<div class="fv-plugins-message-container invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-primary w-100 mb-5">
										<span class="indicator-label">Login</span>
									</button>
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		<script>var hostUrl = "{{ asset('template/') }}";</script>
        <script src="{{ asset('template/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('template/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('template/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
		@if(session()->has("success"))
			<script>toastr.success("{{ session()->get("success") }}");</script>
		@endif

		@if(session()->has("danger"))
			<script>
				toastr.error("{{ session()->get("danger") }}");
			</script>
		@endif

		@if(session()->has("errors"))
			@foreach ($errors->all() as $error)
				<script>
					toastr.error("{{ $error }}");
				</script>
			@endforeach
		@endif
	</body>
</html>