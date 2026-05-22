<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('status', 'published')
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($projects);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return response()->json($project);
    }
}