<?php

namespace App\Http\Repositories\Admin;

use App\Http\Services\Image\ImageService;
use App\Models\City;
use App\Models\County;
use App\Models\Province;
use App\Models\Service;
use App\Models\TypeService;
use App\Models\User;

class ServicesRepository
{

    public function index()
    {
        $users1 = User::where('verification', 0)->get();
        $users = Service::with('User', 'City.Province', 'TypeService')->simplePaginate(6);
        return ['users1' => $users1, 'users' => $users];
    }

    public function create()
    {
        $users1 = User::where('verification', 0)->get();
        $type_services = TypeService::orderBy('name')->get();
        $provinces = Province::orderBy('name')->get();
        return ['users1' => $users1, 'type_services' => $type_services, 'provinces' => $provinces];
    }

    public function store($request, $imageservice)
    {
        $users1 = User::where('verification', 0)->get();
        $inputs = $request->validated();
        if ($request->hasFile('image')) {
            $result = $imageservice->save($request->file('image'));
        }
        $inputs['image'] = $result;
        Service::create($inputs);
        return $users1;
    }

    public function edit($id)
    {
        $users1 = User::where('verification', 0)->get();
        $type_services = TypeService::all();
        $provinces = Province::all();

        $data = Service::with('TypeService', 'City.County.Province')
            ->where('id', $id)
            ->get();
        $counties = County::where('province_id', $data[0]->City->province_id)->get();
        $cities = City::where('county_id', $data[0]->City->county_id)->get();

        return [$users1=>'users1', $data=>'data', $type_services=>'type_services', $provinces=>'provinces', $counties=>'counties', $cities=>'cities'];
    }

    public function update($request, $service)
    {
        $users1 = User::where('verification', 0)->get();
        $inputs = $request->validatred();
        $service->update($inputs);
        return ['users1'=>$users1];
    }

    public function destroy($id)
    {
        $users1 = User::where('verification', 0)->get();
        $res = Service::where('id', $id)->delete();
        return $users1;
    }
}
