<!DOCTYPE html>
<html lang="en">
<!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-select.min.css') }}">   
<head>
	<meta charset="UTF-8">
	<title>@yield('title') - SisVentas</title>
	<style>
		img{
			width: 35%;
		}
		h2, h4{
			text-align: : center;
		}
		table{
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
			font-size: 12px;
			
		}
		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 3px;
		}		
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-6">
				<img src="{{ url('/assets/img/ferrevive.png') }}" alt="FERREVIVE C.A.">
			</div>
			<div class="col-6">
				<h4 style="text-align: right;">Fecha: {{ date('d/m/Y') }}</h4> 
			</div>

			<div class="col-12">

				@yield('content')
					
			</div>		
		</div>
	</div>
	<!-- jQuery 2.1.4 -->
	<script src="{{ asset('/assets/js/jQuery-2.1.4.min.js') }}"></script>
	<!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-select.min.js') }}"></script>
</body>
</html>