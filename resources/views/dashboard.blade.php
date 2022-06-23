@extends('layout.main')

@section('content')

<div class="main-container container-fluid">
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Orders</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Apps</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- CONTENT -->
    <div class="row">

        <div class="col-md-12  col-xl-6">
            <div class='' style="padding-bottom: 20px;">
                <a class="btn btn-primary" href="/order/search"><i class="fa fa-search"></i> Search by route</a>
                @can('create', \App\Models\Order::class)
                    <a class="btn btn-success" href="/order/create"><i class="fa fa-plus"></i> Add new order</a>
                @endcan

            </div>
            @include('order.order-view',['status'=>'all'])
        </div>

        <div class="col-md-12  col-xl-6" id="orders-line">
            <div class="row">
                <div class="col-sm-12 col-xl-6 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class=""><span class="text-primary"><i class="fe fe-file-text mx-2 fs-20 text-primary-shadow"></i></span>Total new Orders</h6>
                            <h3 class="text-dark counter mt-0 mb-3 number-font">7,896</h3>
                            <div class="progress h-1 mt-0 mb-2">
                                <div class="progress-bar progress-bar-striped bg-primary" style="width: 70%;" role="progressbar"></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col text-center"> <span class="text-muted">Weekly</span>
                                    <h4 class="fw-normal mt-2 mb-0 number-font1">8</h4>
                                </div>
                                <div class="col text-center"> <span class="text-muted">Monthly</span>
                                    <h4 class="fw-normal mt-2 mb-0 number-font2">23</h4>
                                </div>
                                <div class="col text-center"> <span class="text-muted">Total</span>
                                    <h4 class="fw-normal mt-2 mb-0 number-font3">31</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 col-xl-6">
                    <div class="card">
                        <div class="row">
                            <div class="col-4">
                                <div class="card-img-absolute circle-icon bg-primary text-center align-self-center box-primary-shadow bradius">
                                    <img src="../assets/images/svgs/circle.svg" alt="img" class="card-img-absolute">
                                    <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="card-body p-4">
                                    <h2 class="mb-2 fw-normal mt-2">9,678</h2>
                                    <h5 class="fw-normal mb-0">Total Drivers</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

@stop
