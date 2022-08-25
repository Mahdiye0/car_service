<?php

namespace App\Http\Repositories\Admin;

use App\Models\County;
use App\Models\Province;
use App\Models\TypeService;
use App\Models\User;

class TypeServicesRepository
{

    public function index()
    {
        $users1 = User::where('verification', 0)->get();
        $type_services = TypeService::all();
        return ['users1' => $users1, 'type_services' => $type_services];
    }

    public function create()
    {
        return User::where('verification', 0)->get();
    }

    public function province($id)
    {
        $province = Province::find($id);
        $data = $province->counties()->get();
        return $data;
    }

    public function county($id)
    {
        $county = County::find($id);
        $data = $county->cities()->get();
        return $data;
    }

    public function store($request)
    {
        $users1 = User::where('verification', 0)->get();
        $inputs = $request->validated();
        TypeService::create($inputs);
        return $users1;
    }

    public function edit($id)
    {
        $users1 = User::where('verification', 0)->get();
        $data = TypeService::find($id);
        return ['users1'=>$users1, 'data' =>$data];
    }

    public function update($request,$type_service)
    {
        $users1 = User::where('verification', 0)->get();
        $inputs = $request->validated();
        $type_service->update($inputs);
        return $users1;
    }
}
