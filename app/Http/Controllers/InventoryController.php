<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function view_categorys(){

        return view('inventory.category-list');
    }

    public function create_inventory_category(){
        $this->authorize('create-inventory-category');

        return view('inventory.category-create');
    }

    public function store_inventory_category(Request $request){
        $this->authorize('create-inventory-category');

        $validated = $request->validate([
            'customer_name' => 'required',
            'customer_address' => 'required',
        ]);

        $category = InventoryCategory::create([
            'user_id' => Auth::user()->id,
            'customer_name' => $request->customer_name,
            'customer_address' => $request->customer_address,
        ]);

        return redirect('/inventory/list/'.$category->id)->with('successful', 'Inventory category hass bed created successful');
    }

    public function list(Request $request, InventoryCategory $category){

        return view('inventory.list');
    }
}
