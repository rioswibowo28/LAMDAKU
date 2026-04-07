@extends('admin.layout-simple')

@section('title', 'Test Form Submit')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Test Article Form Submission</h1>
            
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Artikel *</label>
                    <input type="text" class="form-control" id="title" name="title" value="Test Artikel dari Form" required>
                </div>
                
                <div class="mb-3">
                    <label for="excerpt" class="form-label">Ringkasan</label>
                    <textarea class="form-control" id="excerpt" name="excerpt" rows="3">Ini adalah ringkasan test artikel</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Konten *</label>
                    <textarea class="form-control" id="content" name="content" rows="10" required><p><strong>Ini adalah test content artikel.</strong> Konten ini dibuat untuk testing form submission.</p>
<h2>Heading Test</h2>
<p>Paragraf dengan <strong>bold text</strong> dan <em>italic text</em>.</p>
<ul>
<li>Poin pertama</li>
<li>Poin kedua</li>
<li>Poin ketiga</li>
</ul></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="category" name="category" value="Test Category">
                </div>
                
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="test, artikel, form">
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1">
                        <label class="form-check-label" for="is_featured">Featured Article</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="allow_comments" name="allow_comments" value="1" checked>
                        <label class="form-check-label" for="allow_comments">Allow Comments</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="Test Artikel SEO Title">
                </div>
                
                <div class="mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="2">Deskripsi meta untuk SEO test artikel ini</textarea>
                </div>
                
                <div class="mb-3">
                    <button type="submit" name="action" value="save" class="btn btn-success me-2">Simpan sebagai Draft</button>
                    <button type="submit" name="action" value="publish" class="btn btn-primary">Publish Artikel</button>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
