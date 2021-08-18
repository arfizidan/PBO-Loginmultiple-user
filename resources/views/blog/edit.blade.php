@extends('partial.template')

@section('title_web')
    Edit Data Blogs
@endsection

@section('content')
    <div class="container mt-0 mb-3">
        <div class="row">
            <div class="col-md-12">
                <!-- Page Heading -->        
            <h1 class="h3 mb-3 text-gray-800 font-weight-bold text-center">Edit Data Blog</h1>
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">JUDUL</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $blog->title) }}" placeholder="Masukkan Judul Blog">
                            
                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KONTEN</label>
                                <textarea class="form-control @error('konten') is-invalid @enderror" name="konten" rows="5" placeholder="Masukkan Konten Blog">{{ old('konten', $blog->content) }}</textarea>
                            
                                <!-- error message untuk conten -->
                                @error('konten')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <a href="/blog" class="btn btn-success font-weight-bold">Kembali</a>
                            <button type="submit" class="btn btn-md btn-primary font-weight-bold">Update</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'konten' );
    </script>
    @endsection