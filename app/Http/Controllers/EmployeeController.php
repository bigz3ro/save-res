<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeRepository;

class EmployeeController extends Controller
{
    public function __construct(EmployeeRepository $staffRepo)
    {
        $this->staffRepo = $staffRepo;
    }

    public function index(Request $request)
    {

    }
}
