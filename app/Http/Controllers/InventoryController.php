<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{

    public function create_inventory_category(){

    }

    public function store_inventory_category(Request $request){

    }

    public function destroy_category(InventoryCategory $category){


    }

    public function list(Request $request, InventoryCategory $category){

        return view('inventory.list',['category' => $category]);
    }
}
