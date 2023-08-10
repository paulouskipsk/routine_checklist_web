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
	<link rel="stylesheet" href="{{ asset('vendors/template/assets/css/theme.min.css') }}" type="text/css"  id="style-default">
	
	<!-- Scripts -->
	<script src="{{ asset('vendors/template/vendors/fontawesome/all.min.js') }}"></script>

    <script src="{{ asset('vendors/sweetAlert/sweetalert2.all.min.js') }}"></script>

    <style>
        .input-group-text, .input-group-text, .form-control, .form-control-sm {
            border-radius: 0px !important;
        }
    </style>
</head>

<body>
    @includeIf('utils.flash-message')
	<main>
		<div class="container-fluid px-0">
			<div class="container-fluid">
				<div class="bg-holder bg-auth-card-overlay" style="background-image: url('../vendors/template/assets/img/bg/37.png');">
				</div>

				<div class="row flex-center position-relative min-vh-100 g-0 py-5">
					<div class="col-11 col-md-8 col-xl-5">
						<div class="card border border-300 auth-card">
							<div class="card-body pe-md-0">
								<div class="row align-items-center gx-0 gy-7">									
									
									<div class="col mx-auto">
										<div class="auth-form-box">
											<div class="text-center mb-7">
												<a class="d-flex flex-center text-decoration-none mb-4"
													href="#">
													<div class="d-flex align-items-center fw-bolder fs-5 d-inline-block">
														<img src="{{ asset('images/logo.png') }}" alt="phoenix" width="58" />
													</div>
												</a>
												<h3 class="text-1000">Routine Checklist</h3>
												<p class="text-700">Transformando Rotinas com Controle e Auditoria!</p>
											</div>

                                            <form action="authenticate" method="post" role="form">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="login">Usuario<span class="text-danger">*</span></label> 
                                                    <div class="input-group is-invalid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <span class="fas fa-user mt-1 mb-1"></span>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" required>
                                                    </div>
                                                    @error('login')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>

                                                
                                                <div class="mb-3">
                                                    <label for="password">Senha<span class="text-danger">*</span></label> 
                                                    <div class="input-group is-invalid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <span class="fas fa-user mt-1 mb-1"></span>
                                                            </span>
                                                        </div>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                                    </div>
                                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>

                                                <div class="row flex-between-center mt-2 mb-7">
                                                    <div class="col-auto">
                                                        <div class="form-check mb-0">
                                                            <input class="form-check-input" id="basic-checkbox" type="checkbox" checked="checked" />
                                                            <label class="form-check-label mb-0" for="basic-checkbox">Lembrar-me</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- <div class="col-auto">
                                                        <a class="fs--1 fw-semi-bold" href="{{ asset('vendors/template/pages/authentication/card/forgot-password.html') }}">
                                                            Esqueceu a Senha?
                                                        </a>
                                                    </div> -->
                                                </div>
                                                
                                                <button type="submit" class="btn btn-primary w-100 mt-1 mb-4">Entrar</button>
                                            </form>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>
</html>


