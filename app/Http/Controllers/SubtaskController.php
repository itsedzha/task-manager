<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    public function update(Request $request, Subtask $subtask)
    {
        $validated = $request->validate([
            'completed' => 'required|boolean',
        ]);

        $subtask->update($validated);

        return redirect()->back()->with('success', 'Subtask updated successfully!');
    }

    public function destroy(Subtask $subtask)
    {
        $subtask->delete();

        return redirect()->back()->with('success', 'Subtask deleted successfully!');
    }
}

