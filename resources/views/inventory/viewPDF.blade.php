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
        <div class="row">
            <div class="col-8">
                <div class="category-navigation">
                    <a href="/inventory/list/{{$category->id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> <span class="d-none d-lg-inline">edit</span></a>
                    <a href="{{route('create.pdf', ['category' => $category->id])}}" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> <span class="d-none d-lg-inline">Export PDF</span></a>
                </div>
                <div style=" width: 825px;background: #fff; padding: 20px;border-radius: 8px;">
                    @include('layout.pdfInventory',['category'=>$category])
                </div>
            </div>
            <div class="col-4">

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
                    <form method="post" action="/category/signature/save" class="sigPad" style="width: 403px; height: 300px; margin: 0 auto;" >
                        @csrf
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
            $('#wh').val($(this).attr('data-wh'));
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

