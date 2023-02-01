@extends('layout.main')

@section('content')

    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Create new inventory category</h1>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- CONTENT -->
        <div class="row">
            <div class="col-12">
                <div class="col-xl-8 m-auto">
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

                                <div class="row mb-4">
                                    <div class="col-md-2">Order number:</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Order number" name="order_number" value="{{$category->order_number}}">
                                    </div>
                                    <div class="col-md-2">Tape lot number:</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Tape lot number:" name="tape_lot_number" value="{{$category->tape_lot_number}}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-2">Van number:</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Van number" name="van_number" value="{{$category->van_number}}">
                                    </div>
                                    <div class="col-md-2">Tape color:</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Tape color:" name="tape_color" value="{{$category->tape_color}}">
                                    </div>
                                </div>

                                <div class="row mt-4" style="padding-bottom: 20px;">
                                    <div class="col-md-6">
                                        <div class="subtitle-creat-category"> ORIGIN INFORMATION</div>
                                        <div class="category-create-address">Customer </div>
                                        <div style="margin-left: 20px;">
                                            <div class="row mb-4">
                                                <label class="col-md-2 control-label" >Name</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control customer_name"  placeholder="Customer Name"  name="customer_name" value="{{$category->customer_name}}">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-2 control-label" >Phone</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control customer_phone" placeholder="Phone number" name="customer_phone" value="{{$category->customer_phone}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="category-create-address">Address</div>
                                        <div style="margin-left: 20px;">
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">Line 1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="Address Line 1" class="form-control" name="street" value="{{$category->addressM->street}}">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">City</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="City" class="form-control" name="city" value="{{$category->addressM->city}}">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">State</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="State" class="form-control" name="state" value="{{$category->addressM->state}}">
                                                </div>

                                                <label class="col-sm-2 control-label" for="textinput">Postcode</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="Post Code" class="form-control" name="zip" value="{{$category->addressM->zip}}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6" style="border-left: 1px solid #ccc ">
                                        <div class="subtitle-creat-category"> DESTINATION INFORMATION</div>
                                        <div class="category-create-address">Customer</div>
                                        <div style="margin-left: 20px;">
                                            <div class="row mb-4">
                                                <label class="col-md-2 control-label" >Name</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control dest_customer_name"  placeholder="Customer Name" name="dest_customer_name" value="{{$category->dest_customer_name}}">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-2 control-label" >Phone</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control dest_customer_phone" placeholder="Phone number" name="dest_customer_phone" value="{{$category->dest_customer_phone}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="category-create-address">Address</div>
                                        <div style="margin-left: 20px;">
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">Line 1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="Address Line 1" class="form-control" name="dest_street" value="{{$category->dest_addressM->street}}">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">City</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="City" class="form-control" name="dest_city" value="{{$category->dest_addressM->city}}">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">State</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="State" class="form-control" name="dest_state" value="{{$category->dest_addressM->state}}">
                                                </div>

                                                <label class="col-sm-2 control-label" for="textinput">Postcode</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="Post Code" class="form-control" name="dest_zip" value="{{$category->dest_addressM->zip}}">
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
                                <button type="submit" class="btn btn-success btn-block">SAve information</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
