@extends('admin.layouts.master')
@section('head-tag')
<title>ویرایش پروفایل</title>
@endsection

@section('content')

<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
                ویرایش پروفایل
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">
           <a href="{{route('admin.home')}}" class="btn btn-info btn-sm">بازگشت
           </a>


         </section>
         <form id="form" action="{{ route('car-service.user.update',auth()->user()->id) }}"  method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('put') }}
            <section class="row">
                <section  class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="">نام </label>
                    <input style="width: 50%" value="{{ old('first_name',auth()->user()->first_name) }}" type="text" name="first_name" class="form-control form-control-sm">
                </div>
                @error('first_name')
                <span class="alert_required  text-white  rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                 @enderror
                </section>
                <section class="col-12 col-md-6 ">
                    <div class="form-group">
                        <label for="image">تصویر</label>
                        <img src="{{asset(auth()->user()->image)}}" width="40" height="40" alt="image" >

                       <input style="width: 50%" class="form-control form-control-sm" type="file" name="image" id="image">
                    </div>
                    @error('image')
                    <span class="alert_required   p-1 rounded" role="alert">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                     @enderror
                </section>
                <section  class="col-12 ">
                    <div class="form-group">
                    <label for="">نام خانوادگی </label>
                    <input style="width: 30%" value="{{ old('last_name',auth()->user()->last_name) }}" type="text" name="last_name" class="form-control form-control-sm">
                </div>
                @error('last_name')
                <span class="alert_required  text-white  rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                 @enderror
                </section>
                <section class="col-12 ">
                    <div class="form-group">
                    <label for="">شماره موبایل </label>
                    <input style="width: 30%"  maxlength="11"  value="{{ old('mobile',auth()->user()->mobile) }}" type="text" name="mobile" class="form-control form-control-sm">
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
                <section class="col-12 ">
                    <div class="form-group">
                    <label for="">نام کاربری </label>
                    <input style="width: 30%" maxlength="20" onkeypress='return /[a-z0-9!@#$%^&*]/i.test(event.key)' id="user_name" value="{{ old('user_name',auth()->user()->user_name) }}" type="text" name="user_name" class="form-control form-control-sm">
                </div>
                @error('user_name')
                <span class="alert_required  text-white  rounded" role="alert">
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

