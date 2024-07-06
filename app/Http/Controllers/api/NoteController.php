<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notes = $user->notes()->get();
        return response()->json(['notes' => $notes], 200);
    }
    public function store(Request $request)
    {
        $data = $request->validate(['title' => 'required', 'content' => 'required']);
        $user = Auth::user();
        $note = $user->notes()->create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => $user->id,
        ]);
        return response()->json(['note' => $note], 200);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate(['title' => 'required', 'content' => 'required']);
        $user = Auth::user();
        $note = $user->notes()->findOrFail($id);
        $note->title = $data['title'];
        $note->content = $data['content'];
        $note->save();
        return response()->json(['message' => 'updated seuccusfully', 'note' => $note], 200);
    }
    public function destroy($id)
    {
        $user = Auth::user();
        $note = $user->notes()->findOrFail($id);
        $note->delete();
        return response()->json(['message' => 'Deleted seuccusfully', 'note-deleted' => $note], 200);
    }
    public function getFolderByNote($id)
    {
        $user = Auth::user();
        $note = $user->notes()->findOrFail($id);
        $folder = $note->folder;
        if ($folder) {
            return response()->json(['folder' => $folder], 200);
        } else {
            return response()->json(['message' => 'folder not found'], 404);
        }
    }
    public function moveNoteToFolder($noteID, $folderId)
    {
        $user = Auth::user();
        $note = $user->notes()->find($noteID);
        $folder = $user->folders()->find($folderId);
        if ($note && $folder) {
            $note->folder()->associate($folder);
            $note->save();

            return response()->json(['message' => 'Note moved successfully'], 200);
        } else {
            return response()->json(['message'=> 'note found folder or note'], 404);
        }
    }
}
