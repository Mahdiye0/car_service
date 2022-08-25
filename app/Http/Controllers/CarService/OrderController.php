<?php

namespace App\Http\Controllers\CarService;

use App\Models\Order;
use App\Models\County;
use App\Models\Service;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CarService\OrderRepository;
use Carbon\Carbon;

class OrderController extends Controller
{
    public $repo;

    public function __construct(OrderRepository $repo)
    {
        $this->repo=$repo;
    }

    public function reportorder(Request $request, $user_id)
    {
        $orders =$this->repo->reportorder($request, $user_id);
        return view('carservice.report', compact('orders'));
    }


    public  function reportservice(Request $request, $user_id)
    {
        $orders =$this->repo->reportservice($request, $user_id);
        return view('carservice.report', compact('orders'));
    }


    public function index()
    {
        $provinces = Province::all();
        return view('carservice.order', compact('provinces'));
    }


    public function search_type_service($city_id, $type_service)
    {
         return $this->repo->search_type_service($city_id, $type_service);
    }


    public function search_report_service($user_id, $type_service)
    {
        return $this->repo->search_report_service($user_id, $type_service);
    }


    public function order_type_service($city_id)
    {
        return $this->repo->order_type_service($city_id);
    }


    public function county($id)
    {
        return $this->repo->county($id);
    }


    public function province($id)
    {
        return $this->repo->province($id);
    }


    public function store(Request $request)
    {
        $result=$this->repo->store($request);
        return redirect()->route('car-service.home')->with('swal-success', $result['swal']);
    }
}
