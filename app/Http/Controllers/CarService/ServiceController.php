<?php

namespace App\Http\Controllers\CarService;

use App\Models\City;
use App\Models\County;
use App\Models\Service;
use App\Models\Province;
use App\Models\TypeService;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CarService\ServicesRepository;
use App\Http\Requests\ServiceRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Support\Carbon;

class ServiceController extends Controller
{
    public $repo;

    public function __construct(ServicesRepository $repo)
    {
        $this->repo=$repo;
    }

    public function index()
    {
        $result=$this->repo->index();
        return view('carservice.service.index')->with(['users'=>$result['users']]);
    }


    public function create()
    {
        $result=$this->repo->create();
        if ($result['status']) {
            return view('carservice.service.create')->with(['type_services'=>$result['type_services'],'provinces'=>$result['provinces']]);
        } else {
            return redirect()->route('car-service.service.index')->with('swal', $result['swal-access-denied']);
        }
    }


    public function store(ServiceRequest $request, ImageService $imageservice)
    {
        $result=$this->repo->store($request,$imageservice);
        return redirect()->route('car-service.service.index')->with('swal-success',  $result['swal']);
    }


    public function edit($id)
    {
        $result=$this->edit->store($id);
        return view('carservice.service.edit')
        ->with([
            'data'=>$result['data'],
            'type_services'=>$result['type_services'],
            'provinces'=>$result['provinces'],
            'counties'=>$result['counties'],
            'cities'=>$result['cities'],
        ]);
    }


    public function update(ServiceRequest $request, Service $service)
    {
        $result=$this->edit->update($request,$service);
        return redirect()->route('car-service.service.index')->with('swal-success', $result['swal']);
    }


    public function destroy(Service $service)
    {
        return deleteRecord($service,'service.index');
    }
}
