@if (Session::has('flash-info-msg'))
<div class="alert alert-soft-info d-flex border border-info position-absolute top-0 w-100 index-max" role="alert">
    <span class="fas fa-check-circle text-info fs-3 me-3"></span>
    <p class="mb-0 flex-1">{{ Session::get('flash-info-msg') }}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('flash-warning-msg'))
<div class="alert alert-soft-warning d-flex border border-warning position-absolute top-0 w-100 index-max" role="alert">
    <span class="fas fa-check-circle text-warning fs-3 me-3"></span>
    <p class="mb-0 flex-1">{{ Session::get('flash-warning-msg') }}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('flash-error-msg'))
<div class="alert alert-soft-danger d-flex border border-danger position-absolute top-0 w-100 index-max" role="alert">
    <span class="fas fa-check-circle text-danger fs-3 me-3"></span>
    <p class="mb-0 flex-1">{{ Session::get('flash-error-msg') }}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('flash-success-msg'))
<div class="alert alert-soft-success d-flex border border-success position-absolute top-0 w-100 index-max" role="alert">
    <span class="fas fa-check-circle text-success fs-3 me-3"></span>
    <p class="mb-0 flex-1">{{ Session::get('flash-success-msg') }}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif