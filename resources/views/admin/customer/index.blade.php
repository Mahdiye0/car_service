@extends('admin.layouts.master')
@section('head-tag')
<title>  اعضا</title>
@endsection

@section('content')

<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
                مشتریان
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">
           {{-- <a href="{{route('admin.user.create')}}" class="btn btn-info btn-sm">ایجاد عضو جدید
           </a> --}}
           <div class="max-width-16rem">

            <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">

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
                  نام و نام خانوادگی
                   </th>
                   <th>
                   شماره تماس
                   </th>
                   <th>
                  نام کاربری
                     </th>

                    <th>
                        تایید شده
                    </th>

                  <th class="max-width-16rem text-center"><i class="fa fa-cogs"></i>
                    تنظیمات
                  </th>
                </tr>
              </thead>
              <tbody>
                @php
                $count=1;
                @endphp
                  @foreach ($users as $user )


                <tr>
                    <td>
                        @php
                        $index=10*$users->currentPage()-10+($count++);
                    @endphp
                    {{ $index }}
                    </td>

                    <td>
                        {{ $user->first_name." ".$user->last_name}}
                    </td>
                    <td>
                        {{ $user->mobile }}
                    </td>
                    <td>
                        {{ $user->user_name }}
                    </td>

                    <td>
                        <label>
                            <input id="{{ $user->id }}" onchange="changeVerification({{ $user->id }})" data-url="{{ route('admin.user.vefiry', $user->id) }}" type="checkbox" @if ($user->verification === 1)
                            checked
                            @endif>
                        </label>
                    </td>
                  <td class="max-width-16rem text-center">

                    <form class="d-inline" action="{{ route('admin.user.destroy',$user->id) }}" method="POST">
                        @csrf
                        {{ method_field('delete') }}
                     <button onclick='return confirm("آیا شما از حذف گزینه مورد نظر اطمینان دارید؟")' type="submit" class="btn btn-danger btn-sm" ><i class="fa fa-trash-alt">حذف </i></button>
                    </form>
                  </td>
                </tr>

                @endforeach
              </tbody>
            </table>
               {{-- Pagination --}}
               <section id="div_paging">
                <div  class="d-flex justify-content-center ">
                    {{  $users->links()   }}
                </div>
            </section>

         </section>
      </section>
  </section>
</section>

@endsection
<script type='text/javascript'>
    //==========================================
    function changeVerification	(id)
    {

        var element=$('#'+id);
        var url = element.attr('data-url')

        // هر چی که وضعیت هست میاد برعکس میکنه
        var elementValue=!element.prop('checked');



        $.ajax({
                url : url,
                type : "GET",
                success : function(response){

                    if(response.status){
                        if(response.checked)
                        {
                            element.prop('checked', true);
                            //  استفاده از پیغامهای نوع توست در ایجکس
                            // toastSuccess('عملیات با موفقیت انجام شد')
                           alert('عملیات با موفقیت انجام شد')
                        }
                        else
                        {
                            element.prop('checked', false);
                            // toastSuccess('عملیات با موفقیت انجام شد')
                           alert('عملیات با موفقیت انجام شد')

                        }
                    }
                     else
                     {
                        element.prop('checked', element.prop('checked'));
                        // toastError('عملیات با مشکل مواجه شد')
                        alert('عملیات با مشکل مواجه شد')

                    }
                },
                error :function(){

                    alert('خطا')

                }
            })


        // function toastSuccess(message)
        // {
        //     var successToastTag='<section class="toast" data-delay="5000" >\n'+
        //     ' <section class="toast-body py-3 d-flex bg-success text-white" >\n'+
        //         '<strong class="ml-auto">' + message + '</strong>\n' +
        //         '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
        //                     '<span aria-hidden="true">&times;</span>\n' +
        //                     '</button>\n' +
        //                     '</section>\n' +
        //                     '</section>';
        //                     $('.toast-wrapper').append(successToastTag);
        //                     $('.toast').toast('show').delay(5500).queue(function() {
        //                         $(this).remove();
        //                     })

        // }
        // function toastError(message)
        // {
        //     var errorToastTag = '<section class="toast" data-delay="5000">\n' +
        //             '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
        //                 '<strong class="ml-auto">' + message + '</strong>\n' +
        //                 '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
        //                     '<span aria-hidden="true">&times;</span>\n' +
        //                     '</button>\n' +
        //                     '</section>\n' +
        //                     '</section>';

        //                     $('.toast-wrapper').append(errorToastTag);
        //                     $('.toast').toast('show').delay(5500).queue(function() {
        //                         $(this).remove();
        //                     })
        // }
    }
    </script>
