<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;

class ReactionController extends Controller
{
    //
    public function toggle(Request $request)
{
    $request->validate([
        'reactable_type' => 'required|in:App\Models\ForumPost,App\Models\ForumComment',
        'reactable_id'   => 'required|integer',
        'type'           => 'required|string'
    ]);

    $existing = Reaction::where([
        'user_id'        => auth()->id(),
        'reactable_type' => $request->reactable_type,
        'reactable_id'   => $request->reactable_id,
        'type'           => $request->type,
    ])->first();

    if ($existing) {
        $existing->delete();
        $status = 'removed';
    } else {
        Reaction::create([
            'user_id'        => auth()->id(),
            'reactable_type' => $request->reactable_type,
            'reactable_id'   => $request->reactable_id,
            'type'           => $request->type,
        ]);
        $status = 'added';
    }

    return response()->json(['status' => $status]);
}
}
