<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Models\InventoryList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{


    public function index(Request $request, InventoryCategory $category){
        return view('inventory.list',['category' => $category]);
    }

    public function store(Request $request){
        $category = InventoryCategory::find($request->cid);
        $this->authorize('create-inventory', $category);

        $validate = $request->validate([
            'cid' => 'required',
            'label_number' => 'required',
            'count' => 'required',
            'furniture' => 'required',
        ],
        [
            'cid.required' => 'System error, please try again later',
            'label_number.required' => 'Label number is required',
            'count.required' => 'Count labels id required',
            'furniture.required' => 'Furniture name is required',
        ]);

        for ($i = 0; $i<$request->count; $i++) {
            InventoryList::create([
                'category_id' => $request->cid,
                'number' => ($i+$request->label_number),
                'condition' => $request->condition,
                'furniture_name' => $request->furniture,
            ]);
        }

        return redirect()->route('inventory.list',['category' => $category->id]);
    }

    public function destroy(InventoryList $inventoryList){

        $this->authorize('update-inventory', $inventoryList->category);
        $inventoryList->delete();
        return redirect()->route('inventory.list',['category' => $inventoryList->category->id]);
    }
}
