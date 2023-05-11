<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{
    /**
     * Store function allows you to store teams data
     */
    public function store(Request $request)
    {
        try {
            $validator = validator()->make($request->all(), [
                'name'          => 'required|string',
                'logo'          => 'required|image|mimes:jpg,png,jpeg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'        => false,
                    'message'       => $validator->errors()->first(),
                    'errors'        => $validator->errors(),
                    'data'          => []
                ], 422);
            }

            $team = Team::create([
                'name'      => $request->input('name'),
                'logo'      => $request->file('logo')->store('public')
            ]);

            return response()->json([
                'success'   => 'Team Created',
                'message'   => $team
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error'     => 'Failed to store data'
            ]);
        }
    }

    /**
     * With the index function, you can see the data of all the teams.
     */
    public function index()
    {
        try {
            $teams = Team::all();
            return response()->json([
                'status'    => true,
                'data'      => $teams
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error'     => 'failed to retrieve data'
            ], 500);
        }
    }

    /**
     * With the show function you can see the data of single Teams
     */
    public function show($teamId)
    {
        try {
            $team = Team::find($teamId);
            return response()->json([
                'status'    => true,
                'data'      => $team
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error'     => 'player id not exist'
            ], 200);
        }
    }

    /**
     * With the update function you can update the data of single teams
     */
    public function update(Request $request, Team $id)
    {
        $validator = validator()->make($request->all(), [
            'name'      => 'required',
            'logo'      => 'nullable|image|max:2048'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status'        => false,
                'errors'        => $errors,
                'data'          => []
            ], 422);
        }

        $id->update($request->all());

        return response()->json([
            'status'    => true,
            'data'      => $id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $id)
    {
        $id->delete();

        return response()->json([
            'status'        => null,
            'message'       => 'data delete successfully'
        ], 200);
    }
}
