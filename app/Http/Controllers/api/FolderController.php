<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index()
    {
        $folders = Auth::user()->folders()->get();
        if ($folders) {
            return response()->json(['folders' => $folders], 200);
        } else {
            return response()->json(['message' => 'no folders'], 404);
        }
    }
    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        $folder = Auth::user()->folders()->create($request->all());
        return response()->json(['folder' => $folder], 200);
    }
    public function destroy($id)
    {
        $folder = Auth::user()->folders()->findOrFail($id);
        $folder->delete();
        return response()->json(['message' => 'deleted succuss'], 200);
    }
    public function update(Request $request, $id)
    {
        $request->validate(['title' => 'required']);
        $folder = Auth::user()->folders()->findOrFail($id);
        $folder->update($request->all());
        return response()->json(['message' => 'updated succussfully'], 200);
    }
    public function getNotesByFolder($id)
    {
        $notes = Auth::user()->notes()->where('folder_id', $id)->get();
        if (count($notes) > 0) {
            return response()->json(['notes' => $notes], 200);
        } else {
            return response()->json(['message' => 'empty folder'], 404);
        }
    }
}
