@extends('carservice.layouts.master')

@section('heade-tag')
<title>شارژ حساب</title>
@endsection

@section('content')
            <section class="row">
                <section class="col-12">
                    <section class="main-body-container">
                        <section class="main-body-container-header">
                            <h5>
                             عملیات پرداخت با موفقیت انجام شد

                            </h5>
                            <h4>
                                شماره پیگیری شما : {{ $referenceId }}
                            </h4>
                            <h5>
                               حساب شما تا تاریخ:{{jalaliDate(auth()->user()->expire_date)  }} شارژ شد

                               </h5>
                        </section>
                        <section class="col-12">
                            <a href="{{ route('car-service.home') }}" class="btn btn-primary btn-sm">بازگشت</a>
                        </section>
                    </section>
                </section>
            </section>
 @endsection











