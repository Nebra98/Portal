@extends('layouts.app')


@section('content')
    <div class="container">
       <div class="text-center">
            <a href="{{ route('category.index') }}" class="button secondary">Back</a>
        </div>
    <hr>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" class="text-center">Create new category </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">

                            <form class="form-horizontal" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group" >
                                    <label for="name" class="col-12">Category name:</label>
                                    <div class="col-12">
                                        <input id="name" type="text" class="form-control" name="name" placeholder="Enter a category name" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md">
                                        <button type="submit" class="btn btn-primary" value="Create">
                                            Create category
                                        </button>
                                    </div>
                                </div>
                            </form>


                        </div> </div>

                </div>
            </div>
        </div>


@endsection
