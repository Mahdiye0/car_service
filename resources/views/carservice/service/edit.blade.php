@extends('carservice.layouts.master')
@section('head-tag')
<title>ویرایش</title>
@endsection

@section('content')

<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
                ویرایش
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">
           <a href="{{route('car-service.service.index')}}" class="btn btn-info btn-sm">بازگشت
           </a>


         </section>
         <form action="{{ route ('car-service.service.update',$data[0]->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('put') }}
           <section class="row">
               <section class="col-12 col-md-6">
                   <div class="form-group">
                   <label for="">کسب و کار </label>
                   <select   name="type_service_id" id="type_service_id" class="form-control form-control-sm dropdown-toggle">
                       <option value="">کسب و کار مورد نظر را انتخاب کنید</option>
                       @foreach ($type_services as $type_service )
                        <option @if ($type_service->id==$data[0]->type_service_id)
                            selected

                        @endif  value="{{ $type_service->id }}">{{ $type_service->name }}</option>
                       @endforeach

                   </select>
               </div>
               @error('type_service_id')
               <span class="alert_required  text-white  rounded" role="alert">
                   <strong>
                       {{ $message }}
                   </strong>
               </span>
                @enderror
               </section>
              <section class="col-12 col-md-6">
                   <div class="form-group">
                       <label for="">نام استان</label>
                       <select data-url="#"  onChange="select_province();" name="province_id" id="province_id" class="form-control form-control-sm dropdown-toggle">
                           <option value="">استان مورد نظر را انتخاب کنید</option>
                           @foreach ($provinces as $province )
                            <option @if ($province->id==$data[0]->City->province_id)
                                selected
                            @endif  value="{{ $province->id }}">{{ $province->name }}</option>
                           @endforeach

                       </select>
                   </div>
                   @error('province_id')
                   <span class="alert_required  text-white p-1 rounded" role="alert">
                       <strong>
                           {{ $message }}
                       </strong>
                   </span>
                    @enderror
               </section>
                <section class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">شهرستان</label>
                        <select onChange="select_county()" name="county_id" id="county_id" class="form-control form-control-sm">
                            <option id="option_county" value="">شهرستان مورد نظر را انتخاب کنید</option>
                            @foreach ($counties as $county )
                            <option @if ($county->id==$data[0]->City->County->id)
                                selected
                            @endif  value="{{ $county->id }}">{{ $county->name }}</option>
                           @endforeach
                        </select>
                    </div>
                    @error('county_id')
                    <span class="alert_required  text-white p-1 rounded" role="alert">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                     @enderror
                </section>
                <section class="col-12 col-md-6">
                   <div class="form-group">
                       <label for="">شهر</label>
                       <select name="city_id" id="city_id" class="form-control form-control-sm">
                           <option value="">شهر مورد نظر را انتخاب کنید</option>
                           @foreach ($cities as $city )
                           <option @if ($city->id==$data[0]->City->id)
                               selected
                           @endif  value="{{ $city->id }}">{{ $city->name }}</option>
                          @endforeach
                       </select>
                   </div>
                   @error('city_id')
                   <span class="alert_required  text-white p-1 rounded" role="alert">
                       <strong>
                           {{ $message }}
                       </strong>
                   </span>
                    @enderror
               </section>

               <section class="col-12 col-md-6">
                   <div class="form-group">
                   <label for="">آدرس محل خدمت</label>
                   <input  value="{{ old('adderss',$data[0]->adderss) }}" type="text" name="adderss" class="form-control form-control-sm">
                   {{-- <input  value="{{ $user_id }}" type="hidden" name="user_id" > --}}
               </div>
               @error('adderss')
               <span class="alert_required  text-white p-1 rounded" role="alert">
                   <strong>
                       {{ $message }}
                   </strong>
               </span>
                @enderror
               </section>

               <section class="col-12 col-md-6">
                   <div class="form-group">
                       <label for="">نوع خدمت رسانی</label>
                       <select name="provide_services" id="provide_services" class="form-control form-control-sm">
                           <option value="">نوع خدمترسانی را انتخاب کنید</option>
                           <option @if ($data[0]->provide_services==1) selected
                           @endif value="1">ثابت</option>
                           <option @if ($data[0]->provide_services==2) selected
                            @endif value="2">سیار</option>
                           <option @if ($data[0]->provide_services==3) selected
                            @endif value="3">هر دو</option>
                       </select>
                   </div>
                   @error('provide_services')
                   <span class="alert_required  text-white p-1 rounded" role="alert">
                       <strong>
                           {{ $message }}
                       </strong>
                   </span>
                    @enderror
               </section>
               <section class="col-12 col-md-6">
                   <div class="form-group">
                       <label for="">وضعیت</label>
                       <select name="status" id="status" class="form-control form-control-sm">
                           <option value="">نوع وضعیت را انتخاب کنید</option>
                           <option @if ($data[0]->status==1) selected
                            @endif value="1">فعال</option>
                           <option @if ($data[0]->status==0) selected
                            @endif value="0">غیرفعال</option>
                       </select>
                   </div>
                   @error('status')
                   <span class="alert_required  text-white p-1 rounded" role="alert">
                       <strong>
                           {{ $message }}
                       </strong>
                   </span>
                    @enderror
               </section>
               <section class="col-12 col-md-6">
                <div class="form-group">
                    <label for="image">تصویر</label>
                    <img src="{{asset($data[0]->image)}}" width="40" height="40" alt="image" >
                   <input class="form-control form-control-sm" type="file" name="image" id="image">
                </div>
                @error('image')
                <span class="alert_required  text-white p-1 rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
                 @enderror
            </section>
                <section class="col-12">
                    <button class="btn btn-primary btn-sm">ثبت</button>
                </section>
           </section>
       </form>
        </section>


  </section>
</section>

@endsection

<script >


    function select_province()
    {

        var id=document.getElementById('province_id').value;
        var element=$('#province_id');
        // var url = element.attr('data-url')
        var url1='http://127.0.0.1:8000/admin/type-service/province/'+id;
        //  alert(url1 );


        $.ajax({

                url :url1,
                type : "GET",

                success : function(data){

                    $("#county_id option").remove();
                    var $option = $("<option/>", {
                         value: "",
                         text:  "گزینه ایی را انتخاب کنید",
                             });
                             $('#county_id').append($option);
                    for(i=0;i<data.length;i++){

                        var $option = $("<option/>", {
                         value: data[i].id,
                         text:  data[i].name
                             });
                             $('#county_id').append($option);




				};

                },
                error :function(){

                    alert('error')

                }
            })



    }

    function select_county()
    {

        var id=document.getElementById('county_id').value;
        // var url = element.attr('data-url')
        var url1='http://127.0.0.1:8000/admin/type-service/county/'+id;
        //  alert(url1 );


        $.ajax({

                url :url1,
                type : "GET",

                success : function(data){

                    $("#city_id option").remove();
                    var $option = $("<option/>", {
                         value: "",
                         text:  "گزینه ایی را انتخاب کنید",
                             });
                             $('#city_id').append($option);
                    for(i=0;i<data.length;i++){

                        var $option = $("<option/>", {
                         value: data[i].id,
                         text:  data[i].name
                             });
                             $('#city_id').append($option);
				};

                },
                error :function(){

                    alert('error')

                }
            })



    }
</script>
