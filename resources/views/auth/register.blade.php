@extends('layouts.app')

@section('content')


<div dir="rtl" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div  class="card-header">{{ __('فرم ثبت نام') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                <label for="">نام </label>
                                <input  value="{{ old('first_name') }}" type="text" name="first_name" class="form-control form-control-sm  @error('first_name') is-invalid @enderror">
                            </div>
                            @error('first_name')
                            <span class="alert_required  text-danger  " role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                             @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                <label for="">نام خانوادگی </label>
                                <input  value="{{ old('last_name') }}" type="text" name="last_name" class="form-control form-control-sm @error('last_name') is-invalid @enderror">
                            </div>
                            @error('last_name')
                            <span class="alert_required text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                             @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                <label for="">شماره موبایل </label>
                                <input  maxlength="11"  value="{{ old('mobile') }}" type="text" name="mobile" class="form-control form-control-sm @error('mobile') is-invalid @enderror">
                                <input  type="hidden" name="type" value="u">
                            </div>
                            @error('mobile')
                            <span class="alert_required text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                             @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                <label for="">ایمیل (اختیاری) </label>
                                <input  value="{{ old('email') }}" type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror ">
                            </div>
                            @error('email')
                            <span class="alert_required text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                             @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                <label for="">نام کاربری </label>
                                <input maxlength="20" onkeypress='return /[a-z0-9!@#$%^&*]/i.test(event.key)' id="user_name" value="{{ old('user_name') }}" type="text" name="user_name" class="form-control form-control-sm @error('user_name') is-invalid @enderror">
                            </div>
                            @error('user_name')
                            <span class="alert_required text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                             @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                <label for="">کلمه عبور </label>
                                <input maxlength="20" onkeypress='return /[a-z0-9!@#$%^&*]/i.test(event.key)'  value="{{ old('password') }}" type="text" name="password" class="form-control form-control-sm @error('password') is-invalid @enderror">
                            </div>
                            @error('password')
                            <span class="alert_required text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                             @enderror

                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                <label for="">تایید کلمه عبور</label>
                                <input maxlength="20" onkeypress='return /[a-z0-9!@#$%^&*]/i.test(event.key)'  value="{{ old('password_confirmation') }}" type="text" name="password_confirmation" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror">
                            </div>
                            @error('password_confirmation')
                            <span class="alert_required text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                             @enderror

                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                <label for="">نوع کاربری </label>
                                <select name="role" id="role" class="form-control form-control-sm @error('role') is-invalid @enderror">
                                    <option value="">نوع کاربری را انتخاب کنید</option>
                                    <option value="1">خدمت دهنده</option>
                                    <option value="2">خدمت گیرنده</option>
                                    <option value="3">هر دو</option>
                                </select>

                            </div>
                            @error('role')
                            <span class="alert_required text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                             @enderror
                            </section>
                 <section class="col-12">
                                 {{-- <button class="btn btn-primary btn-sm">ثبت</button> --}}


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ثبت نام') }}
                                </button>
                            </div>
                        </div>
                    </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
