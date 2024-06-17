<?php

namespace App\Http\Controllers\Dashbord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashbord\StoreAdminRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $service;
    public function __construct($service)
    {

    }
    public function store(StoreAdminRequest $request)
    {
        return $this->service->store($request);
    }
}
