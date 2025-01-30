<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateBookmarkStoreRequest;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(ValidateBookmarkStoreRequest $request){
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
        return back()->with('bookmark', 'This coversion already exists.');
    }


    public function bookmark_list(Request $request){
        $validatedFilter = [];

        // for when filter data is included.
        if($request->has(['from', 'to'])){
            $validatedFilter = $this->validate_filter_input($request);
        }

        $bookmarks = Bookmark::when(!empty($validatedFilter), function($q) use($validatedFilter){
                                $q->where('from',$validatedFilter['from'])
                                ->where('to', $validatedFilter['to']);
                            })
                            ->where('user_id', Auth::user()->id)->paginate(8);


        return view('bookmark-list', compact('bookmarks'));
    }


    public function bookmark_delete($id){
        $bookmark = Bookmark::findOrFail($id);

        $bookmark->delete();

        return redirect()->route('bookmark.list')->with('message', 'Bookmark item is deleted.');
    }


    public function validate_filter_input($request){
        $validated_filter = $request->validate([
            'from' => 'string|in:USD,SGD,MYR,PHP,THB',
            'to' => 'string|in:USD,SGD,MYR,PHP,THB',
        ]);

        return $validated_filter;
    }
}
