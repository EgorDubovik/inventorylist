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
                <div class="col-xl-4 m-auto">
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
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Label number:</label>
                                    <input type="text" class="form-control" id="furniture" name="label_number" value="{{$inventory->number}}">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Furniture:</label>
                                    <input type="text" class="form-control" id="furniture" name="furniture" value="{{$inventory->furniture_name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Furniture:</label>
                                    <input type="text" class="form-control" id="condition" name="condition" value="{{$inventory->condition}}">
                                </div>
                                <button class="btn ripple btn-success" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
