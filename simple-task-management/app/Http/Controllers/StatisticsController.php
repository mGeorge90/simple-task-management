<?php

namespace app\Http\Controllers;

use App\Http\Resources\StatisticsResource;
use App\Models\Statistics;

class StatisticsController extends Controller
{
    public function index()
    {
        $statistics = Statistics::limit(10)->with(['user'])->orderBy('task_count', 'DESC')->get();
        return response()->json(StatisticsResource::collection($statistics), 200);
    }
}
