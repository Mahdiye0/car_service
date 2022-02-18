 {{-- برای نمایش پیغامها با اسویت الرت از جی کویری استفاده میشه
    1
     --}}

    @if(session('swal-save'))

    <script>
        $(document).ready(function (){
            Swal.fire({
                title: 'اطلاع',
                 text: '{{ session('swal-save') }}',
                 icon: 'success',
                 confirmButtonText: 'باشه',
      });
        });
    </script>

    @endif
