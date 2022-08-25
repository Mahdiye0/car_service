<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\DashboardRepository;

class DashboardController extends Controller
{
    public $repo;

    public function __construct(DashboardRepository $repo)
    {
        $this->repo=$repo;
    }

    public function index()
    {
        $users1 = $this->repo->index();
        return view('admin.index', compact('users1'));
    }
}
