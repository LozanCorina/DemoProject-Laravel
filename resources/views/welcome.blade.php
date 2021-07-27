@extends('layouts.header')

@section('content')      
<!-- ========================= SECTION INTRO ========================= -->
<section id="intro" class="intro bg-secondary pt-2">
	<div class="col-xl-9 ">
				<div class="m-3">
					<h2 class="text-white display-3"> Manage your business with one click </h2>		
				</div>	
				<div class="float-right">	
					<img src="{{asset('front_assets/images/img1.png')}}" class="img-fluid mx-auto" style="width:750px;"/>
				</div>										
	</div> <!-- container .//  --> 
	</section>
<!-- ========================= SECTION INTRO END// ========================= -->   
<section class="section-content bg-succes padding-y">
		<div class="container">	
		<div class="row">
			<main class="col-lg-10 col-sm-3 col-md-4 col-xl-10">		
		<header class="section-heading">
			<h2 style="font-family: 'Forte' ">Security and anonymity</h2>
		</header><!-- sect-heading -->
		
			<article style="box-sizing: border-box; ">
				<div class="row">
					<div>
						<h4>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="" readonly>
								<label class="form-check-label" for="flexCheckChecked">
								We use 256-bit SSL encryption - the latest security standard used by international corporations and banks.
								</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
								<label class="form-check-label" for="flexCheckChecked">
								The service works in the cloud,
									no data is stored on your computer (you cannot simply copy it or infect it with a virus).
								</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="" readonly>
								<label class="form-check-label" for="flexCheckChecked">
									We do not require you to enter official company data.
								</label>
						</div>
					</div>						
					</h4>

				<div class="float-right" >
					<img class="mx-auto img-fluid float-right" src="{{asset('front_assets/images/img2.png')}}" alt="PC">
				</div>
			</div>
			</article>
			</main> <!-- col.// -->								
		</div>
		
		</div> <!-- container .//  -->
		</section>
	
	<!-- ========================= SECTION CONTENT END// ========================= -->
<br>
	<div class="d-flex justify-content-center">
		<div class="col-md-3 mb15">			
					<div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
						<div class="card-header">Header</div>
						<div class="card-body">
							<h4 class="card-title">Secondary card title</h4>
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						</div>
					</div>	
		</div><!-- col // -->
		<div class="col-md-3 mb15">		
					<div class="card bg-secondary mb-3" style="max-width: 20rem;">
							<div class="card-header">Header</div>
								<div class="card-body">
									<h4 class="card-title">Primary card title</h4>
									<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								</div>
							</div>
					</div>	
		</div><!-- col // -->
	</div>
<br>
		
<!-- ========================= SECTION PRE-CONTENT END// ========================= -->
     
@endsection
