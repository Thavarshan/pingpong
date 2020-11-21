<?php

namespace App\Http\Controllers\Api;

use App\Models\Run;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RunLogsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Run::create($request->all());

        return response([], 201);
    }
}
