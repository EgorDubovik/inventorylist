<?php

namespace App\Http\Controllers;

use App\Models\InventoryCategory;
use App\Models\InventoryImages;
use App\Models\InventoryList;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;


class InventoryController extends Controller
{

    public function index(Request $request, InventoryCategory $category){

        $this->authorize('view-category', $category);
        $items = Item::where('company_id', Auth::user()->company_id)->pluck('title')->toArray();
        return view('inventory.list',['category' => $category,'items'=>$items]);

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

        $blankets = ($request->blankets) ? $request->blankets : 0;
        $pices = ($request->count && $request->count>0) ? $request->count : 1;
        $r = ceil($blankets/$pices);
        for ($i = 0; $i<$pices; $i++) {
            $res = 0;
            if ($blankets>0){
                $res = ($blankets - $r > 0) ? $r : $blankets;
                $blankets -= $r;
            }
            InventoryList::create([
                'category_id' => $request->cid,
                'number' => ($i+$request->label_number),
                'condition' => $request->condition,
                'furniture_name' => $request->furniture,
                'blankets' => $res,
            ]);
        }

        return redirect()->route('inventory.list',['category' => $category->id]);
    }

    public function destroy(InventoryList $inventoryList){
        $this->authorize('update-inventory', $inventoryList->category);
        $inventoryList->delete();
        return redirect()->route('inventory.list',['category' => $inventoryList->category->id]);
    }

    public function edit(InventoryList $inventory){
        $this->authorize('update-inventory', $inventory->category);

        return view('inventory.inventory-edit', ['inventory' => $inventory]);
    }

    public function update(Request $request, InventoryList $inventory){

        $this->authorize('update-inventory', $inventory->category);
        $validate = $request->validate([
            'label_number' => 'required',
            'furniture' => 'required',
            'condition' => 'required',
        ],[
            'label_number.required' => 'Label number is required',
            'furniture.required' => 'Furniture name is required',
        ]);
        $inventory->update([
            'label_number' => $request->label_number,
            'furniture_name' => $request->furniture,
            'condition' => $request->condition,
        ]);

        return redirect()->route('inventory.list',['category' => $inventory->category->id]);

    }

    public function images_upload(InventoryList $inventory){
        $this->authorize('update-inventory', $inventory->category);
        return view('inventory.images-uploads',['inventory' => $inventory]);
    }

    public function images_store(Request $request, InventoryList $inventory){

        $this->authorize('update-inventory', $inventory->category);

        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $pictures = $request->file('images');
        foreach ($pictures as $picture) {
            $fileName = time() . '_' . $picture->getClientOriginalName();
            $image = Image::make($picture);
            if ($image->width() > env('UPLOAD_WIDTH_SIZE'))
                $image->resize(env('UPLOAD_WIDTH_SIZE'), null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $image->save(storage_path('app/public/images/'.$fileName));
            InventoryImages::create([
                'inventory_id'   => $inventory->id,
                'path'           => 'storage/images/' . $fileName,
                'creator_id'     => Auth::user()->id,
            ]);
        }
        return back();
    }

    public function view_image(Request $request, InventoryImages $image, $filename){
        Gate::authorize('show-images',['image' => $image]);
        return Image::make(storage_path('app/public/images/'.$filename))->response();
    }

}
