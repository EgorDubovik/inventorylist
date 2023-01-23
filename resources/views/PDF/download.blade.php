@foreach($inventoriesGroup->chunk(74) as $inventoriesGroup)
    @include('layout.pdfInventory',['category'=>$category,'inventories' => $inventoriesGroup])
@endforeach
