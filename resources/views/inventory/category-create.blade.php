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

                                <div class="row mb-4">
                                    <div class="col-md-2">Order number:</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Order number" name="order_number" value="{{old('order_number')}}">
                                    </div>
                                    <div class="col-md-2">Tape lot number:</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Tape lot number:" name="tape_lot_number" value="{{old('tape_lot_number')}}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-2">Van number:</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Van number" name="van_number" value="{{old('van_number')}}">
                                    </div>
                                    <div class="col-md-2">Tape color:</div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Tape color:" name="tape_color" value="{{old('tape_color')}}">
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
                                                    <input type="text" class="form-control customer_name"  placeholder="Customer Name"  name="customer_name" value="{{old('customer_name')}}">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-2 control-label" >Phone</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control customer_phone" placeholder="Phone number" name="customer_phone" value="{{old('customer_phone')}}">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-2 control-label" >Email</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control customer_email" placeholder="Email" name="customer_email" value="{{old('customer_email')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="category-create-address">Address</div>
                                        <div style="margin-left: 20px;">
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">Line 1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="Address Line 1" class="form-control" name="street" value="{{old('street')}}">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">City</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="City" class="form-control" name="city" value="{{old('city')}}">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">State</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="State" class="form-control" name="state" value="{{old('state')}}">
                                                </div>

                                                <label class="col-sm-2 control-label" for="textinput">Zip</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="Post Code" class="form-control" name="zip" value="{{old('zip')}}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6" style="border-left: 1px solid #ccc ">
                                        <div class="subtitle-creat-category"> DESTINATION INFORMATION</div>
                                        <div class="category-create-address">Customer <a href="#" onclick="same_as_origin();return false;">Same as origin</a> </div>
                                        <div style="margin-left: 20px;">
                                            <div class="row mb-4">
                                                <label class="col-md-2 control-label" >Name</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control dest_customer_name"  placeholder="Customer Name" name="dest_customer_name" value="{{old('dest_customer_name')}}">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-2 control-label" >Phone</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control dest_customer_phone" placeholder="Phone number" name="dest_customer_phone" value="{{old('dest_customer_phone')}}">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label class="col-md-2 control-label" >Email</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control dest_customer_email" placeholder="Email" name="dest_customer_email" value="{{old('dest_customer_email')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="category-create-address">Address</div>
                                        <div style="margin-left: 20px;">
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">Line 1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="Address Line 1" class="form-control" name="dest_street" value="{{old('dest_street')}}">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">City</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="City" class="form-control" name="dest_city" value="{{old('dest_city')}}">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="row mb-4">
                                                <label class="col-sm-2 control-label" for="textinput">State</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="State" class="form-control" name="dest_state" value="{{old('dest_state')}}">
                                                </div>

                                                <label class="col-sm-2 control-label" for="textinput">Zip</label>
                                                <div class="col-sm-4">
                                                    <input type="text" placeholder="Post Code" class="form-control" name="dest_zip" value="{{old('dest_zip')}}">
                                                </div>
                                            </div>
                                        </div>
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

@section('scripts')
    <script>
        function same_as_origin(){
            var name = $('.customer_name').val();
            var phone = $('.customer_phone').val();
            var email = $('.customer_email').val();
            $('.dest_customer_name').val(name);
            $('.dest_customer_phone').val(phone);
            $('.dest_customer_email').val(email);
        }
    </script>
@endsection
