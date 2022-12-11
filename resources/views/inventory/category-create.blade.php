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
                <div class="col-lg-8 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create new inventory category</h4>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                @include("layout/error-message")
                            @endif
                            <form method="post" class="form-horizontal category-create">
                                @csrf
                                <div class="row" style="padding-bottom: 20px;">
                                    <div class="col-md-6">
                                        <div class="subtitle-creat-category"> ORIGIN INFORMATION</div>
                                        <div class="row mb-4">
                                            <label for="inputName" class="col-md-3 form-label" style="font-size: 13px;">Customer Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="inputName" placeholder="Customer Name" name="customer_name" value="{{old('customer_name')}}">
                                            </div>
                                        </div>

                                        <div class="category-create-address">Address</div>
                                        <div style="margin-left: 20px;">
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">Line 1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="Address Line 1" class="form-control" name="street">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">City</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="City" class="form-control" name="city">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">State</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="State" class="form-control" name="state">
                                                </div>

                                                <label class="col-sm-2 control-label" for="textinput">Zip</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="Post Code" class="form-control" name="zip">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6" style="border-left: 1px solid #ccc ">
                                        <div class="subtitle-creat-category"> DESTINATION INFORMATION</div>
                                        <div class="row mb-4">
                                            <label for="inputName" class="col-md-3 form-label" style="font-size: 13px;">Customer Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="inputName" placeholder="Customer Name" name="dest_customer_name" value="{{old('dest_customer_name')}}">
                                            </div>
                                        </div>
                                        <div class="category-create-address">Address</div>
                                        <div style="margin-left: 20px;">
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">Line 1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="Address Line 1" class="form-control" name="dest_street">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">City</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="City" class="form-control" name="dest_city">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">State</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="State" class="form-control" name="dest_state">
                                                </div>

                                                <label class="col-sm-2 control-label" for="textinput">Zip</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="Post Code" class="form-control" name="dest_zip">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="row mb-4">--}}
{{--                                    <label for="inputEmail3" class="col-md-3 form-label">Email</label>--}}
{{--                                    <div class="col-md-9">--}}
{{--                                        <input type="address" class="form-control" id="inputEmail3" placeholder="Customer address" name="customer_address" value="{{old('customer_address')}}">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <button type="submit" class="btn btn-success btn-block">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
