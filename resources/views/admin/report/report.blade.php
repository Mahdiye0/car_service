@extends('admin.layouts.master')
@section('head-tag')
<title> گزارش درخواستها</title>
@endsection

@section('content')

<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
             گزارش درخواستها
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">

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
                  خدمت گیرنده
                   </th>
                   <th>
                 تاریخ و ساعت
                   </th>
                   <th>
                نام خدمت
                     </th>
                    <th>
                        وضعیت درخواست
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
                  @foreach ($orders as $order )


                <tr>
                    <td>
                        @php
                        $index=10*$orders->currentPage()-10+($count++);
                    @endphp
                    {{ $index }}
                    </td>

                    <td>
                        {{ $order->user->FullName}}
                    </td>
                    <td>
                        {{ jalaliDate($order->created_at,'Y-m-d H:i:s') }}
                    </td>
                    <td>
                        {{ $order->services->TypeService->name}}
                    </td>
                    <td>
                        <label>
                            @if ($order->status === 1)
                          {{ 'انجام شد' }}
                          @else
                          {{ 'انجام نشد' }}
                            @endif
                        </label>
                    </td>

                    <td>
                        @switch($order->rate)
                            @case(1)
                                {{ 'ضعیف' }}
                            @break
                            @case(2)
                             {{ 'خوب' }}
                            @break
                            @case(3)
                             {{ 'خیلی خوب' }}
                             @break

                            @default

                        @endswitch

                    </td>

                </tr>

                @endforeach
              </tbody>
               {{-- Pagination --}}
               <section id="div_paging">
                <div  class="d-flex justify-content-center ">
                    {{  $orders->links()   }}
                </div>
            </section>
            </table>
         </section>
      </section>
  </section>
</section>

@endsection
