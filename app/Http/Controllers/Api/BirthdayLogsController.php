<?php

namespace App\Http\Controllers\Api;

use App\Models\Birthday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BirthdayLogsController extends Controller
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
        $students = $request->all();

        Birthday::create([
            'students' => $students,
            'count' => count($students),
        ]);

        return response([], 201);
    }
}
