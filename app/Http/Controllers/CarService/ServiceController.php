<?php

namespace App\Http\Controllers\CarService;

use App\Models\City;
use App\Models\County;
use App\Models\Service;
use App\Models\Province;
use App\Models\TypeService;
use Illuminate\Http\Request;
use App\CustomClass\CheckRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Support\Carbon;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users=Service::with('User','City.Province','TypeService')  ->where('user_id',auth()->user()->id)
        ->get();
        return view('carservice.service.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=User::where([
			['id','=',auth()->user()->id],
			['expire_date','>=',Carbon::now()],
        ])->get();
        if(count($user)){
            $type_services=TypeService::orderBy('name')->get();
            $provinces=Province::orderBy('name')->get();

            return view('carservice.service.create',compact('type_services','provinces'));
        }
     else
     {

        return redirect()->route('car-service.service')->with('swal-access-denied',' اشتراک شما تمام شده است و اجازه دسترسی به این گزینه را ندارید.میتوانید حساب خود را شارژ کنید');

     }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request,ImageService $imageservice)
    {

        $inputs = $request->all();
        if($request->hasFile('image'))
        {
            $result=$imageservice->save($request->file('image'));
        }
        $inputs['image'] = $result;
        Service::create($inputs);
        return redirect()->route('car-service.service')->with('swal-success','خدمت جدید ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $type_services=TypeService::all();
        $provinces=Province::all();
        // $counties=County::all();
        $data=Service::with('TypeService','City.County.Province')
       ->where('id',$id)
        ->get();
        $counties=County::where('province_id',$data[0]->City->province_id)->get();
        $cities=City::where('county_id',$data[0]->City->county_id)->get();

        // dd($cities);
        // $data[0]->City->County->county_id
        // dd($data[0]->id);
        // dd($data[0]->City->County->Province->name);
        // dd($data[0]->City->County->name);
    return view('carservice.service.edit',compact('data','type_services','provinces','counties','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $inputs = $request->all();

        $service->update($inputs);
        return redirect()->route('car-service.service')->with('swal-success','ویرایش انجام شد');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Service::where('id',$id)->delete();
        return redirect()->route('car-service.service')->with('swal-delete','خدمت انتخابی حذف شد');
    }
}
