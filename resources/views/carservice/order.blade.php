@extends('carservice.layouts.master')

@section('heade-tag')
<title> درخواست خدمت</title>
@endsection

@section('content')
            <section class="row">
                <section class="col-12">
                    <section class="main-body-container">
                        <section class="main-body-container-header">
                            <h5>
                              ثبت سفارش
                            </h5>
                        </section>
                        <section class="body-content">
                            <form action="{{ route ('car-service.order.store') }}" method="POST" >
                                @csrf
                               <section class="row">
                                <section class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="">نام استان</label>
                                        <select data-url="#" onchange="select_province()" name="province" id="province" class="form-control form-control-sm dropdown-toggle">
                                            <option value="">استان مورد نظر را انتخاب کنید</option>
                                            @foreach ($provinces as $province )
                                             <option  value="{{ $province->id }}">{{ $province->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    @error('province')
                                    <span class="alert_required  text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                     @enderror
                                </section>

                                <section class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="">شهرستان</label>
                                        <select onchange="select_county()" name="county_id" id="county_id" class="form-control form-control-sm">
                                            <option id="option_county" value="">شهرستان مورد نظر را انتخاب کنید</option>

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
                                <section class="col-12 col-md-3">
                                   <div class="form-group">
                                       <label for="">شهر</label>
                                       <select onchange="select_typeservice()" name="city_id" id="city_id" class="form-control form-control-sm">
                                           <option value="">شهر مورد نظر را انتخاب کنید</option>
                                           <option value=""></option>
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
                                <section id="section_search" class="col-12 col-md-6 d-none">
                                    <div class="form-group row">
                                        <label for="search_service" class="col-sm-2 col-form-label">کسب و کار :</label>
                                        <div class="col-sm-6">
                                          <input type="text" onkeypress=" return search(event)" class="form-control form-control-sm" id="search_service" placeholder="جستجو">
                                        </div>
                                </section>
                                   <section id="section_table" class=" col-12 d-none ">
                                    <table id="table" class="table table-striped table-hover ">
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
                                                    توضیح
                                                      </th>
                                                  <th>
                                                      آدرس محل کار
                                                  </th>


                                                  <th>
                                                      نوع رسیدگی
                                                  </th>
                                                  <th>
                                                   شناسه
                                                </th>
                                          </tr>
                                        </thead>
                                        <tbody class="row-hover">
                                        </tbody>
                                      </table>
                                   </section>

                                      {{-- <section id="provider_2"  class="col-12 col-md-6 d-none">
                                        <P >{{ 'ادرس خود را جهت حضور کارشناسان وارد کنید' }}</P>

                                            <div class="form-group">
                                            <label for="">ادرس</label>
                                            <input  value="{{ old('add') }}" type="text" name="add" class="form-control form-control-sm">

                                        </div>
                                        @error('add')
                                        <span class="alert_required  text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                         @enderror

                                      </section> --}}
                                      <section id="provider_3" class="col-12 col-md-6 d-none">
                                        <P >{{ 'گزینه دلخواه را انتخاب کنید' }}</P>
                                        <div class="form-group">
                                            <input type="radio"  onchange="show_address(this)" id="fixe" name="f" value="1">
                                            <label for="fixe">ثابت</label><br>
                                            <input type="radio"  onchange="show_address(this)" id="nofixe" name="f" value="2">
                                            <label for="nofixe">سیار</label>
                                        </div>
                                      </section>
                                      <section id="address_nofix" class="col-12 d-none">
                                        <P >{{ 'ادرس خود را جهت حضور کارشناسان وارد کنید' }}</P>
                                    <input  value="{{ old('address') }}" type="text" name="address" style="width: 50%" class="form-control form-control-sm">
                                    <input id="service_id" value="" type="hidden" name="service_id" >
                                    <input id="user_id"
                                    value= "{{ (\Auth::user()->id) }}"
                                    type="hidden" name="user_id" >
                                </section>
                                @error('address')
                                <span class="alert_required  text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                 @enderror

                                    <section id="section_button" class="col-12 d-none">
                                        <button class="btn btn-primary btn-sm">ثبت سفارش</button>
                                    </section>
                               </section>
                           </form>
                        </section>
                    </section>
                </section>
            </section>
 @endsection

<script type="text/javascript">
function search(e) {
    var type_service = document.getElementById("search_service").value;
    if (e.keyCode == 13 && type_service.length>0 ) {

        var id=document.getElementById('city_id').value;
    $.ajax({
        url :'http://127.0.0.1:8000/car-service/order/search_type_service/'+id+'/'+type_service,
             type : "GET",
             success : function(data){
                var res='';
                var provider='';
                for(i=1;i<=data.length;i++){
                    switch (data[i-1]['provide_services']) {
                        case 1:
                        provider='ثابت'
                            break;
                            case 2:
                        provider='سیار'
                            break;
                            case 3:
                        provider='ثابت/سیار'
                            break;
                    }
                        res +=
                        '<tr id='+data[i-1]['id']+' onclick="select_row(this)">'+
                        '<td>'+ i +'</td>'+
                        '<td>'+data[i-1].user['first_name']+'  '+data[i-1].user['last_name']+'</td>'+
                        '<td>'+data[i-1].user['mobile']+'</td>'+
                        '<td>'+data[i-1].type_service['name']+'</td>'+
                        '<td>'+data[i-1].type_service['description']+'</td>'+
                        '<td>'+data[i-1]['adderss']+'</td>'+
                        '<td id='+data[i-1]['provide_services']+'>'+provider+'</td>'+
                        '<td >'+data[i-1]['id']+'</td>'+


                        // ارایه های تو در تو سه مرحله ایی
                        // '<td>'+data[i].services[j].type_service['description']+'</td>'+
                        '</tr>'



             };


             $('tbody').html(res);
             document.getElementById("section_table").classList.remove('d-none');
             document.getElementById("section_search").classList.remove('d-none');
             document.getElementById("section_button").classList.remove('d-none');
             },
             error :function(){
                 alert('error')
             document.getElementById("section_table").classList.add('d-none');
             document.getElementById("section_search").classList.add('d-none');
             document.getElementById("section_button").classList.add('d-none');
             document.getElementById("provider_3").classList.add('d-none');


             }

    });
        return false;
    }
    else
    select_typeservice()

}
function show_address(status)
{
    var radio= status.id;
    if(radio=="fixe" &&  status.checked)
      document.getElementById("address_nofix").classList.add('d-none');
    else if(radio=="nofixe" &&  status.checked)
      document.getElementById("address_nofix").classList.remove('d-none');

}
function select_typeservice()
{
    var id=document.getElementById('city_id').value;
    $.ajax({
        url :'http://127.0.0.1:8000/car-service/order/order_type_service/'+id,
             type : "GET",

             success : function(data){

                var res='';
                var provider='';
                for(i=1;i<=data.length;i++){
                    switch (data[i-1]['provide_services']) {
                        case 1:
                        provider='ثابت'
                            break;
                            case 2:
                        provider='سیار'
                            break;
                            case 3:
                        provider='ثابت/سیار'
                            break;
                    }
                        res +=
                        '<tr id='+data[i-1]['id']+' onclick="select_row(this)">'+
                        '<td>'+ i +'</td>'+
                        '<td>'+data[i-1].user['first_name']+'  '+data[i-1].user['last_name']+'</td>'+
                        '<td>'+data[i-1].user['mobile']+'</td>'+
                        '<td>'+data[i-1].type_service['name']+'</td>'+
                        '<td>'+data[i-1].type_service['description']+'</td>'+
                        '<td>'+data[i-1]['adderss']+'</td>'+
                        '<td id='+data[i-1]['provide_services']+'>'+provider+'</td>'+
                        '<td >'+data[i-1]['id']+'</td>'+


                        // ارایه های تو در تو سه مرحله ایی
                        // '<td>'+data[i].services[j].type_service['description']+'</td>'+
                        '</tr>'



             };
             $('tbody').html(res);
             document.getElementById("section_table").classList.remove('d-none');
             document.getElementById("section_search").classList.remove('d-none');
             document.getElementById("section_button").classList.remove('d-none');
             },
             error :function(){
                 alert('error')
             document.getElementById("section_table").classList.add('d-none');
             document.getElementById("section_search").classList.add('d-none');
             document.getElementById("section_button").classList.add('d-none');


             }

    });

}
function select_row(event)
{
    document.getElementById("service_id").value = event.id;

    switch (event.cells[6].id) {
        case '2':

             document.getElementById("address_nofix").classList.remove('d-none');
             document.getElementById("provider_3").classList.add('d-none');
            break;
            case '3':
             document.getElementById("address_nofix").classList.add('d-none');
             document.getElementById("provider_3").classList.remove('d-none');
            break;
            case '1':
            document.getElementById("address_nofix").classList.add('d-none');
             document.getElementById("provider_3").classList.add('d-none');
            break;

    }


}
    function select_province()
 {
     var id=document.getElementById('province').value;
     var element=$('province');

    //  var url1='http://127.0.0.1:8000/car-service/order/province/'+id;
    //  alert(url1 );
     $.ajax({
             url :'http://127.0.0.1:8000/car-service/order/province/'+id,
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
         });



 }

 function select_county()
 {

     var id=document.getElementById('county_id').value;
     // var url = element.attr('data-url')
     var url1='http://127.0.0.1:8000/car-service/order/county/'+id;
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










