@extends('back.layouts.master')

@section('title', 'Silinen Makaleler')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span>{{ $articles->count() }} makale bulundu.</span>
                <span class="float-right">
                    <a href="{{ route('admin.makaleler.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Geri Dön</a>
                </span>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Oluşturma Tarihi</th>
                        <th>İşlamler</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td><img width="200" src="{{ asset($article->image) }}" alt=""></td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->getCategory->name }}</td>
                                <td>{{ $article->hit }}</td>
                                <td>{{ $article->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.makaleler.recover', $article->id) }}" title="Geri Yükle" class="btn btn-primary btn-sm"><i class="fa fa-recycle"></i> </a>
                                    <a href="{{ route('admin.makaleler.delete.hard', $article->id) }}" title="Kalıcı Olarak Sil" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Öğe Bulunamadı!</td>
                                <td>Öğe Bulunamadı!</td>
                                <td>Öğe Bulunamadı!</td>
                                <td>Öğe Bulunamadı!</td>
                                <td>Öğe Bulunamadı!</td>
                                <td>Öğe Bulunamadı!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('back/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('js')

    <!-- Page level plugins -->
    <script src="{{ asset('back/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('back/js/demo/datatables-demo.js') }}"></script>

@endsection
