@extends('partial.template')

@section('title_web')
    Tugas Blog
@endsection

@section('content')
<div class="container mt-0">
    <div class="row">
        <div class="col-md-12">
            <!-- Page Heading -->
            <h1 class="h3 mb-3 text-gray-800 text-center font-weight-bold">Data User</h1>
            <div class="card border-0 shadow rounded">                         
                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-8">
                                <a href="{{ route('akun.create') }}" class="btn btn-md btn-primary mb-0 font-weight-bold">
                                    Tambah Data User
                                </a>            
                            </div>
                        </div>
                    </div>
                <div class="card-body">                
                   
                    <table id="dataTable" class="table table-bordered table-hover text-center">
                        <thead class="font-weight-bold text-gray-800">
                            <tr>
                                <th scope="col">NO</th>                                
                                <th scope="col">NAME</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">ROLE</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tfoot class="font-weight-bold text-gray-800">
                            <th scope="col">NO</th>                            
                            <th scope="col">NAME</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">ROLE</th>
                            <th scope="col">AKSI</th>
                            </tfoot>
                        <tbody>

                            @forelse ($user as $users)
                    
                                <tr>
                                    <td>{{$loop->iteration}}</td>                                                           
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>{{ $users->role }}</td>
                                    <td class="text-center">
                                        {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('blog.destroy', $blog->id) }}" method="POST"> --}}
                                            <a href="{{ route('akun.edit', $users->id ) }}" class="btn btn-sm btn-success font-weight-bold m-1">
                                                Edit                                            
                                            </a>                                                                               
                                            {{-- @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger font-weight-bold delete-confirm">
                                                Hapus
                                            </button>                                          --}}
                                        {{-- </form>                                     --}}
                                        <a class="btn btn-sm btn-danger font-weight-bold delete-blog m-1" data-id="{{ $users->id }}">
                                            Hapus                     
                                        </a>                                        
                                    </td>                                    
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data User Belum Tersedia
                                </div>
                                @endforelse
                        </tbody>                        
                    </table>
                    {{-- <div class="pull-left">
                        Showing
                        {{ $user->firstItem() }}
                        to
                        {{ $user->lastItem() }}
                        of
                        {{ $user->total() }}
                        entries
                    </div>
                    
                    <div class="pagination justify-content-end" style="margin-top: -30px;">
                    {{ $user->links() }}
                    </div> --}}
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
        var akunid = $(this).attr('data-id');
        swal({
                title: "Yakin Ingin Menghapus?",
                text: "Anda Akan Menghapus Data Blog Dengan No ID : " + akunid + "",
                icon: "warning",
                buttons: ["BATAL", "OK"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/hapus/ " + akunid + ""
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
