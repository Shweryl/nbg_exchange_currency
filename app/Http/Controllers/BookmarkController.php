<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(Request $request){
        // check the same conversion exists
        $bookmark = Bookmark::where('from',$request->from)
                                ->where('to', $request->to)
                                ->where('amount', $request->amount)
                                ->where('user_id', Auth::user()->id)
                                ->first();
        // if not exists, create new one
        if(!$bookmark){
            Bookmark::create([...$request->all(), 'user_id' => Auth::user()->id]);
            return redirect()->route('bookmark.list')->with('message', 'New Bookmark is added.');
        };
        // else return back with message
        return back()->with('message', 'This is already bookmarked.');
    }

    public function bookmark_list(){

        $bookmarks = Bookmark::when(request(['from','to']), function($q){
                                $q->where('from',request('from'))
                                ->where('to', request('to'));
                            })
                            ->where('user_id', Auth::user()->id)->get();

        return view('bookmark-list', compact('bookmarks'));
    }

    public function bookmark_delete($id){
        $bookmark = Bookmark::find($id);

        $bookmark->delete();

        return redirect()->route('bookmark.list');
    }
}
