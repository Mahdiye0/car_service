 {{-- برای نمایش پیغامها با اسویت الرت از جی کویری استفاده میشه
    1
     --}}
     @if(session('swal-delete'))

    <script>
        $(document).ready(function (){
            Swal.fire({
                title: 'عملیات حذف',
                 text: '{{ session('swal-delete') }}',
                 icon: 'delete',
                 confirmButtonText: 'باشه',
      });
        });
    </script>

@endif
