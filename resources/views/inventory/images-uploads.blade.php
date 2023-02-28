@extends('layout.main')

@section('content')

    <div class="main-container container-fluid">
        <!-- CONTENT -->
        <div class="row">
            <div class="col-12">
                <div class="col-xl-8 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4><span class="text-muted">Uploads images for:</span> {{$inventory->furniture_name}} #{{$inventory->number}}  </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{route('inventory.list', ['category' => $inventory->category_id])}}" style="padding-bottom: 15px;">Back to list</a>
                            </div>
                            <form method="post" action="{{route('inventory.images.store',["inventory" => $inventory])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <input class="form-control form-control-sm" name="images[]" type="file" multiple="">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-sm" type="submit">Upload</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                @foreach($inventory->images as $image)
                                    <img src="{{url('inventory/'.$image->id.'/'.$image->path)}}" style="width: 200px; margin-top: 10px;" >
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
