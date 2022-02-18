@extends('carservice.layouts.master')
@section('head-tag')
<title> مشاهده خدمات ثبت شده</title>
@endsection

@section('content')

<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
                مشاهده خدمات ثبت شده
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">
             @can('check')
                <a href="{{route('car-service.service.create')}}" class="btn btn-info btn-sm ">ایجاد سرویس جدید
                </a>
            @else
            <a href="javascript:void()" onclick="swalMessage();" class="btn btn-info btn-sm ">ایجاد سرویس جدید
            </a>

             @endcan

           <div class="max-width-16rem">

            <input id="txt_search" onkeypress=" return search(event)" type="text" placeholder="جستجو کسب و کار" class="form-control form-control-sm form-text">

           </div>
         </section>
         <section class="table-respansive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>
                    ردیف
                  </th>


                   <th>
                   شماره تماس
                   </th>
                   <th>
                   نوع کسب و کار
                     </th>
                     <th>
                    استان
                     </th>
                     <th>شهر</th>
                    <th>
                        آدرس محل کار
                    </th>
                    <th>
                        تصویر جواز کسب
                    </th>

                    <th>
                        نوع رسیدگی
                    </th>
                    <th>
                        وضعیت
                    </th>
                  <th class="max-width-16rem text-center"><i class="fa fa-cogs"></i>
                    تنظیمات
                  </th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $row=1
                  ?>
                  @foreach ($users as $user )


                <tr>
                    <td>
                       {{$row}}
                    </td>


                    <td>
                        {{ $user['User']['mobile'] }}
                    </td>
                    <td>
                        {{ $user['TypeService']['name'] }}
                    </td>
                    <td>
                        {{ $user['City']['Province']['name'] }}

                    </td>
                    <td>
                        {{ $user['City']['name'] }}
                    </td>
                    <td>
                        {{ $user['adderss'] }}
                    </td>
                    <td>
                       <img src="{{asset($user->image)}}" width="40" height="40" alt="image" >
                    </td>
                    <td>
                         @if ($user['provide_services']==1)
                         {{ "ثابت" }}
                         @elseif ($user['provide_services']==2)
                         {{ "سیار" }}
                         @elseif ($user['provide_services']==3)
                         {{ "ثابت /سیار" }}
                         @endif

                    </td>
                    <td>
                        @if ($user['status']==1)
                        {{ "فعال" }}
                        @elseif ($user['status']==0)
                        {{ "غیر فعال" }}

                        @endif
                    </td>
                  <td class="max-width-16rem text-center">
                    <a href="{{ route('car-service.service.edit',$user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>ویرایش </a>
                    <form class="d-inline" action="{{ route('car-service.service.destroy',$user['id']) }}" method="POST">
                        @csrf
                        {{ method_field('delete') }}
                     <button type="submit" class="btn btn-danger btn-sm" ><i class="fa fa-trash-alt">حذف </i></button>
                    </form>
                  </td>
                </tr>
                <?php
               $row++;
               ?>
                @endforeach
              </tbody>
            </table>
            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
         </section>
      </section>
  </section>
</section>

@endsection
<script type="text/javascript">
    function search(e) {
        var type_service = document.getElementById("txt_search").value;
    var user_id = document.getElementById("user_id").value;
    var url1='';
    if ( type_service.length>0 ) {
            url1='http://127.0.0.1:8000/car-service/service/search-report-service/'+user_id+'/' +type_service;
    }
    else if(type_service.length==0)
    {
        type_service='a'
        url1='http://127.0.0.1:8000/car-service/service/search-report-service/'+user_id+'/' +type_service;
    }
        $.ajax({
        url :url1,

             type : "GET",
             success : function(data){
                var res='';
                var rate='';
                for(i=1;i<=data.length;i++){

                    switch (data[i-1]['rate']) {
                        case 1:
                        rate='ضعیف';
                            break;
                            case 2:
                            rate='خوب';
                            break;
                            case 3:
                            rate='خیلی خوب';
                            break;
                    }

                        res +=
                        '<tr> '+
                        '<td>'+ i +'</td>'+
                        '<td>'+data[i-1]['created_at']+'</td>'+
                        '<td>'+data[i-1]['services']['type_service']['name']+'</td>'+

                        '<td>'+rate+'</td>'+
                        '<td>'+data[i-1]['services']['adderss']+'</td>'+
                        // ارایه های تو در تو سه مرحله ایی
                        // '<td>'+data[i].services[j].type_service['description']+'</td>'+
                        '</tr>'
             };
             $('tbody').html(res);

             },
             error :function(){
                toastError('عملیات با مشکل مواجه شد')
             }
    });
    function toastError(message)
        {
            var errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                        '<strong class="ml-auto">' + message + '</strong>\n' +
                        '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                            '<span aria-hidden="true">&times;</span>\n' +
                            '</button>\n' +
                            '</section>\n' +
                            '</section>';

                            $('.toast-wrapper').append(errorToastTag);
                            $('.toast').toast('show').delay(5500).queue(function() {
                                $(this).remove();
                            })
        }

    }

    function swalMessage(){
        swal.fire({
        'title':'خطا !',
        'icon':'error',
        'text':'asdsad',
        confirmButtonText:'باشه',
    });
        }
</script>
