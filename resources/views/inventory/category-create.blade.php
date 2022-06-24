@extends('layout.main')

@section('content')

    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Create new inventory category</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Apps</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create new inventory category</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- CONTENT -->
        <div class="row">
            <div class="col-12">
                <div class="col-xl-6 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create new inventory category</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                @include("layout/error-message")
                            @endif
                            <form method="post">
                                @csrf
                                <div class="row mb-4">
                                    <label for="inputName" class="col-md-3 form-label">Customer Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="inputName" placeholder="Customer Name" name="customer_name" value="{{old('customer_name')}}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="inputEmail3" class="col-md-3 form-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="address" class="form-control" id="inputEmail3" placeholder="Customer address" name="customer_address" value="{{old('customer_address')}}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
