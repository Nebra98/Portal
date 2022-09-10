@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pregled kategorije {{ $category->name }} </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($news as $new_item)

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">{{ $new_item->title }}</h5>
                          <p class="card-text">{{ $new_item->content }}</p>
                          <a href="{{ url('news/' . $new_item->id) }}" class="card-link">View news</a>

                          @can('delete-users')
                        <form action="{{ route('category.destroy', $category) }}" method="POST" class="float-right">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger"> Delete category
                            </button>
                        </form>
                        @endcan

                        </div>
                      </div>

                      <br>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of categories</h5>
                    
                    @foreach ($categories as $category)
                    <li class="list-group">
                        
                        <a href="{{ url('category/' . $category->id) }}">{{ $category->name }}</a>
                        @can('delete-users')
                        <form action="{{ route('category.destroy', $category) }}" method="POST" class="float-right">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger"> Delete category
                            </button>
                        </form>
                        @endcan
                    </li>
                    @endforeach
                    
                </div>
            </div>
        </div>

    </div>
@endsection
