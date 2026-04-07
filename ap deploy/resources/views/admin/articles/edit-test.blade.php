@extends('admin.layout-simple')

@section('title', 'Test Edit Artikel')

@section('content')
<div class="container-fluid">
    <h1>Test Edit Artikel</h1>
    <p>Article ID: {{ $article->id }}</p>
    <p>Article Title: {{ $article->title }}</p>
    <p>Article Status: {{ $article->status }}</p>
    
    <div class="alert alert-info">
        <strong>Debug Info:</strong><br>
        Route: {{ request()->route()->getName() }}<br>
        Method: {{ request()->method() }}<br>
        URL: {{ request()->url() }}
    </div>
    
    <a href="{{ route('admin.articles.index') }}" class="btn btn-primary">Kembali ke Index</a>
</div>
@endsection
