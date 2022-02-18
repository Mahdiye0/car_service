@extends('admin.layouts.master')
@section('head-tag')
<title>ویرایش</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
    <li class="breadcrumb-item font-size-12"> <a href="#"></a></li>
    <li class="breadcrumb-item font-size-12"> <a href="#"> </a></li>
    <li class="breadcrumb-item active font-size-12" aria-current="page"> ویرایش     </li>
  </ol>
</nav>
<section class="row">
  <section class="col-12">
      <section class="main-body-container">
          <section class="main-body-container-header">
              <h5>
                ویرایش
              </h5>

          </section>
         <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pd-2">
           <a href="{{route('admin.type-service')}}" class="btn btn-info btn-sm">بازگشت
           </a>


         </section>
         <form id="form" action="{{ route('admin.type-service.update',$data->id) }}"  method="POST">
            @csrf
            {{ method_field('put') }}
            <section class="row">
                 <section class="col-12 col-md-6 my-2">
                     <div class="form-group">
                     <label for="">نام کسب و کار</label>
                     <input value="{{old('name',$data->name)  }}" type="text" name="name" class="form-control form-control-sm">
                 </div>
                 @error('name')
                 <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                     <strong>
                         {{ $message }}
                     </strong>
                 </span>

                 @enderror
                 </section>
                 <input value="{{$data->id}}" type="hidden" name="id" class="form-control form-control-sm">

                <section class="col-12 col-6  my-2">
                    <div class="form-group">
                    <label for="">توضیحات </label>
                   <textarea id= "description" class="form-control form-control-sm" name="description"   cols="30" rows="5">
                    {{old('description',$data->description)  }}
                   </textarea>
                </div>
                @error('description')
                <span class="alert-required bg-danger text-white rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>

                @enderror
                </section>
                <section class="col-12 col-md-6 my-2">
                    <div class="form-group">
                    <label for="">تگ ها</label>
                    <input  value="{{ old('tags',$data->tags) }}" type="hidden" name="tags" id="tags" class="form-control form-control-sm">
                    <select multiple id="select_tags" class="select2 form-control form-control-sm">

                    </select>
                </div>
                @error('tags')
                <span class="alert-required bg-danger text-white rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>

                @enderror
                </section>
                 <section class="col-12">
                     <button  class="btn btn-primary btn-sm">ثبت</button>
                 </section>
            </section>
        </form>
        </section>


  </section>
</section>

@endsection
@section('script')


<script >
    $(document).ready(function ()
        {
            var tags_input=$('#tags');
            var select_tags=$('#select_tags');

            // رشته رو به آرایه تبدیل میکنه
            var default_tags=tags_input.val().split(',');
            if(tags_input.val() !==null && tags_input.val().length>0)
            {
                var default_data=default_tags

            }

            select_tags.select2({
                placeholder:'لطفا تگ ها خود را وارد کنید',
                tags:true,
                data:default_data

            });

            select_tags.children('option').attr('selected',true).trigger('change');
            $('#form').submit(function (event){
                if(select_tags.val() !== null &&select_tags.val().length>0)
                {
                    // تابع جوین آرایه رو به رشته تبدیل میکنه
                    var tags_Values=select_tags.val().join(',');
                    tags_input.val(tags_Values);
                }

            })

        }
    )

</script>
@endsection
