@extends('layout.main')

@section('content')

    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Apps</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- CONTENT -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Items list</div>
                    <div class="card-body">
                        @if($errors->any())
                            @include('layout/error-message')
                        @endif
                        @can('item-add')
                        <form method="post" action="{{route('settings.add.item')}}">
                            @csrf
                            <div class="input-group">
                                <input class="form-control" name="title"  placeholder="Item title"/>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-addon2">Add</button>
                                </div>
                            </div>
                        </form>
                        @endcan
                        <ul class="list-group list-group-flush">
                        @foreach($items as $item)
                            <li class="list-group-item">{{$item->title}}
                                @can('item-remove',['item'=>$item])
                                <span class="float-end">
                                    <span class="op-7 text-red"><a href="{{route('settings.remove.item',['item' => $item])}}" onclick="return confirm('Are your sure you want to delete this item?');"> <i class="fe fe-trash-2 text-red"></i></a></span>
                                </span>
                                @endcan
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop
