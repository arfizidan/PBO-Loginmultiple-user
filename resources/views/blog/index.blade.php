@extends('partial.template')

@section('title_web')
    Tugas Blog
@endsection

@section('content')
<div class="container mt-0">
    <div class="row">
        <div class="col-md-12">
            <!-- Page Heading -->
            <h1 class="h3 mb-3 text-gray-800 text-center font-weight-bold">Data Blog</h1>
            <div class="card border-0 shadow rounded">                         
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-8">
                                <a href="{{ route('blog.create') }}" class="btn btn-md btn-primary mb-0 font-weight-bold">
                                    Tambah Data Blog
                                </a>            
                            </div>
                        </div>
                    </div>
                <div class="card-body">                
                   
                    <table id="dataTable" class="table table-bordered table-hover text-center">
                        <thead class="font-weight-bold text-gray-800">
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">GAMBAR</th>
                                <th scope="col">JUDUL</th>
                                <th scope="col">CONTENT</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tfoot class="font-weight-bold text-gray-800">
                            <th scope="col">NO</th>
                            <th scope="col">GAMBAR</th>
                            <th scope="col">JUDUL</th>
                            <th scope="col">CONTENT</th>
                            <th scope="col">AKSI</th>
                            </tfoot>
                        <tbody>

                            <?php $no=1; ?>
                            @forelse ($blogs as $blog)
                    
                                <tr>
                                    <td>{{$no++}}</td>                       
                                    <td class="text-center">
                                        <img src="{{ asset ('img/foto_blog/'.$blog->image) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{!! $blog->content !!}</td>
                                    <td class="text-center">
                                        {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('blog.destroy', $blog->id) }}" method="POST"> --}}
                                        <a href="{{ route('blog.show', $blog->id ) }}" class="btn btn-sm btn-warning font-weight-bold">
                                            Detail
                                        </a>                                        
                                        <a href="{{ route('blog.edit', $blog->id ) }}" class="btn btn-sm btn-success font-weight-bold">
                                            Edit                                            
                                        </a>                                        
                                            {{-- @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger font-weight-bold delete-confirm">
                                                Hapus
                                            </button>                                          --}}
                                        {{-- </form>                                     --}}
                                        <a class="btn btn-sm btn-danger font-weight-bold delete-blog" data-id="{{ $blog->id }}">
                                            Hapus                     
                                        </a>                                        
                                    </td>                                    
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Blog Belum Tersedia
                                </div>
                                @endforelse
                        </tbody>                        
                    </table>
                    {{-- {{ $blogs->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sweetalert delete -->        
@push('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.delete-blog').click(function () {
        var blogid = $(this).attr('data-id');
        swal({
                title: "Yakin Ingin Menghapus?",
                text: "Anda Akan Menghapus Data Blog Dengan No ID : " + blogid + "",
                icon: "warning",
                buttons: ["BATAL", "OK"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/delete/ " + blogid + ""
                    swal("Data Blog Berhasil Dihapus!", {
                        icon: "success",
                    });
                } else {
                    swal("Data Tidak Jadi Dihapus!");
                }
            });
    });
</script>
@endpush
@endsection
