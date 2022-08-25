<?php

namespace App\Http\Repositories\CarService;

use App\Models\TypeService;

class TypeServiceRepository{

    public function store($request)
    {
        date_default_timezone_set('asia/tehran');
        $inputs = $request->validated();
        TypeService::create($inputs);
        return ['swal'=>'درخواست شما توسط مدیریت بررسی میشود.در صورت تمایل میتوانید با شماره اضطراری زیر تماس بگیرید: 091334839849'];
    }
}
