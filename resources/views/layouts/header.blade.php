<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<head>
<title>Unisim-Soft</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('front_assets/images/icon1')}}">

<!-- jQuery -->
<script src="{{asset('front_assets/js/jquery-2.0.0.min.js')}}" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="{{ asset('front_assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<link href="{{asset('front_assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="{{asset('front_assets/fonts/fontawesome/css/fontawesome-all.min.css')}}" type="text/css" rel="stylesheet">

<!-- plugin: fancybox  -->
<script src="{{asset('front_assets/plugins/fancybox/fancybox.min.js')}}" type="text/javascript"></script>
<link href="{{asset('front_assetsplugins/fancybox/fancybox.min.css')}}" type="text/css" rel="stylesheet">

<!-- plugin: slickslider -->
<link href="{{asset('front_assets/plugins/slickslider/slick.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('front_assets/plugins/slickslider/slick-theme.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('front_assets/plugins/slickslider/slick.min.js')}}"></script>

<!-- custom style -->
<link href="{{asset('front_assets./css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front_assets/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

<!-- custom javascript -->
<script src="{{asset('front_assets/js/script.js')}}" type="text/javascript"></script>

<!-- our styles -->
<link href="{{asset('front_assets/css/styles.css')}}" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    /// some script
    // jquery ready start
    $(document).ready(function() {
	// jQuery code
}); 
// jquery end
</script>
</head>
<body>
	<header class="section-header">
	<nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
	<div class="container">
	<div class="row" style="width:100%;">
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav d-flex justify-content-left align-items-center py-1">
						<li class="nav-item active">
						<a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="pages/despre_noi.html"> About us </a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">  Data </a>

							<ul class="dropdown-menu">
								<li><a class="dropdown-item text-primary" href="{{route('projects')}}"> Projects</a></li>
								<li><a class="dropdown-item text-primary" href="{{route('tasks')}}"> Tasks </a></li>
								<li><a class="dropdown-item text-primary" href="{{route('team')}}"> Team members </a></li>
								<li><a class="dropdown-item text-primary" href="{{route('milestones')}}"> Milestones </a></li>
							</ul>
						</li>	
						<li class="nav-item">
						<a  class="nav-link" href="{{route('crud')}}" class="btn btn-primary btn-block"> CRUD </a>
						</li>	
						<li class="nav-item">
						<a  class="nav-link" href="{{route('calendar')}}" class="btn btn-primary btn-block"> Calendar </a>
						</li>	
						<li class="nav-item">
						<a  class="nav-link" href="{{'\calendar'}}" class="btn btn-primary btn-block"> Calendar Demo Data </a>
						</li>	
						<li class="nav-item">
						<a  class="nav-link" href="{{'\chart'}}" class="btn btn-primary btn-block"> Chart </a>
						</li>				
					</ul>
				</div>
			
			</div>
            </div>
        </div>
    </nav>
    <section class="header-main bg-light">
	<div class="container">
<div class="row align-items-center">
	<div class="col-md-4">
	<div class="brand-wrap">
		<img  src="{{asset('front_assets/images/icon1.png')}}" style=" border-radius: 50%; height: 70px;">
		<h2 class="logo-text font-weight-bold text-secondary">Uni Soft</h2>
	</div> <!-- brand-wrap.// -->
	</div>
	<div class="col-md-4">

	</div> <!-- col.// -->
	<div class="col-md-4">
			<form action="#" class="widget-header float-right">
				<div class="input-group">
				    <input type="text" class="form-control" placeholder="Search">
				    <div class="input-group-append">
				      <button class="btn btn-primary" type="submit">
				        <i class="fa fa-search"></i>
				      </button>
				    </div>
			    </div>
			</form> <!-- search-wrap .end// -->
	</div> <!-- col.// -->

</div> <!-- row.// -->
	</div> <!-- container.// -->
</section> <!-- header-main .// -->
</header> <!-- section-header.// -->

@yield('content')
<!-- ========================= FOOTER ========================= -->
<footer class="section-footer bg-primary">
	<div class="container">
		<section class="footer-top padding-top">
			<div class="row">
				<aside class=" col-xl-3 col-lg-3col-sm-12 col-sm-6 white">
					<h5 class="title">Serviciu Clien&#539;i</h5>
					<ul class="list-unstyled">
						<li> <a href="#">Centru de ajutor</a></li>
						<li> <a href="pages/returnare.html">Returnarea Banilor</a></li>
						<li> <a href="pages/termeni.html">Termeni &#351;i Politica</a></li>
						<li> <a href="#">Deschide o contesta&#539;ie</a></li>
					</ul>
				</aside>
				<aside class="col-sm-3  col-md-3 white">
					<h5 class="title">Contul meu</h5>
					<ul class="list-unstyled">
						<li> <a href="pages/signin.html"> Logare client </a></li>
						<li> <a href="pages/registration.html"> &#206;nregistrare </a></li>
						<li> <a href="#"> Set&#259;rile contului </a></li>
						<li> <a href="pages/cart.html"> Comenzile mele</a></li>
						<li> <a href="pages/favorite.html"> Lista de dorin&#539;e </a></li>
					</ul>
				</aside>
				<aside class="col-sm-3  col-md-3 white">
					<h5 class="title">Isert Data</h5>
					<ul class="list-unstyled">
						<li> <a href="{{route('insert')}}"> Insert tasks for Project#1 </a></li>
						<li>  <a href="{{route('insertPrj2')}}"> Insert data for Project#2 (milestones and tasks)</a></li>
					</ul>
				</aside>
				<aside class="col-sm-3">
					<article class="white">
						<h5 class="title">Contacte</h5>
						<p>
							<strong>Telefon: </strong> +123456789 <br> 
						    <strong>Fax:</strong> +123456789
						</p>

						 <div class="btn-group white">
						    <a class="btn btn-facebook" title="Facebook" target="_blank" href="#"><i class="fab fa-facebook-f  fa-fw"></i></a>
						    <a class="btn btn-instagram" title="Instagram" target="_blank" href="#"><i class="fab fa-instagram  fa-fw"></i></a>
						    <a class="btn btn-youtube" title="Youtube" target="_blank" href="#"><i class="fab fa-youtube  fa-fw"></i></a>
						    <a class="btn btn-twitter" title="Twitter" target="_blank" href="#"><i class="fab fa-twitter  fa-fw"></i></a>
						</div>
					</article>
				</aside>
			</div> <!-- row.// -->
			<br> 
		</section>
		<section class="footer-bottom row border-top-white">
			<div class="col-sm-6"> 				
			</div>
			<div class="col-sm-6">
				<p class="text-md-right text-white-50">
	Copyright &copy  <br>
<a href="http://unisim-soft.una.md" class="text-white-50">Unisim-Soft societate comercial&#259;</a>
				</p>
			</div>
		</section> <!-- //footer-top -->
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->
</body>
</html>
