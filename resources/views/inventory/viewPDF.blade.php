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
            <div class="col-12">
                <div class="category-navigation">
                    <a href="/inventory/list/{{$category->id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> <span class="d-none d-lg-inline">edit</span></a>
                </div>
                @include('layout/pdfinventory',['category'=>$category])
            </div>
        </div>
    </div>

    <div class="modal fade" id="input-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <form method="post" action="/inventory/create">
                    <div class="modal-header">
                        <h6 class="modal-title">New inventory item</h6>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="return false;">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body ui-front">
                        @csrf
                        <input type="hidden" name="cid" value="{{$category->id}}">
                        <input type="hidden" name="wh">
                        <div class="mb-3">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="lale-number-f" class="col-form-label">Label number:</label>
                                    <input type="text" class="form-control" id="label-number-f" name="label_number" value="{{($category->inventories->last()) ? ($category->inventories->last()->number+1) : 1}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lale-count" class="col-form-label">Count:</label>
                                    <input type="text" class="form-control" id="label-number-f" name="count" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 ui-widget">
                            <label for="furniture" class="col-form-label">Furniture:</label>
                            <input type="text" class="form-control" id="furniture" name="furniture">
                        </div>
                        <div class="mb-3">
                            <label for="condition" class="col-form-label">Condition:</label>
                            <input type="text" class="form-control" id="condition" name="condition" value="good">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit">Save</button>
                        <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $('.sign-btn').click(function(){
            $('#wh').val($(this).attr('data-wh'));
        })
    </script>
@stop

