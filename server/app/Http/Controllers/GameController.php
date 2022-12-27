<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request, User $user)
    {
        //...
    }

    public function getInvitablePlayers(Request $request, User $user)
    {
        Game::where('user_id', $user->id)
            ->where('status', '!=', 'finished')
            ->get()
            ->map(function ($game) {
                return $game->players;
            })
            ->flatten()
            ->pluck('id')
            ->push($user->id)
            ->unique()
            ->values()
            ->all();
    }

    public function invite(Request $request, User $user)
    {
        $request->validate([
            'invited_player_id' => 'required|uuid|exists:users,id',
        ]);

        if($user->id === $request->get('invited_player_id')) {
            return response()->json([
                'message' => 'You cannot invite yourself to a game.',
            ], 400);
        }

        if(Game::where('player_1_id', $user->id)->where('player_2_id', $request->get('invited_player_id'))->exists()) {
            return response()->json([
                'message' => 'You have already invited this player to a game or are playing with them.',
            ], 400);
        }

        Game::create([
            'player_1_id' => $user->id,
            'player_2_id' => $request->get('invited_player_id'),
        ]);


        return response('', 204);
    }


}
