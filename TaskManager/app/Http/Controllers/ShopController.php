<?php

namespace App\Http\Controllers;

use App\Models\BuyHistory;
use App\Models\Comment;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\AddItemRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ShopController extends Controller
{
    public function shopList() {
        $data = Item::all();

        $newData = array();
        for ($i = 0; $i < ceil(count($data)/4); $i++) {
            $length = count($data) - $i*4;
            for ($j = 0; $j < ($length >= 4 ? 4 : $length); $j++) {
                $index = $i * 4 + $j;
                $newData[$i][$j] = $data[$index];
            }
        }

        return view('shop_layouts.shop_list', ['data' => $newData]);
    }

    public function addItem(AddItemRequest $request) {
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $item = new Item();

        $item->title = $request->title;
        $item->desc = $request->desc;
        $item->short_desc = substr($request->desc, 0, 50).'...';
        $item->price = $request->price;
        $item->image = $imageName;
        $item->user_id = Auth::user()->id;

        if ($item->save()) return Redirect::route('shop.main')->with('success', 'Your profile has been successfully modified!');
        else return Redirect::back()->withErrors('smw', 'Something went wrong!');
    }

    public function showItem($id) {
        $item = Item::where('id', '=', $id)->first();
        if ($item == null)
            return Redirect::route('shop.main')->withErrors(['inf' => 'Item not found']);

        $comments = Comment::where('item_id', '=', $id)->get();

        return view('shop_layouts.item', ['item' => $item, 'comments' => $comments]);
    }

    public function addComment($itemId, CommentRequest $request) {
        if($itemId == null || Item::where('id', '=', $itemId)->first() == null)
            return Redirect::back()->withErrors('smw', 'Something went wrong!');

        $comment = new Comment();

        $comment->title = $request->title;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->item_id = $itemId;

        if($comment->save())
            return Redirect::back()->with('success', 'You have posted new comment!');
        else
            return Redirect::back()->withErrors('smw', 'Something went wrong!');
    }

    public function buyItem($id) {
        if(Item::where('id', '=', $id)->first() == null)
            return Redirect::back()->withErrors('smw', 'Something went wrong!');

        $buy = new BuyHistory();

        $buy->user_id = Auth::user()->id;
        $buy->item_id = $id;

        if($buy->save())
            return Redirect::back()->with('success', 'You have bought this item!');
        else
            return Redirect::back()->withErrors('smw', 'Something went wrong!');
    }

    public function showHistory() {
        $buyHistory = BuyHistory::where('user_id', '=', Auth::user()->id)->get();

        return view('shop_layouts.history', ['data' => $buyHistory]);
    }
}
