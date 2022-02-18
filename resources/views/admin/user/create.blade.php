@extends('admin.layouts.master')
@section('head-tag')
<title> عضو جدید</title>
@endsection

@section('content')

<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
               تعریف عضو جدید
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">
           <a href="{{route('admin.user')}}" class="btn btn-info btn-sm">بازگشت
           </a>


         </section>
         <form action="{{ route ('admin.user.store') }}" method="POST">
             @csrf
            <section class="row">
                <section class="col-12 col-md-6">
                    <div class="form-group">
                    <label for="">نام </label>
                    <input  value="{{ old('first_name') }}" type="text" name="first_name" class="form-control form-control-sm">
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
                    <input  value="{{ old('last_name') }}" type="text" name="last_name" class="form-control form-control-sm">
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
                    <input  maxlength="11"  value="{{ old('mobile') }}" type="text" name="mobile" class="form-control form-control-sm">
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
                    <input maxlength="20" onkeypress='return /[a-z0-9!@#$%^&*]/i.test(event.key)' id="user_name" value="{{ old('user_name') }}" type="text" name="user_name" class="form-control form-control-sm">
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
                     <button class="btn btn-primary btn-sm">ثبت</button>
                 </section>
        </form>
        </section>


  </section>
</section>

@endsection
<script>
     function englishinput()
    {
        $('#user_name').on('keyup', function (event) {
        var arregex = /^[a-zA-Z0-9_ ]*$/;
        if (!arregex.test(event.key)) {
            $('#user_name').val("");
        }
    });
    }

</script>
<script >


    function select_province()
    {

        var id=document.getElementById('province').value;
        var element=$('#province');
        // var url = element.attr('data-url')
        var url1='http://127.0.0.1:8000/admin/type-service/province/'+id;
        //  alert(url1 );


        $.ajax({

                url :url1,
                type : "GET",

                success : function(data){

                    $("#county option").remove();
                    var $option = $("<option/>", {
                         value: "",
                         text:  "گزینه ایی را انتخاب کنید",
                             });
                             $('#county').append($option);
                    for(i=0;i<data.length;i++){

                        var $option = $("<option/>", {
                         value: data[i].id,
                         text:  data[i].name
                             });
                             $('#county').append($option);




				};

                },
                error :function(){

                    alert('error')

                }
            })



    }

    function select_county()
    {

        var id=document.getElementById('county').value;
        // var url = element.attr('data-url')
        var url1='http://127.0.0.1:8000/admin/type-service/county/'+id;
        //  alert(url1 );


        $.ajax({

                url :url1,
                type : "GET",

                success : function(data){

                    $("#city option").remove();
                    var $option = $("<option/>", {
                         value: "",
                         text:  "گزینه ایی را انتخاب کنید",
                             });
                             $('#city').append($option);
                    for(i=0;i<data.length;i++){

                        var $option = $("<option/>", {
                         value: data[i].id,
                         text:  data[i].name
                             });
                             $('#city').append($option);
				};

                },
                error :function(){

                    alert('error')

                }
            })



    }
</script>
