@extends('layouts.mainlayout')

@section('title', 'Add Menu')

@section('content')


    <div class="col-12 m-auto">


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Menu</h4>
                <div class="row">
                    <div class="col-12">
                        <form class="form-material" method="POST" action="menu" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>price</label>
                                <input type="text" class="form-control" name="price" required>
                            </div>
                            <div class="form-group">
                                <label>photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photo" name="photo" required>
                                    <label class="custom-file-label" for="photo">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="/menu" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
