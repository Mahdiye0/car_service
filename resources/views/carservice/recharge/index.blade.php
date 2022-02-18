@extends('carservice.layouts.master')

@section('heade-tag')
<title>شارژ حساب</title>
@endsection

@section('content')
            <section class="row">
                <section class="col-12">
                    <section class="main-body-container-header">
                        @if (!empty(auth()->user()->expire_date))
                        <div>
                            <h5>
                                @if (auth()->user()->expire_date>= \Carbon\Carbon::now())
                                حساب شما تا تاریخ: {{jalaliDate(auth()->user()->expire_date)  }} معتبر است
                                @else
                                حساب شما در تاریخ: {{jalaliDate(auth()->user()->expire_date)  }}  منقضی شده است
                                @endif


                            </h5>

                        </div>
                    @endif
                        </section>
                    <br>
                    <section class="main-body-container">

                        <section class="main-body-container-header">

                            <h6>
                             میتوانید یکی از گزینه های اشتراک را انتخاب کنید
                            </h6>
                        </section>
                        <section class="body-content">
                            <form action="{{ route('car-service.user.recharge.pay',auth()->user()->id) }}" method="POST" >
                                @csrf
                                {{ method_field('put') }}
                               <section class="row">
                                      <section  class="col-12 col-md-6">
                                        <div class="form-group">
                                            <input type="radio" checked  id="one" name="f" value="1">
                                            <label for="one">اشتراک یک ماهه 1000 تومان</label><br>
                                            <input type="radio"  id="six" name="f" value="6">
                                            <label for="six">اشتراک شش ماهه 5000 تومان</label><br>

                                            <input type="radio"  id="twelve
                                            " name="f" value="12">
                                            <label for="twelve
                                            ">اشتراک 12 ماهه 10000 تومان</label>
                                        </div>
                                        <section class="col-12">
                                            <button class="btn btn-primary btn-sm">پرداخت</button>
                                        </section>
                                      </section>
                                    </section>
                           </form>
                        </section>
                    </section>
                </section>
            </section>
 @endsection











