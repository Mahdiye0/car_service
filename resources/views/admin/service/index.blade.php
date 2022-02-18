@extends('admin.layouts.master')
@section('head-tag')
<title> خدمت دهنده</title>
@endsection

@section('content')

<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
                 خدمت دهنده
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">
           {{-- <a href="{{route('admin.service.create')}}" class="btn btn-info btn-sm">ایجاد خدمت دهنده
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
                   نوع کسب و کار
                     </th>
                     <th>
                    استان
                     </th>
                     <th>
                        شهر
                    </th>
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
                @php
                    $count=1;
                @endphp
                  @foreach ($users as $user )


                <tr>
                    <td>
                        @php
                        $index=6*$users->currentPage()-6+($count++);
                    @endphp
                    {{ $index }}
                    </td>

                    <td>
                        {{ $user['User']['first_name']." ".$user['User']['last_name']}}
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
                        {{ \Str::limit($user['adderss'], 10)  }}
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
                    <a href="{{ route('admin.service.edit',$user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>ویرایش </a>
                    <form class="d-inline" action="{{ route('admin.service.destroy',$user['id']) }}" method="POST">
                        @csrf
                        {{ method_field('delete') }}
                     <button type="submit" class="btn btn-danger btn-sm" ><i class="fa fa-trash-alt">حذف </i></button>
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
