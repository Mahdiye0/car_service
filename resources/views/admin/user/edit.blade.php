@extends('admin.layouts.master')
@section('head-tag')
<title>ویرایش</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
    <li class="breadcrumb-item font-size-12"> <a href="#"></a></li>
    <li class="breadcrumb-item font-size-12"> <a href="#"> </a></li>
    <li class="breadcrumb-item active font-size-12" aria-current="page"> ویرایش     </li>
  </ol>
</nav>
<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
                ویرایش
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">
           <a href="{{route('admin.user')}}" class="btn btn-info btn-sm">بازگشت
           </a>


         </section>
         <form id="form" action="{{ route('admin.user.update',$data->id) }}"  method="POST">
            @csrf
            {{ method_field('put') }}
            <section class="row">
                <section class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="">نام </label>
                    <input  value="{{ old('first_name',$data->first_name) }}" type="text" name="first_name" class="form-control form-control-sm">
                </div>
                @error('first_name')
                <span class="alert_required  text-white  rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                 @enderror
                </section>
                <section class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="">نام خانوادگی </label>
                    <input  value="{{ old('last_name',$data->last_name) }}" type="text" name="last_name" class="form-control form-control-sm">
                </div>
                @error('last_name')
                <span class="alert_required  text-white  rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                 @enderror
                </section>
                <section class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="">شماره موبایل </label>
                    <input  maxlength="11"  value="{{ old('mobile',$data->mobile) }}" type="text" name="mobile" class="form-control form-control-sm">
                    <input  type="hidden" name="type" value="u">
                </div>
                @error('mobile')
                <span class="alert_required  text-white  rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                 @enderror
                </section>
                <section class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="">نام کاربری </label>
                    <input maxlength="20" onkeypress='return /[a-z0-9!@#$%^&*]/i.test(event.key)' id="user_name" value="{{ old('user_name',$data->user_name) }}" type="text" name="user_name" class="form-control form-control-sm">
                </div>
                @error('user_name')
                <span class="alert_required  text-white  rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                 @enderror
                </section>
                <section class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="">کلمه عبور </label>
                    <input maxlength="20" onkeypress='return /[a-z0-9!@#$%^&*]/i.test(event.key)'  value="{{ old('password') }}" type="text" name="password" class="form-control form-control-sm">
                </div>
                @error('password')
                <span class="alert_required  text-white  rounded" role="alert">
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
                        <option @if ($type==1)
                            selected
                        @endif value="1">خدمت دهنده</option>
                        <option  @if ($type==2)
                        selected
                    @endif value="2">خدمت گیرنده</option>
                        <option   @if ($type==3)
                        selected
                    @endif value="3">هر دو</option>
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
                     <button class="btn btn-primary btn-sm">ثبت</button>
                 </section>
        </form>
        </section>


  </section>
</section>

@endsection

