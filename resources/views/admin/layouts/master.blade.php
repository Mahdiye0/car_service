<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.head-tag')
    @yield('heade-tag')
    {{-- @livewireStyles --}}

</head>

<body dir="rtl">
@include('admin.layouts.header')

    <section class="body-container">
@include('admin.layouts.sidebar')


        <section id="main-body" class="main-body">
            @yield('content')
            {{-- @livewire('Show') --}}

        </section>
    </section>
@include('admin.layouts.scripts')
@yield('script')
{{-- برای استفاده از پیغامهای توست از فایل مستر استفاده میکنیم که باید داخل سکشن هم اینکلود بشن --}}
<section class="toast-wrapper flex-row-reverse ">
    @include('admin.alerts.toast.error')
    @include('admin.alerts.toast.success')

</section>
@include('admin.alerts.sweetalert.success')
@include('admin.alerts.sweetalert.error')
@include('admin.alerts.sweetalert.delete')
{{-- @livewireScripts --}}
</body>

</html>
