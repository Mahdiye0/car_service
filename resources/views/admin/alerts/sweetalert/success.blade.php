 {{-- برای نمایش پیغامها با اسویت الرت از جی کویری استفاده میشه
    1
     --}}
     @if(session('swal-success'))

    <script>
        $(document).ready(function (){
            Swal.fire({
                title: 'اطلاع',
                 text: '{{ session('swal-success') }}',
                 icon: 'success',
                 confirmButtonText: 'باشه',
      });
        });
    </script>

    @endif

