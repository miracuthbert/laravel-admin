<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Metrics\User\UserMetrics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UserStatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if (Gate::denies('browse users')) {
            return abort(404);
        }

        // suggestion: you can add filter scope
        $users = User::stats()->get();

        $metrics = (new UserMetrics($users))->getStats();

        return response()->json([
            'data' => $metrics,
        ]);
    }
}
