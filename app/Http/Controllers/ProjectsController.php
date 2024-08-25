<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Http\Requests\StoreProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;

class ProjectsController extends Controller
{
    public function index()
    {
        return response()->json([
			'data' => Projects::get()
		], 201);
    }

    public function store(StoreProjectsRequest $request)
    {
        return response()->json([
			'data' => Projects::create($request->only(["name", "type"]))
		], 201);
    }

    public function edit(Projects $projects)
    {
        return response()->json([
            'data' => Projects::create($projects->only(["name", "type"]))
        ], 201);
    }

    public function destroy(Projects $projects)
    {
        return response()->json([
            'data' => $projects->delete()
        ], 204);
    }
}
