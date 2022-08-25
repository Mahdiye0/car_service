<?php

namespace App\Http\Repositories\CarService;

use App\Models\City;
use App\Models\County;
use App\Models\Province;
use App\Models\Service;
use App\Models\TypeService;
use App\Models\User;
use Carbon\Carbon;

class ServicesRepository{

    public function index()
    {
        $users = Service::with('User', 'City.Province', 'TypeService')
            ->where('user_id', auth()->user()->id)->get();
        return ['users'=>$users];
    }

    public function create()
    {
        $user = User::where([
            ['id', '=', auth()->user()->id],
            ['expire_date', '>=', Carbon::now()],
        ])->get();
        if (count($user)) {
            $type_services = TypeService::orderBy('name')->get();
            $provinces = Province::orderBy('name')->get();
            return ['type_services'=>$type_services,'provinces'=>$provinces,'status'=>true];
        } else {
            return ['swal'=>' اشتراک شما تمام شده است و اجازه دسترسی به این گزینه را ندارید.میتوانید حساب خود را شارژ کنید','status'=>false];
        }
    }


    public function store($request,$imageservice)
    {
        $inputs = $request->validated();
        if ($request->hasFile('image')) {
            $result = $imageservice->save($request->file('image'));
        }
        $inputs['image'] = $result;
        Service::create($inputs);
        return ['swal'=>'خدمت جدید ثبت شد'];
    }

    public function edit($id)
    {
        $type_services = TypeService::all();
        $provinces = Province::all();
        $data = Service::with('TypeService', 'City.County.Province')
            ->where('id', $id)->get();
        $counties = County::where('province_id', $data[0]->City->province_id)->get();
        $cities = City::where('county_id', $data[0]->City->county_id)->get();

        return [$data=>'data', $type_services=>'type_services', $provinces=>'provinces', $counties=>'counties', $cities=>'cities'];
    }

    public function update($request,$service)
    {
        $inputs = $request->validated();
        $service->update($inputs);
        return ['swal'=>'ویرایش انجام شد'];
    }
}
