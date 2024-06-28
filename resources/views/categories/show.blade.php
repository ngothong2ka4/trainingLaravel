@extends('layouts.app')

@section('title', 'Category Details')

@section('content')
    <div class="bg-light rounded">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Show Categories {{ $category->name }}</h5>

                <div class="container mt-4">
                    <div>
                        <strong>Category Name:</strong> {{ $category->name }}
                    </div>
                    <div>
                        <strong>Created By:</strong> {{ $category->created_by }}
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('categories.index') }}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
