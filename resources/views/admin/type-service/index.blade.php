@extends('admin.layouts.master')
@section('head-tag')
<title>نوع خدمات</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
    <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
    <li class="breadcrumb-item active font-size-12" aria-current="page"> دسته بندی</li>
  </ol>
</nav>
<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
                  نوع خدمات
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">
           <a href="{{route('admin.type-service.create')}}" class="btn btn-info btn-sm">ایجاد خدمت
           </a>
           <div class="max-width-16rem">

            <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">

           </div>
         </section>
         <section class="table-respansive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>
                      #
                  </th>

                   <th>
                    نوع خدمت رسانی
                   </th>
                   <th>
                    توضیحات
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
                  @foreach ($type_services as $type_service )


                <tr>
                    <td>
                       {{$row}}
                    </td>

                    <td>
                        {{ $type_service->name }}
                    </td>
                    <td>
                        {{ $type_service->description }}
                    </td>
                  <td class="max-width-16rem text-center">
                    <a href="{{ route('admin.type-service.edit',$type_service->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>ویرایش </a>
                    <form class="d-inline" action="{{ route('admin.type-service.destroy',$type_service->id) }}" method="POST">
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
         </section>
      </section>
  </section>
</section>

@endsection
