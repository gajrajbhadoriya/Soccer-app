<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    /**
     * (1)Store function allows you to store players data
     * (2)Laravel's Illuminate\Http\Request class provides an object-oriented way to interact
     * with the current HTTP request being handled by your application as well as retrieve the input,
     * cookies, and files that were submitted with the request.
     */
    public function store(Request $request)
    {
        try {
            $validator = validator()->make($request->all(), [
                'first_name'    => 'required|string',
                'last_name'     => 'required|string',
                'photo'         => 'required|nullable|image|mimes:jpg,png,jpeg|max:2048',
                'team_id'       => 'required|exists:teams,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'        => false,
                    'message'       => $validator->errors()->first(),
                    'errors'        => $validator->errors(),
                    'data'          => []
                ], 422);
            }

            $player = Player::create([
                'team_id'       => $request->input('team_id'),
                'first_name'    => $request->input('first_name'),
                'last_name'     => $request->input('last_name'),
                'photo'         => $request->file('photo')->store('public')
            ]);

            return response()->json([
                'success'    => 'Player Created',
                'message'    => $player
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error'      => 'failed to store data'
            ]);
        }
    }

    /**
     * With the index function, you can see the data of all the players.
     */
    public function index()
    {
        try {
            $players = Player::all();
            return response()->json([
                'status' => true,
                'data' => $players
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error'     => 'failed to retrieve player data'
            ], 422);
        }
    }

    /**
     * With the show function you can see the data of single players
     */
    public function show($playerId)
    {
        try {
            $player = Player::find($playerId);
            return response()->json([
                'status' => true,
                'data' => $player
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'player id not exist'
            ], 200);
        }
    }

    /**
     * With the update function you can update the data of single players
     */
    public function update(Request $request, $id)
    {
        $validator = validator()->make($request->all(), [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'photo'         => 'required|nullable|image|mimes:jpg,png,jpeg|max:2048',
            'team_id'       => 'required|exists:teams,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json([
                'status'        => false,
                'errors'        => $errors,
                'data'          => []
            ], 422);
        }

        $player = Player::find($id);
        if (!$player) {
            return response()->json([
                'status'        => false,
                'errors'        => 'Player not found',
                'data'          => []
            ], 404);
        } else {

            $player->update($request->all());

            return response()->json([
                'status'        => true,
                'message'       => 'Player updated successfully',
                'data'          => $player
            ], 200);
        }
    }

    /**
     * With the destroy function you can delete the data of single players
     */
    public function destroy(Player $id)
    {
        try {
            $id->delete();
            return response()->json([
                'status'        => null,
                'message'       => 'Data delete Successfully'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'id not match'
            ]);
        }
    }

    /**
     * With teamsPlayer you can see which players are in the particular team
     */
    public function teamsPlayer($id)
    {
        // $team = Player::with(['team'])->find(13);
        // dd($team->toArray());
        // return response()->json([
        //     'data' => $team
        // ]);
        try {
            $playerData = Player::join('teams', 'players.team_id', 'teams.id')
                ->select('players.id', 'players.first_name', 'players.last_name', 'teams.name')
                ->where('players.team_id', $id)
                ->get();

            if ($playerData->isEmpty()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'No player data found for the given team ID.'
                ], 404);
            }

            return response()->json([
                'status'    => true,
                'data'      => $playerData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'        => false,
                'message'       => 'An error occurred while fetching player data.'
            ], 500);
        }
    }
}
