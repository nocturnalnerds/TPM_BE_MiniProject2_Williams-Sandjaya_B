<?php
namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $note = Note::create($request->only('title', 'content'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            NoteImage::create([
                'note_id' => $note->id,
                'image' => $imagePath
            ]);
        }

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $note = Note::findOrFail($id);
        $note->update($request->only('title', 'content'));

        if ($request->hasFile('image')) {
            if ($note->image) {
                Storage::disk('public')->delete($note->image->image);
                $note->image->delete();
            }

            $imagePath = $request->file('image')->store('images', 'public');
            NoteImage::create(['note_id' => $note->id, 'image' => $imagePath]);
        }

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    public function delete($id)
    {
        $note = Note::findOrFail($id);

        if ($note->image) {
            Storage::disk('public')->delete($note->image->image);
            $note->image->delete();
        }

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }
}
