<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>SEKRE Management | Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN core-css ================== -->
	<link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
</head>
<body class='pace-top'>
	<!-- BEGIN page-cover -->
	<div class="app-cover"></div>
	<!-- END page-cover -->
	
	<!-- BEGIN #loader -->
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>
	<!-- END #loader -->

	<!-- BEGIN #app -->
	<div id="app" class="app">
		<!-- BEGIN login -->
		<div class="login login-with-news-feed">
			<!-- BEGIN news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url('{{ asset("/assets/img/login-bg/login-bg-19.jpg")}}')"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>SEKRE Management</b></h4>
					<p>
						Sistem Management Sektor Kreatif
					</p>
				</div>
			</div>
			<!-- END news-feed -->
			
			<!-- BEGIN login-container -->
			<div class="login-container" style="background-color:#00000;">
				<!-- BEGIN login-header -->
				<div class="login-header mb-30px">
					<div class="brand">
						<div class="d-flex align-items-center mb-2">
							<img src="" class="img-fluid" style="margin-right:10px" width="50%" alt="">
						</div>
						<small>SEKRE Management</small>
					</div>
				</div>
				<!-- END login-header -->
				
				<!-- BEGIN login-content -->
				<div class="login-content">
                     @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-warning">
                                {{ session('error') }}
                            </div>
                        @endif
					<form  class="fs-13px"  method="POST" action="{{url('proses_login')}}">
                        @csrf
						<div class="mb-15px">
							<input type="text" class="form-control h-45px fs-13px" placeholder="Username" id="username" name="username"/>
							
						</div>
						<div class="mb-15px">
							<input type="password" class="form-control h-45px fs-13px" placeholder="Password" id="password" name="password" />
							
						</div>
						
						<div class="mb-15px">
							<button type="submit" class="btn btn-primary d-block h-45px w-100 btn-lg fs-14px">Sign me in</button>
						</div>
						
						
						<div class="text-center">
							&copy; Developed by Sektor Digital 2024
						</div>
					</form>
				</div>
				<!-- END login-content -->
			</div>
			<!-- END login-container -->
		</div>
		<!-- END theme-panel -->
		<!-- BEGIN scroll-top-btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
		<!-- END scroll-top-btn -->
	</div>
	<!-- END #app -->
	
	<!-- ================== BEGIN core-js ================== -->
	<script src="{{ asset('assets/js/vendor.min.js')}}"></script>
	<script src="{{ asset('assets/js/app.min.js')}}"></script>
	<!-- ================== END core-js ================== -->
</body>
</html>