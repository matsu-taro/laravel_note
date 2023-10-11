<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Requests\StoreRequest;

class NoteController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $memos = Note::where('user_id', $user['id'])->where('status', 1)->orderBy('updated_at', 'desc')->paginate(10);

        return view('notes.index', compact('user', 'memos'));
    }

    public function store(StoreRequest $request)
    {

        Note::create([
            'title' => $request->title,
            'content' => $request->content,
            'tag_id' => $request->tag_id,
            'user_id' => $request->user_id,
            'status' => 1,
        ]);

        return redirect()->back();
    }

    public function dust_item()
    {
        $user = \Auth::user();
        $memos = Note::where('user_id', $user['id'])->where('status', 2)->orderBy('updated_at', 'desc')->paginate(10);

        return view('notes.dust_item', compact('user', 'memos'));
    }

    public function edit(string $id)
    {

        $user = \Auth::user();
        $memos = Note::where('user_id', $user['id'])->where('status', 1)->orderBy('updated_at', 'desc')->paginate(10);
        $memo = Note::where('status', 1)->where('id', $id)->where('user_id', $user['id'])
            ->first();

        $editP_id = $id;

        return view('notes.edit', compact('user', 'memos', 'memo', 'editP_id'));
    }


    public function edit_tag(string $tag_id)
    {

        $user = \Auth::user();
        $memos = Note::where('user_id', $user['id'])->where('status', 1)->where('tag_id', $tag_id)->orderBy('updated_at', 'desc')->paginate(10);
        $memo_all = Note::where('user_id', $user['id'])->where('status', 1)->orderBy('updated_at', 'desc')->paginate(10);

        $tag = $tag_id;


        return view('notes.edit_tag', compact('user', 'memos', 'tag'));
    }

    public function update(StoreRequest $request, string $id)
    {
        $update = Note::find($id);

        $update->title = $request->title;
        $update->content = $request->content;
        $update->tag_id = $request->tag_id;
        $update->save();

        return to_route('notes.index');
    }

    public function back(Request $request, string $id)
    {
        $back = Note::find($id);
        $back->status = 1;
        $back->save();

        return redirect()->back();
    }

    public function dust(Request $request, string $id)
    {
        $dust_data = Note::find($id);
        $dust_data->status = 2;
        $dust_data->save();
    
        return redirect()->back();
    }

    public function edit_page_dust(string $id)
    {
        $dust_data = Note::find($id);
        $dust_data->status = 2;
        $dust_data->save();

        return to_route('notes.index');
    }

    public function destroy(string $id)
    {
        $done = Note::find($id);
        $done->delete();

        return redirect()->back();
    }
}
