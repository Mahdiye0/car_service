@extends('carservice.layouts.master')
@section('head-tag')
<title> درخواستها</title>
@endsection

@section('content')

<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
              لیست درخواستهایی که وضعیت نامشخص دارند و امتیازدهی نشده اند.
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">


         </section>
         <section class="table-respansive">

            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>
                      ردیف
                  </th>


                   <th>
                 تاریخ و ساعت
                   </th>
                   <th>
                  نام خدمت
                     </th>
                     <th>
                      نام و نام خانوادگی سرویس دهنده
                           </th>
                     <th>
                        وضعیت
                     </th>

                    <th>

                      میزان رضایتمندی
                    </th>

                </tr>
              </thead>
              <tbody>
                @php
                    $count=1;
                @endphp
                  @foreach ($results as $result )
                <tr>
                    <td>
                        @php
                        $index=3*$results->currentPage()-3+($count++);
                    @endphp
                    {{ $index }}
                    </td>

                    <td>
                         {{ $result->created_at }}
                    </td>

                    <td>
                        {{ $result->services->TypeService->name }}
                    </td>
                    <td>
                        {{ $result->services->user->first_name.' '. $result->services->user->last_name}}
                    </td>


                    <td>
                        <input type="radio" @if ($result->status==1)
                           checked
                        @endif  onchange="change_status(this)" id="radio1"
                        name={{ $result->id }} value={{ route('car-service.user.message.status', [$result->id,1]) }} >
                        <label for="radio1">انجام شد</label>
                        <input  type="radio"  onchange="change_status(this)" id="radio2" name={{ $result->id }} value={{ route('car-service.user.message.status', [$result->id,0]) }}>
                        <label for="radio2">انجام نشد</label>
                    </td>
                    <td>
                        <select name="rate" onchange="change_rate(this)" id={{ $result->id }}   class="form-control form-control-sm">
                            <option value="" selected>میزان رضایتمندی را انتخاب کنید</option>
                            <option  @if ($result->rate==1)
                                selected
                             @endif value={{ route('car-service.user.message.rate', [$result->id,1]) }} >ضعیف</option>
                            <option @if ($result->rate==2)
                                selected
                             @endif value={{ route('car-service.user.message.rate', [$result->id,2]) }}>خوب</option>
                            <option @if ($result->rate==3)
                                selected
                             @endif value={{ route('car-service.user.message.rate', [$result->id,3]) }}>خیلی خوب</option>
                        </select>
                    </td>


                </tr>

                @endforeach
              </tbody>
            </table>
            {{-- Pagination --}}
            <section id="div_paging">
                <div  class="d-flex justify-content-center ">
                    {{  $results->links()   }}
                </div>
            </section>


         </section>
      </section>
  </section>

</section>

@endsection
<script type="text/javascript" >
function change_rate(index)
{
    // alert(index.value);
    $.ajax({
                url : index.value,
                type : "GET",
                success : function(response){

                    if(response.status){

                        toastSuccess('عملیات با موفقیت انجام شد')
                        }

                },
                error :function(){

                    toastError('عملیات با مشکل مواجه شد')


                }
            })
            function toastSuccess(message)
        {
            var successToastTag='<section class="toast" data-delay="5000" >\n'+
            ' <section class="toast-body py-3 d-flex bg-success text-white" >\n'+
                '<strong class="ml-auto">' + message + '</strong>\n' +
                '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                            '<span aria-hidden="true">&times;</span>\n' +
                            '</button>\n' +
                            '</section>\n' +
                            '</section>';
                            $('.toast-wrapper').append(successToastTag);
                            $('.toast').toast('show').delay(5500).queue(function() {
                                $(this).remove();
                            })

        }
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
    function change_status(status) {
        var url1=status.value;
        // var status1 = status.value;
        // alert(status1);

        // var url1='http://127.0.0.1:8000/car-service/user/message/status/'+id+'/'+status;

        $.ajax({
                url : url1,
                type : "GET",
                success : function(response){

                    if(response.status){

                        toastSuccess('عملیات با موفقیت انجام شد')

                        }

                },
                error :function(){

                    toastError('عملیات با مشکل مواجه شد')

                }
            })
            function toastSuccess(message)
        {
            var successToastTag='<section class="toast" data-delay="5000" >\n'+
            ' <section class="toast-body py-3 d-flex bg-success text-white" >\n'+
                '<strong class="ml-auto">' + message + '</strong>\n' +
                '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                            '<span aria-hidden="true">&times;</span>\n' +
                            '</button>\n' +
                            '</section>\n' +
                            '</section>';
                            $('.toast-wrapper').append(successToastTag);
                            $('.toast').toast('show').delay(5500).queue(function() {
                                $(this).remove();
                            })

        }
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
</script>
