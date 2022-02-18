@extends('carservice.layouts.master')

@section('heade-tag')
<title> ثبت خدمت جدید </title>
@endsection

@section('content')
            <section class="row">
                <section class="col-12">
                    <section class="main-body-container">
                        <section class="main-body-container-header">
                            <h5>
                              ثبت خدمت جدید
                            </h5>
                        </section>
                        <section class="body-content">
                            <form  id="form" action="{{ route ('car-service.type-service.store') }}" method="POST" >
                                @csrf
                               <section class="row">
                                <section class="col-12 ">
                                    <div class="form-group">
                                        <label for="">نام خدمت </label>
                                        <input style="width: 30%" type="text"  class="form-control form-control-sm" name="name" >
                                    </div>
                                    @error('name')
                                    <span class="alert_required  text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                     @enderror
                                </section>

                                <section class="col-12 ">
                                    <div class="form-group">
                                        <label for="">توضیحات </label>
                                        <textarea  style="width: 30%" value="{{ old('description') }}" class="form-control form-control-sm" name="description" id="" cols="30" rows="5"></textarea>
                                    </div>
                                    @error('description')
                                    <span class="alert_required  text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                     @enderror
                                </section>

                                <section class="col-12 col-md-6 my-2 ">
                                    <div class="form-group">
                                        <label for="">کلمات کلیدی</label>
                                        <input  value="{{ old('tags') }}" type="hidden" name="tags" id="tags" class="form-control form-control-sm">
                                        <select multiple id="select_tags" class="select2 form-control form-control-sm">
                                        </select>
                                    </div>
                                    @error('tags')
                                    <span class="alert_required   p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                     @enderror
                                </section>

                                    <section  class="col-12">
                                        <button class="btn btn-primary btn-sm">ثبت </button>
                                    </section>
                               </section>
                           </form>
                        </section>
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
                placeholder:'لطفا کلمات کلیدی خود را وارد کنید',
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








