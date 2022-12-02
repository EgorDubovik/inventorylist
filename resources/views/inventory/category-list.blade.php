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
                        @can('create', \App\Models\InventoryCategory::class)
                            <a href="/category/create" class="btn btn-success" style="margin-left: 20px;"><i class="fa fa-plus"></i> Create new inventory category</a>
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
                                <th>Count items</th>
                                <th style="width: 270px">Actions</th>
                            </tr>
                            </thead>
                            @foreach($category as $c)
                                <tr>
                                    <td>{{$c->id}}</td>
                                    <td>{{\Carbon\Carbon::parse($c->created_at)->diffForHumans()}}</td>
                                    <td>{{$c->creater->name}}</td>
                                    <td>{{$c->customer_name}}</td>
                                    <td>{{$c->customer_address}}</td>
                                    <td>{{$c->inventories->count()}}</td>
                                    <td>

                                        <form action="/category/remove/{{$c->id}}" method="post" onsubmit="confirm_remove(this);return false">
                                            @csrf
                                            @method('delete')
{{--                                            <a href="/inventory/list/{{$c->id}}" class="btn btn-success"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">view</span></a>--}}
                                            <a href="{{route('view.category', ['category'=>$c->id])}}" class="btn btn-success"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">view</span></a>

                                            @can('update', $c)
                                                <a href="/inventory/list/{{$c->id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> <span class="d-none d-lg-inline">edit</span></a>
                                            @endcan
                                            @can('delete', $c)
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> <span class="d-none d-lg-inline">remove</span></button>
                                            @endcan
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        function confirm_remove(f){
            if(confirm('Are you sure ?')){
                f.submit();
            }

        }
    </script>
@endsection
