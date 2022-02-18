 {{-- برای نمایش پیغامها با اسویت الرت از جی کویری استفاده میشه
    1
     --}}
@if (session('swal-error'))

$(document).ready(function(){
    swal.fire({
        'title':'خطا !',
        'icon':'error',
        'text':'{{ session('swal-error') }}',
        confirmButtonText:'باشه',

    });
});

@endif
