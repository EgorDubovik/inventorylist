<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Models\InventoryList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryCategoryController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(InventoryCategory::class,'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = InventoryCategory::where('company_id',Auth::user()->company_id)->orderByDesc('created_at') ->get();
        return view('inventory.category-list', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.category-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'customer_address' => 'required',
        ]);

        $category = InventoryCategory::create([
            'user_id' => Auth::user()->id,
            'company_id' => Auth::user()->company_id,
            'customer_name' => $request->customer_name,
            'customer_address' => $request->customer_address,
        ]);

        return redirect('/inventory/list/'.$category->id)->with('successful', 'Inventory category hass bed created successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  InventoryCategory $category
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryCategory $category)
    {
        return view('inventory.category-edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  InventoryCategory $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryCategory $category)
    {
        $validated = $request->validate([
            'customer_name' => 'required',
            'customer_address' => 'required',
        ]);

        $category->update([
            'customer_name' => $request->customer_name,
            'customer_address' => $request->customer_address,
        ]);

        return redirect()->route('categories')->with('successful','Category has been update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  InventoryCategory $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryCategory $category)
    {
        InventoryList::where('category_id',$category->id)->delete();
        $category->delete();
        return redirect('/category')->with('successful', 'Category has been removed successful');
    }

}
