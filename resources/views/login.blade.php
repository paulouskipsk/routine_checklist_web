<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:th="http://www.thymeleaf.org">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="msapplication-TileImage" content="{{ asset('vendors/template/assets/img/favicons/mstile-150x150.png') }}">
	<meta name="theme-color" content="#ffffff">

	<title>Routine Checklist</title>

	<!-- Favicons -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicons/favicon.ico') }}">

	<!-- Stylesheets -->
	@includeIf('layouts._head')	
	<link rel="stylesheet" href="{{ asset('css/loginPage.css') }}" type="text/css">

</head>

<body>
	<main>
		@includeIf('utils.alert-message')
		<div class="header">
			<!--Waves Container-->
			<div>
				<svg
					class="waves"
					xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink"
					viewBox="0 24 150 28"
					preserveAspectRatio="none"
					shape-rendering="auto"
				>
					<defs>
						<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
					</defs>
					<g class="parallax">
						<use
							xlink:href="#gentle-wave"
							x="30"
							y="0"
							fill="rgba(255,255,255,0.7"
						/>
						<use
							xlink:href="#gentle-wave"
							x="30"
							y="3"
							fill="rgba(255,255,255,0.5)"
						/>
						<use
							xlink:href="#gentle-wave"
							x="30"
							y="5"
							fill="rgba(255,255,255,0.3)"
						/>
						<use
							xlink:href="#gentle-wave"
							x="30"
							y="7"
							fill="#fff"
						/>
					</g>
				</svg>
			</div>
			<!--Waves end-->
		</div>
	
		<div class="container">	
			<div class="text-center mb-5" id="logo-img">
				<img src="{{ asset('images/logo1.png') }}"/>
			</div>
	
			<form action="authenticate" method="post" role="form">
				@csrf

				<div class="row mt-5">
					<label class="col-1 col-form-label mt-3">
						<span class="fas fa-user text-danger fs-icon"></span>
					</label>

					<div class="col-11 mt-3">
						<input type="login" name="login" placeholder="Login" class="form-control border-0 fs-0 @error('login') is-invalid @enderror border-input" id="inputLogin" required>
						@error('login')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
				</div>
				
				<div class="row mt-4">
					<label for="inputPassword" class="col-1 col-form-label mt-3">
						<span class="fas fa-lock text-danger fs-icon"></span>
					</label>

					<div class="col-11">
						<a href="#" class="text-danger position-relative top-50 start-100 mb-2 cursor-pointer" id="linkEyePassword">
							<span class="fa-solid fa-eye-slash" id="iconEyePassword"></span>
						</a>
						<input type="password" name="password" placeholder="Senha" class="form-control border-0 fs-0 @error('password') is-invalid @enderror border-input" id="inputPassword">
						@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
					</div>
				</div>
				
				<div class="row mt-5">
					<div class="col-12 text-center">
						<button type="submit" class="btn btn-danger rounded-pill w-70 mt-5 mb-1 ml-3 text-center" id="btnSubmit">
							<span class="fas fa-check-double mx-2"></span>
							ENTRAR
						</button>
					</div>
				</div>
			</form>

			<div class="version">
				Versão 1.0.0
			</div>
	
			<div class="header inverted">
				<!--Waves Container-->
				<div>
					<svg
						class="waves"
						xmlns="http://www.w3.org/2000/svg"
						xmlns:xlink="http://www.w3.org/1999/xlink"
						viewBox="0 24 150 28"
						preserveAspectRatio="none"
						shape-rendering="auto"
					>
						<defs>
							<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
						</defs>
						<g class="parallax">
							<use
								xlink:href="#gentle-wave"
								x="30"
								y="0"
								fill="rgba(255,255,255,0.7"
							/>
							<use
								xlink:href="#gentle-wave"
								x="30"
								y="3"
								fill="rgba(255,255,255,0.5)"
							/>
							<use
								xlink:href="#gentle-wave"
								x="30"
								y="5"
								fill="rgba(255,255,255,0.3)"
							/>
							<use
								xlink:href="#gentle-wave"
								x="30"
								y="7"
								fill="#fff"
							/>
						</g>
					</svg>
				</div>
				<!--Waves end-->
			</div>
		</div>
	
	</main>

	@includeIf('layouts._js')
	<script type="text/javascript">
		(document.getElementById("linkEyePassword")).addEventListener("click", (event) => {
			event.preventDefault();
			const inputPassword = document.getElementById("inputPassword");
			const iconEyePassword = document.getElementById("iconEyePassword");

			if(inputPassword.getAttribute('type') === 'password'){
				inputPassword.setAttribute('type', 'text');
				iconEyePassword.classList.remove('fa-solid', 'fa-eye-slash');
				iconEyePassword.classList.add('fas', 'fa-eye');
			}else{
				inputPassword.setAttribute('type', 'password');
				iconEyePassword.classList.remove('fas', 'fa-eye');
				iconEyePassword.classList.add('fa-solid', 'fa-eye-slash');
			}
		});

		(document.getElementById("inputLogin")).addEventListener("keydown", (event) => {
			if (event.key === 'Tab' || event.key === 'Enter') {
				event.preventDefault();
				document.getElementById("inputPassword").focus();
			}
		});		
	</script>
</body>
</html>


