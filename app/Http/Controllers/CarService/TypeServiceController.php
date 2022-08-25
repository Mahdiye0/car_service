<?php

namespace App\Http\Controllers\CarService;

use App\Models\TypeService;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CarService\TypeServiceRepository;
use App\Http\Requests\TypeServiceRequest;

class TypeServiceController extends Controller
{

    public $repo;

    public function __construct(TypeServiceRepository $repo)
    {
        $this->repo=$repo;
    }

    public function contact()
    {
        return view('carservice.contact');
    }


    public function create()
    {
       return view('carservice.typeservice');
    }


    public function store(TypeServiceRequest $request)
    {
        $result=$this->repo->store($request);
        return redirect()->route('car-service.home')->with('swal-success',$result['swal']);
    }
}
