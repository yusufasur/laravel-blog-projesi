@extends('back.layouts.master')

@section('title', 'Tüm Makaleler')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span class="float-left">{{ $articles->count() }} makale bulundu.</span>
                <span class="float-right">
                    <a href="{{ route('admin.makaleler.trashed') }}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Silinen Makaleler</a>
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
                        <th>Durum</th>
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
                                    <input class="switch" data-id="{{ $article->id }}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($article->status == 1) checked @endif data-toggle="toggle">
                                </td>
                                <td>
                                    <a target="_blank" href="{{ route('single', [$article->getCategory->slug, $article->slug]) }}" title="Görüntüle" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> </a>
                                    <a href="{{ route('admin.makaleler.edit', $article->id) }}" title="Düzenle" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> </a>
                                    <a href="{{ route('admin.makaleler.delete', $article->id) }}" title="Sil" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> </a>
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
    <!-- Bootstrap Switch -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')

    <!-- Page level plugins -->
    <script src="{{ asset('back/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('back/js/demo/datatables-demo.js') }}"></script>

    <!-- Bootstrap Switch -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(function () {
            $('.switch').change(function () {
                var id = $(this)[0].getAttribute('data-id');
                var status = $(this).prop('checked');
                $.get('{{ route('admin.switch') }}', {id: id, status: status}, function (data, status) {});
            });
        });
    </script>
@endsection
