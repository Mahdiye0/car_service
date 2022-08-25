<?php

namespace App\Http\Controllers\CarService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CarService\HomeRepository;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public $repo;

    public function __construct(HomeRepository $repo)
    {
        $this->repo=$repo;
    }

    public function index()
    {
        if (Auth::guest()) {
            $type = 0; //میهمان
            return view('carservice.index', compact('type'));
        } else {
            return view('carservice.index');
        }
    }
}
