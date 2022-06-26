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
                @include('layout/success-message',['status' => 'successful'])
                @if($errors->any())
                    @include("layout/error-message")
                @endif
                <div class="card">
                    <div class="card-header">
                        Inventory list
                        @can('create-inventory', $category)
                            <a href="/inventory/create" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#input-modal" style="margin-left: 20px;"><i class="fa fa-plus"></i> Add new furniture</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Stik number</th>
                                <th>Furniture</th>
                                <th>Condition</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category->inventories as $invetory)
                                <tr>
                                    <td>{{$invetory->number}}</td>
                                    <td>{{$invetory->furniture_name}}</td>
                                    <td>{{$invetory->condition}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="input-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <form method="post" action="/inventory/create">
                <div class="modal-header">
                    <h6 class="modal-title">New message to @mdo</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                        @csrf
                        <input type="hidden" name="cid" value="{{$category->id}}">
                        <input type="hidden" name="lastnumber" value="0">
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
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Furniture:</label>
                            <input type="text" class="form-control" id="furniture" name="furniture">
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
