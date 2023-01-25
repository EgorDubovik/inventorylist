<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SettingsController extends Controller
{
    public function index(){

        $items = Item::where('company_id',Auth::user()->company_id)->get();
        return view('settings.index', ['items' => $items]);
    }

    public function add_item(Request $request){

        Gate::authorize('item-add');

        $validate = $request->validate([
            'title' => 'required',
        ],
        [
            'title.required' => 'Item title is require',
        ]);
        Item::updateOrCreate([
            'title' => $request->title,
            'company_id' => Auth::user()->company_id,
        ]);

        return back();
    }

    public function remove_item(Item $item){

        Gate::authorize('item-remove',['item'=>$item]);
        $item->delete();
        return back();
    }
}
