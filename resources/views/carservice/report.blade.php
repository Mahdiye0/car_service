@extends('carservice.layouts.master')
@section('head-tag')
<title> گزارش </title>
@endsection

@section('content')

<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
                گزارش
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">

           <div class="max-width-16rem">

            <input type="text" onkeypress=" return search(event)" class="form-control form-control-sm" id="search_service" placeholder="جستجو">
                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
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
                 تاریخ و ساعت
                   </th>
                   <th>
                  نام خدمت
                     </th>
                     <th>
                میزان رضایتمندی
                     </th>

                    <th>
                        ادرس انجام خدمت
                    </th>

                </tr>
              </thead>
              <tbody>
                @php
                    $count=1;
                @endphp
                  @foreach ($orders as $order )
                <tr>
                    <td>
                        @php
                        $index=3*$orders->currentPage()-3+($count++);
                    @endphp
                    {{ $index }}
                    </td>

                    <td>
                         {{jalaliDate($order->created_at,'Y-m-d H:i:s')   }}
                    </td>

                    <td>
                        {{ $order->services->TypeService->name }}
                    </td>
                    <td>

                        @switch ($order->rate)
                            @case (1)
                            {{ 'ضعیف' }}
                                @break
                                @case (2)
                                {{ 'خوب' }}
                                @break;
                                @case (3)
                                {{ 'خیلی خوب' }}
                                @break
                        @endswitch
                    </td>

                    <td>
                     {{$order->adderss ?? $order->services->adderss }}
                    </td>



                </tr>

                @endforeach
              </tbody>
            </table>
            {{-- Pagination --}}
            <section id="div_paging">
                <div  class="d-flex justify-content-center ">
                    {{  $orders->links()   }}
                </div>
            </section>


         </section>
      </section>
  </section>

</section>

@endsection
<script type="text/javascript" >
    function search(e) {

    var type_service = document.getElementById("search_service").value;
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
             document.getElementById("div_paging").classList.add('d-none');
             },
             error :function(){
                 alert('error')
             }
    });
        // return false;

}
</script>
