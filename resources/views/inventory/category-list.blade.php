@extends('layout.main')

@section('content')

    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Inventory category</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Apps</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Inventory category</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- CONTENT -->
        <div class="row">
            <div class="col-12">
                @include('layout/success-message',['status' => 'successful'])
                <div class="card">
                    <div class="card-header">
                        Inventory category list
                        @can('create-inventory-category')
                            <a href="/inventory/category/create" class="btn btn-success" style="margin-left: 20px;"><i class="fa fa-plus"></i> Create new inventory category</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date create</th>
                                <th>Created by</th>
                                <th>Customer name</th>
                                <th>Customer address</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            @foreach($category as $c)
                                <tr>
                                    <td>{{$c->id}}</td>
                                    <td>{{\Carbon\Carbon::parse($c->created_at)->diffForHumans()}}</td>
                                    <td>{{$c->creater->name}}</td>
                                    <td>{{$c->customer_name}}</td>
                                    <td>{{$c->customer_address}}</td>
                                    <td><a href="/inventory/list/{{$c->id}}" class="btn btn-success"><i class="fa fa-eye"></i> view</a> </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
