@foreach($category->inventories->chunk(\App\Models\Pdf::_COUNTONPAGE) as $key => $inventoriesGroup)
    @include('layout.pdfInventory',['category'=>$category,'inventories' => $inventoriesGroup,'key' => $key,'page_length' => count($category->inventories->chunk(\App\Models\Pdf::_COUNTONPAGE))])
@endforeach
