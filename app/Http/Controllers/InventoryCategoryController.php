<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Addresses;
use App\Models\InventoryCategory;
use App\Models\InventoryList;
use App\Models\Remarks;
use App\Models\Signatures;
use App\Models\User;
use PDF;
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
    public function index(Request $request)
    {
        if ($request->has("search")){
            $category = InventoryCategory::where('order_number', 'LIKE', $request->search)
                ->orWhere('customer_name', 'LIKE', "%{$request->search}%")
                ->orderByDesc('created_at') ->get();
        } else {
            $category = InventoryCategory::where('company_id',Auth::user()->company_id)->orderByDesc('created_at') ->get();
        }
        return view('inventory.category-list', ['category' => $category,"search" => $request->has("search")]);
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
            'dest_customer_name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'dest_street' => 'required',
            'dest_city' => 'required',
            'dest_state' => 'required',
            'dest_zip' => 'required',
            'order_number' => 'required',
            'tape_lot_number' => 'required',
            'tape_color' => 'required',
            'van_number' => 'required',
            'customer_email' => 'required',
            'dest_customer_email' => 'required',
        ]);

        $address = Addresses::create([
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip
        ]);

        $dest_address = Addresses::create([
            'street' => $request->dest_street,
            'city' => $request->dest_city,
            'state' => $request->dest_state,
            'zip' => $request->dest_zip
        ]);

        $category = InventoryCategory::create([
            'user_id'               => Auth::user()->id,
            'company_id'            => Auth::user()->company_id,
            'customer_name'         => $request->customer_name,
            'customer_phone'        => $request->customer_phone,
            'dest_customer_name'    => $request->dest_customer_name,
            'dest_customer_phone'   => $request->dest_customer_phone,
            'address'               => $address->id,
            'dest_address'          => $dest_address->id,
            'order_number'          => $request->order_number,
            'tape_lot_number'       => $request->tape_lot_number,
            'tape_color'            => $request->tape_color,
            'van_number'            => $request->van_number,
            'customer_email'        => $request->customer_email,
            'dest_customer_email'   => $request->dest_customer_email,
        ]);

        return redirect()->route('inventory.list',['category' =>$category->id])->with('successful', 'Inventory category hass bed created successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryCategory $category)
    {
        return view('inventory.viewPDF',['category'=>$category]);
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
            'dest_customer_name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'dest_street' => 'required',
            'dest_city' => 'required',
            'dest_state' => 'required',
            'dest_zip' => 'required',
            'order_number' => 'required',
            'tape_lot_number' => 'required',
            'tape_color' => 'required',
            'van_number' => 'required',
            'customer_email' => 'required',
            'dest_customer_email' => 'required',
        ]);

        $category->update([
            'customer_name'         => $request->customer_name,
            'customer_phone'        => $request->customer_phone,
            'dest_customer_name'    => $request->dest_customer_name,
            'dest_customer_phone'   => $request->dest_customer_phone,
            'order_number'          => $request->order_number,
            'tape_lot_number'       => $request->tape_lot_number,
            'tape_color'            => $request->tape_color,
            'van_number'            => $request->van_number,
            'customer_email'        => $request->customer_email,
            'dest_customer_email'   => $request->dest_customer_email,
        ]);

        $category->addressM()->update([
            'street'=> $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip
        ]);

        $category->dest_addressM()->update([
            'street'=> $request->dest_street,
            'city' => $request->dest_city,
            'state' => $request->dest_state,
            'zip' => $request->dest_zip
        ]);


        return redirect()->route('inventory.list',['category' => $category])->with('successful','Category has been updated successful');
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


    public function signature_save(Request $request){
        $validated  = $request->validate([
            'category_id' => 'required',
            'base64' => 'required',
            'wh' => 'required'
        ]);

        if ($request->remark){
            Remarks::updateOrCreate(
                ['category_id' => $request->category_id],
                ['description' => $request->remark]
            );
        }

        Signatures::updateOrCreate([
            'category_id' => $request->category_id,
            'signature' => $request->base64,
            'wh' => $request->wh,
        ]);

        return redirect()->back();

    }

    public function createPDF(Request $request, InventoryCategory $category){

        $pdf = PDF::loadView('PDF.download',['category' => $category,'print'=>true]);
        return $pdf->stream();
    }

    public function assign_access(Request $request, InventoryCategory $category){

        $this->authorize('update-inventory', $category);

        // check if user id belongs to my company
        $my_users = User::employens(Auth::user()->company_id);
        if($my_users->contains('id',$request->user_id)){
            Access::updateOrCreate([
               'user_id' => $request->user_id,
                'category_id' => $category->id,
                'creator_id' => Auth::user()->id,
            ]);
        }
        return back();
    }

    public function access_remove(Request $request, User $user,InventoryCategory $category){
        $this->authorize('access-create-update', $category);
        $access = Access::where('category_id', $category->id)
                        ->where('user_id',$user->id);
        $access->delete();
        return back();
    }

    public function change_status(Request $request,InventoryCategory $category, $status){
        $this->authorize('update',$category);
        $category->update([
            'status' => $status,
        ]);
        return back();
    }

}
