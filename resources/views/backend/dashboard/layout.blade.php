<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<head>
	<base href="{{config('app.url')}}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<title>Admin Panel - Real Estate</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('public/backend/assets/vendors/core/core.css')}}">
	<!-- endinject -->
	<link rel="stylesheet" href="{{asset('public/backend/assets/vendors/sweetalert2/sweetalert2.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css')}}">
	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{asset('public/backend/assets/vendors/flatpickr/flatpickr.min.css')}}">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('public/backend/assets/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->
	<link rel="stylesheet" href="{{asset('public/backend/assets/vendors/select2/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/assets/vendors/dropzone/dropzone.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/assets/vendors/dropify/dist/dropify.min.css')}}">
  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{asset('public/backend/assets/css/switchery/switchery.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/assets/css/demo1/style.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/assets/css/demo1/customize.css')}}">
	<link rel="stylesheet" href="{{asset('public/backend/assets/plugin/jquery-ui.css')}}">

	<link rel="stylesheet" href="{{asset('public/backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css')}}">

	<link rel="stylesheet" href="{{asset('public/backend/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
  
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{asset('public/backend/assets/images/favicon.png')}}" />
  <script>
	var BASE_URL = '{{ config('app.url')}}'
	var SUFFIX = '{{ config('apps.general.suffix')}}'
  </script>
</head>
<body>
	<div class="main-wrapper">

		<!-- partial:partials/_sidebar.html -->
		@include('backend.dashboard.component.sidebar')
    
		<!-- partial -->
	
		<div class="page-wrapper">
					
			<!-- partial:partials/_navbar.html -->
			@include('backend.dashboard.component.header')
			<!-- partial -->

		@yield('backend')

			<!-- partial:partials/_footer.html -->
			@include('backend.dashboard.component.footer')
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	@include('backend.dashboard.component.script')
	

</body>
</html>    