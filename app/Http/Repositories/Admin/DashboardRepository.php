<?php

namespace App\Http\Repositories\Admin;

use App\Models\User;

class DashboardRepository{

    public function index()
    {
        return User::where('verification', 0)->get();
    }
}
