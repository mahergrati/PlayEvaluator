<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Validator;

class PlayerController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'true',
            'message' => 'Players retrieved successfully',
            'players' => Player::all()

        ]);
    }

    public function playeradd(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'cin' => 'required|unique:players,cin',
            'role' => 'required',
            'team' => 'required',
            'score' => 'required|integer',
        ]);

        $player = Player::create($validatedData);

        return response()->json([
            'status' => 'true',
            'message' => 'Player added successfully',
            'player' => $player
        ], 201);
    }

    public function show()
    {
        $players = Player::all();
        return response()->json([
            'status' => 'true',
            'message' => 'Players retrieved successfully',
            'players' => $players
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate input if needed

        $validatedData = $request->validate([
            'name' => 'required',
            'cin' => 'required|unique:players,cin',
            'role' => 'required',
            'team' => 'required',
            'score' => 'required|integer',
        ]);


        // Find the player by ID
        $player = Player::findOrFail($id);

        // Update player attributes
        $player->name = $validatedData['name'];
        $player->cin = $validatedData['cin'];
        $player->role = $validatedData['role'];
        $player->team = $validatedData['team'];
        $player->score = $validatedData['score'];

        // Save the updated player
        $player->save();

        return response()->json(['message' => 'Player updated successfully', 'player' => $player]);

    }


    public function playerDelete($id)
    {
        $player = Player::find($id);
        if ($player) {
            $player->delete();
            return response()->json(['message' => 'Player deleted successfully']);
        } else {
            return response()->json(['message' => 'Player not found'], 404);
        }
    }
}
