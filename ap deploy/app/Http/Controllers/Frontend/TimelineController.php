<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display the public timeline page.
     */
    public function index()
    {
        $timelines = Timeline::where('is_active', true)
            ->orderBy('year', 'desc')
            ->get();

        return view('frontend.timeline', compact('timelines'));
    }
}
