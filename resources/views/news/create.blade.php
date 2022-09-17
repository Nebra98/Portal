@extends('layouts.app')


@section('content')
    <div class="container">
       <div class="text-center">
            <a href="{{ route('home') }}" class="button secondary">Back</a>
        </div>
    <hr>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" class="text-center">Create new news </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">

                            <form class="form-horizontal" method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group" >
                                    <label for="name" class="col-12">News title:</label>
                                    <div class="col-12">
                                        <input id="title" type="text" class="form-control" name="title" placeholder="Enter a news title" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group" >
                                    <label for="name" class="col-12">News content:</label>
                                    <div class="col-12">
                                        <textarea id="content" type="text" class="form-control" name="content" placeholder="Enter a news content" required autofocus>
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <select name="category_id" id="category_id" class="form-control select2">
                                        <option disabled  selected value="">Odaberite kategoriju...</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
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
