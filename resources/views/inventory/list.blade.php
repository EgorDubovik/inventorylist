@extends('layout.main')

@section('content')

    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Inventory list for <span style="color:#9f9f9f;">{{$category->customer_name}}</span></h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Apps</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Inventory list</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->
        <!-- CONTENT -->
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-10 col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="subtitle-creat-category"> ORIGIN INFORMATION</div>
                                        <div class="row">
                                            <div class="col-md-3 text-muted">Customer name</div>
                                            <div class="col-md-9">{{$category->customer_name}}</div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-3 text-muted">Address</div>
                                            <div class="col-md-9">{{$category->addressM->street}}, {{$category->addressM->city}}, {{$category->addressM->state}} {{$category->addressM->zip}}</div>
                                        </div>
                                    </div>
                                    <div style="border-top: 1px solid #ccc;margin: 20px 0" class="d-md-block d-lg-none"></div>
                                    <div class="col-md-6">
                                        <div class="subtitle-creat-category"> DESTINATION INFORMATION</div>
                                        <div class="row">
                                            <div class="col-md-3 text-muted">Customer name</div>
                                            <div class="col-md-9">{{$category->dest_customer_name}}</div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-3 text-muted">Address</div>
                                            <div class="col-md-9">{{$category->dest_addressM->street}}, {{$category->dest_addressM->city}}, {{$category->dest_addressM->state}} {{$category->dest_addressM->zip}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/category/edit/{{$category->id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> <span class="d-none d-lg-inline">edit</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Accesses                --}}
                <div class="row">
                    <div class="col-lg-10 col-xl-8">
                        <div class="card">
                            <div class="card-header">Accesses</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 text-muted">Creator:</div>
                                    <div class="col-9">
                                        {{$category->creater->name}}
                                        @foreach($category->creater->roles as $role)
                                            <span class="tag tag-{{\App\Models\Role::TAGS[$role->role]}}">{{\App\Models\Role::ROLES[$role->role]}}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-3 text-muted">Has access:</div>
                                    <div class="col-9">
                                        @foreach($category->accesses as $access)
                                            <div>
                                                {{$access->user->name}}
                                                @foreach($access->user->roles as $role)
                                                    <span class="tag tag-{{\App\Models\Role::TAGS[$role->role]}}">{{\App\Models\Role::ROLES[$role->role]}}</span>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <form method="post" action="{{route('category.assign.access',['category'=>$category])}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-8">
                                            <select class="form-control" id="exampleFormControlSelect1" name="user_id">
                                                @foreach(\App\Models\User::employens(Auth::user()->company_id) as $user)
                                                    @if($user->id !== Auth::user()->id && $user->id != $category->user_id)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-success">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END Accesses               --}}

                @include('layout/success-message',['status' => 'successful'])
                @if($errors->any())
                    @include("layout/error-message")
                @endif
                <div class="card">
                    <div class="card-header">
                        Inventory list
                        @can('create-inventory', $category)
                            <a href="/inventory/create" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#input-modal" style="margin-left: 20px;"><i class="fa fa-plus"></i> Add new furniture</a>
                        @endcan
                        <a style="margin-left: 20px;" href="{{route('view.category', ['category'=>$category->id])}}" class="btn btn-success"><i class="fa fa-eye"></i> <span class="d-none d-lg-inline">view</span></a>
                    </div>
                    <div class="card-body">
                        <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Stik number</th>
                                <th>Furniture</th>
                                <th>Condition</th>
                                <th style="width: 200px">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category->inventories as $inventory)
                                <tr>
                                    <td>{{$inventory->number}}</td>
                                    <td>{{$inventory->furniture_name}}</td>
                                    <td>{{$inventory->condition}}</td>
                                    <td>
                                        @can('update-inventory', $category)
                                            <form method="post" action="/inventory/destroy/{{$inventory->id}}" onsubmit="remove_item(this);return false;">
                                                @csrf
                                                @method('delete')
                                                <a href="/inventory/edit/{{$inventory->id}}" class="btn btn-warning"><i class="fa fa-edit"></i><span class="d-none d-lg-inline"> Edit</span></a>
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> <span class="d-none d-lg-inline">Remove </span></button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="input-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <form method="post" action="/inventory/create">
                <div class="modal-header">
                    <h6 class="modal-title">New inventory item</h6>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body ui-front">
                    @csrf
                    <input type="hidden" name="cid" value="{{$category->id}}">
                    <input type="hidden" name="lastnumber" value="0">
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="lale-number-f" class="col-form-label">Label number:</label>
                                <input type="text" class="form-control" id="label-number-f" name="label_number" value="{{($category->inventories->last()) ? ($category->inventories->last()->number+1) : 1}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="lale-count" class="col-form-label">Count:</label>
                                <input type="text" class="form-control" id="label-number-f" name="count" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 ui-widget">
                        <label for="furniture" class="col-form-label">Furniture:</label>
                        <input type="text" class="form-control" id="furniture" name="furniture">
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="col-form-label">Condition:</label>
                        <input type="text" class="form-control" id="condition" name="condition" value="good">
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-success" type="submit">Save</button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        function remove_item(f){
            if(confirm('Are you sure?')){
                f.submit()
            }
        }


        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];

        $( "#furniture" ).autocomplete({
            source: availableTags,

        });
    </script>
@stop

