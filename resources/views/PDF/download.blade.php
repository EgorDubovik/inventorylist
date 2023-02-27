@foreach($category->inventories->chunk(\App\Models\Pdf::_COUNTONPAGE) as $key => $inventoriesGroup)
    @include('layout.pdfInventory',['category'=>$category,'inventories' => $inventoriesGroup,'key' => $key,'page_length' => count($category->inventories->chunk(\App\Models\Pdf::_COUNTONPAGE))])
@endforeach
<div style="padding: 50px;">
    @if($category->remark)
        <div class="title_remarks">Remarks <span class="text-muted">Update at {{$category->remark->updated_at}}</span> </div>
        <p class="text-remarks">
            {{$category->remark->description}}
        </p>
    @else
        <div class="title_remarks">Remarks</div>
        <p class="text-remarks text-muted">
            No remarks
        </p>
    @endif
</div>
<div style="padding: 15px;">
    @include('PDF.signature-table-view',['category'=>$category])
</div>
