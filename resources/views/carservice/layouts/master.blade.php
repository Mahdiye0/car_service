<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layouts.head-tag')
    @yield('heade-tag')

</head>
<body dir="rtl">
    @include('carservice.layouts.navbar')

    <section class="body-container">
        <section id="main-body" class="main-body">
            @yield('content')

        </section>
    </section>
    @include('admin.layouts.scripts')
    @yield('script')
    <section class="toast-wrapper flex-row-reverse ">
        @include('admin.alerts.toast.error')
        @include('admin.alerts.toast.success')

    </section>
    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.save')
    @include('admin.alerts.sweetalert.error')
    @include('admin.alerts.sweetalert.delete')
    @include('admin.alerts.sweetalert.access-denied')

</body>
</html>


