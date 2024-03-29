@extends('layout.main')

@section('content')

    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Inventory list for <span style="color:#9f9f9f;">{{$category->customer_name}}</span></h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Apps</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Inventory list</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- CONTENT -->
        <div class="row justify-content-md-center">
            <div class="col-lg-6">
                <div class="category-navigation row">
                    <div class="col-2">
                        <a href="{{route('create.pdf', ['category' => $category->id])}}" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> <span class="d-none d-lg-inline">Export PDF</span></a>
                    </div>
                    @can('update', $category)
                        <div class="col-2">
                            <a href="/inventory/list/{{$category->id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> <span class="d-none d-lg-inline">edit</span></a>
                        </div>
                    @endcan
                    <div class="col-8" style="text-align: right">
                        <span class="text-muted" style="margin-left: 20px;"> Status: </span>
                        <span>{{\App\Models\InventoryCategory::STATUS[$category->status]}}</span>
                        @can('update',$category)
                            @if($category->status==0)
                                <a href="{{route('change.status',['category'=>$category,'status' => \App\Models\InventoryCategory::PICKED_UP])}}" class="btn btn-blue" style="margin-left: 10px;">Change to PICKED UP</a>
                            @elseif($category->status==1)
                                <a href="{{route('change.status',['category'=>$category,'status' => \App\Models\InventoryCategory::DELIVERED])}}" class="btn btn-blue" style="margin-left: 10px;">Change to DELIVERED</a>
                            @endif
                        @endcan
                    </div>
                </div>
                @foreach($category->inventories->chunk(\App\Models\Pdf::_COUNTONPAGE) as $key => $inventoriesGroup)
                    <div style="background: #fff; padding: 10px 20px;border-radius: 8px; margin: 10px 0;">
                        @include('layout.pdfInventory',['category'=>$category,'inventories' => $inventoriesGroup,'key' => $key, 'page_length' => count($category->inventories->chunk(\App\Models\Pdf::_COUNTONPAGE))])
                    </div>
                @endforeach
                <div style="background: #fff; padding: 10px 20px;border-radius: 8px; margin: 10px 0;">
                    @if($category->remark)
                    <div class="title_remarks">Remarks <span class="text-muted">Update at {{$category->remark->updated_at}}</span> </div>
                    <p class="text-remarks">
                        {{$category->remark->description}}
                    </p>
                    @else
                        <div class="title_remarks">Remarks</div>
                        <p class="text-remarks text-muted">
                            Add remarks on signature pad
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        Signature pad
                    </div>
                    <div class="card-body">
                        <table class="sign-table">
                            <tr >
                                <td style="width:8%;" rowspan="2"><p class="s12" style="padding-top: 7pt;text-indent: 8pt;text-align: center;">AT ORIGIN</p></td>
                                @if($category->signatures->contains('wh',\App\Models\Signatures::CARRIER_AT_ORIGIN))
                                    <td style="width:30%">
                                        <p>CARRIER SIGNATURE</p>
                                        <p class="signature" class="signature">
                                            <img width="79" src="{{$category->signatures->where('wh',\App\Models\Signatures::CARRIER_AT_ORIGIN)->first()->signature}}">
                                        </p>
                                    </td>
                                    <td style="width:11%">
                                        <p style="text-align: center">DATE</p>
                                        <p style="text-align: center;padding-top: 5px;font-size: 10px;">{{\Carbon\Carbon::parse($category->signatures->where('wh',\App\Models\Signatures::CARRIER_AT_ORIGIN)->first()->updated_at)->format('m/d/Y')}}</p>
                                    </td>
                                @else
                                    <td style="width:30%">
                                        <p>CARRIER SIGNATURE</p>
                                        <p class="signature">
                                            @if(!isset($print)) <button class="sign-btn" data-bs-toggle="modal" data-bs-target="#input-modal" data-wh="{{\App\Models\Signatures::CARRIER_AT_ORIGIN}}">Sign</button>@endif
                                        </p>
                                    </td>
                                    <td style="width:11%"><p class="s5" style="padding-left: 27pt;text-indent: 0pt;line-height: 7pt;text-align: left;">DATE</p></td>
                                @endif
                                <td style="width:8%" rowspan="2"><p class="s13" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">AT DESTINATION</p></td>
                                @if($category->signatures->contains('wh',\App\Models\Signatures::CARRIER_AT_DESTINATION))
                                    <td style="width: 30%">
                                        <p>CARRIER SIGNATURE</p>
                                        <p class="signature">
                                            <img width="79" src="{{$category->signatures->where('wh',\App\Models\Signatures::CARRIER_AT_DESTINATION)->first()->signature}}">
                                        </p>
                                    </td>
                                    <td style="width:11%">
                                        <p style="text-align: center">DATE</p>
                                        <p style="text-align: center;padding-top: 5px;font-size: 10px;">{{\Carbon\Carbon::parse($category->signatures->where('wh',\App\Models\Signatures::CARRIER_AT_DESTINATION)->first()->updated_at)->format('m/d/Y')}}</p>
                                    </td>
                                @else
                                    <td style="width:30%">
                                        <p>CARRIER SIGNATURE</p>
                                        <p class="signature">
                                            @if(!isset($print)) <button class="sign-btn" data-bs-toggle="modal" data-bs-target="#input-modal" data-wh="{{\App\Models\Signatures::CARRIER_AT_DESTINATION}}">Sign</button>@endif
                                        </p>
                                    </td>
                                    <td style="width:11%"><p class="s5" style="padding-left: 27pt;text-indent: 0pt;line-height: 7pt;text-align: left;">DATE</p></td>
                                @endif
                            </tr>
                            <tr >
                                @if($category->signatures->contains('wh',\App\Models\Signatures::CUSTOMER_AT_ORIGIN))
                                    <td>
                                        <p>CUSTOMER SIGNATURE</p>
                                        <p class="signature">
                                            <img width="79" src="{{$category->signatures->where('wh',\App\Models\Signatures::CUSTOMER_AT_ORIGIN)->first()->signature}}">
                                        </p>
                                    </td>
                                    <td>
                                        <p style="text-align: center">DATE</p>
                                        <p style="text-align: center;padding-top: 5px;font-size: 10px;">{{\Carbon\Carbon::parse($category->signatures->where('wh',\App\Models\Signatures::CUSTOMER_AT_ORIGIN)->first()->updated_at)->format('m/d/Y')}}</p>
                                    </td>
                                @else
                                    <td>
                                        <p>CUSTOMER SIGNATURE</p>
                                        <p class="signature">
                                            @if(!isset($print)) <button class="sign-btn" data-bs-toggle="modal" data-bs-target="#input-modal" data-wh="{{\App\Models\Signatures::CUSTOMER_AT_ORIGIN}}">Sign</button>@endif
                                        </p>
                                    </td>
                                    <td><p class="s5" style="padding-left: 27pt;text-indent: 0pt;line-height: 7pt;text-align: left;">DATE</p></td>
                                @endif
                                @if($category->signatures->contains('wh',\App\Models\Signatures::CUSTOMER_AT_DESTINATION))
                                    <td>
                                        <p>CUSTOMER SIGNATURE</p>
                                        <p class="signature">
                                            <img width="79" src="{{$category->signatures->where('wh',\App\Models\Signatures::CUSTOMER_AT_DESTINATION)->first()->signature}}">
                                        </p>
                                    </td>
                                    <td>
                                        <p style="text-align: center">DATE</p>
                                        <p style="text-align: center;padding-top: 5px;font-size: 10px;">{{\Carbon\Carbon::parse($category->signatures->where('wh',\App\Models\Signatures::CUSTOMER_AT_DESTINATION)->first()->updated_at)->format('m/d/Y')}}</p>
                                    </td>
                                @else
                                    <td>
                                        <p>CUSTOMER SIGNATURE</p>
                                        <p class="signature">
                                            @if(!isset($print)) <button class="sign-btn" data-bs-toggle="modal" data-bs-target="#input-modal" data-wh="{{\App\Models\Signatures::CUSTOMER_AT_DESTINATION}}">Sign</button>@endif
                                        </p>
                                    </td>
                                    <td><p class="s5" style="padding-left: 27pt;text-indent: 0pt;line-height: 7pt;text-align: left;">DATE</p></td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="input-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">New inventory item</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="return false;">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/category/signature/save" class="sigPad" style="width: 403px;  margin: 0 auto;" >
                        @csrf

                        <div class="form-group" id="remarks_cont" style="display: none">
                            <h2 style="text-align: left">Add remarks</h2>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="remark" rows="3">{!! ($category->remark) ? $category->remark->description : "" !!}</textarea>
                        </div>
                        <input type="hidden" name="wh" id="wh" value="">
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <ul class="sigNav" style="display: block;">
                            <li class="clearButton" style="display: list-item;"><a href="#clear">Clear</a></li>
                        </ul>
                        <div class="sig sigWrapper current" style="height: 219px;">
                            <canvas class="pad" width="400" height="200"></canvas>
                            <input type="hidden" name="output" class="output" value="">
                            <input type="hidden" name="base64" id="base64" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">Accept</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')

    <script src="{{ URL::asset('assets/js/jquery.signaturepad.js')}}"></script>
    <script src="{{ URL::asset('assets/js/json2.min.js')}}"></script>

    <script>
        $('.sign-btn').click(function(){
            var datawh = $(this).attr('data-wh');
            $('#wh').val(datawh);
            if(datawh == "cusorg" || datawh == "cusdest"){
                $('#remarks_cont').show();
            }
        });

        $(document).ready(function() {
            var apis = $('.sigPad').signaturePad({
                drawOnly:true,
                drawBezierCurves:true,
                lineTop:200,
                onDrawEnd : function (){
                    console.log('end');
                    $('#base64').val(apis.getSignatureImage());
                }
            });

        });



    </script>
@stop

