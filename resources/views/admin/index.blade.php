@extends('admin.layouts.master')

@section('heade-tag')
<title>داشبورد</title>
@endsection

@section('content')
{{-- <section>
    @forelse($notifications as $notification)
        <div class="alert alert-success" role="alert">
            [{{ $notification->created_at }}] کاربر {{ $notification->data['name'] }}  در سایت ثبت نام کرد
            <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                Mark as read
            </a>
        </div>

        @if($loop->last)
            <a href="#" id="mark-all">
                Mark all as read
            </a>
        @endif
    @empty
        There are no new notifications
    @endforelse
</section> --}}
            <section class="row">

                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-custom-yellow text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>30,200 تومان</h5>
                                        <p>سود </p>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : 21:42 بعد از ظهر
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-custom-green text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>30,200 تومان</h5>
                                        <p>سود خالص</p>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : 21:42 بعد از ظهر
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-custom-pink text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>30,200 تومان</h5>
                                        <p>سود خالص</p>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : 21:42 بعد از ظهر
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-custom-yellow text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>30,200 تومان</h5>
                                        <p>سود خالص</p>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : 21:42 بعد از ظهر
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-danger text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>30,200 تومان</h5>
                                        <p>سود خالص</p>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : 21:42 بعد از ظهر
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-success text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>30,200 تومان</h5>
                                        <p>سود خالص</p>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : 21:42 بعد از ظهر
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-warning text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>30,200 تومان</h5>
                                        <p>سود خالص</p>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : 21:42 بعد از ظهر
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-primary text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>30,200 تومان</h5>
                                        <p>سود خالص</p>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : 21:42 بعد از ظهر
                            </section>
                        </section>
                    </a>
                </section>

            </section>

            <section class="row">
                <section class="col-12">
                    <section class="main-body-container">
                        <section class="main-body-container-header">
                            <h5>
                                بخش کاربران
                            </h5>
                            <p>
                                در این بخش اطلاعاتی در مورد کاربران به شما داده می شود
                            </p>
                        </section>
                        <section class="body-content">
                          <p>
                              در قسمت پنل ادمین میتوانید خدمتی را ثبت کنید یا خدمات داده شده رو مشاهده کنید و سایر امکانات دیگر
                          </p>
                        </section>
                    </section>
                </section>
            </section>
            @endsection









