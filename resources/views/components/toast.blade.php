@if($errors->count() > 0)
<div class="toast show border-danger" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <i class="bi bi-exclamation-octagon-fill me-1"></i>
        <strong class="me-auto">Błąd</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        @foreach($errors->all() as $error)
             <p>{{ $error }}</p>
        @endforeach
    </div>
</div>
@endif

@if(session()->has('success'))
    <div class="toast show border-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bi bi-check-circle-fill me-1"></i>
            <strong class="me-auto">Sukces</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
           <p>{{ session()->get('success') }}</p>
        </div>
    </div>
@endif

