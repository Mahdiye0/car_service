 {{-- برای نمایش پیغامها با اسویت الرت از جی کویری استفاده میشه
    1
     --}}
     @if(session('swal-access-denied'))

    <script>
        $(document).ready(function (){
            Swal.fire({
                title: 'هشدار',
                 text: '{{ session('swal-access-denied') }}',
                 icon: 'warning',
                 confirmButtonText: 'باشه',
      });
        });
    </script>

    @endif

