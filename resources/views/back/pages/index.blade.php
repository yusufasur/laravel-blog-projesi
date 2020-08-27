@extends('back.layouts.master')

@section('title', 'Tüm Sayfalar')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span class="float-left">@yield('title')</span>
                <span class="float-right">
                    {{ $pages->count() }} sayfa bulundu.
                </span>
            </h6>
        </div>
        <div class="card-body">
            <div id="orderSuccess" style="display: none" class="alert alert-success">Sıralama başarıyla güncellendi.</div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>Durum</th>
                        <th>İşlamler</th>
                    </tr>
                    </thead>
                    <tbody id="orders">
                        @forelse($pages as $page)
                            <tr id="page_{{ $page->id }}">
                                <td width="20" class="text-center"><i class="fa fa-arrows-alt-v fa-3x handle" style="cursor: move"></i></td>
                                <td><img width="200" src="{{ asset($page->image) }}" alt=""></td>
                                <td>{{ $page->title }}</td>
                                <td>
                                    <input class="switch" data-id="{{ $page->id }}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($page->status == 1) checked @endif data-toggle="toggle">
                                </td>
                                <td>
                                    <a target="_blank" href="{{ route('page', $page->slug) }}" title="Görüntüle" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> </a>
                                    <a href="{{ route('admin.page.edit', $page->id) }}" title="Düzenle" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> </a>
                                    <a href="{{ route('admin.page.delete', $page->id) }}" title="Sil" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
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

    <!-- Sortable -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script>
        $(function () {
            $('#orders').sortable({
                handle : '.handle',
                update : function () {
                    var siralama = $('#orders').sortable('serialize');
                    $.get('{{ route('admin.page.orders') }}?'+siralama, function (data, status) {
                        $('#orderSuccess').show().delay(2000).fadeOut();
                    });
                }
            });

            $('.switch').change(function () {
                var id = $(this)[0].getAttribute('data-id');
                var status = $(this).prop('checked');
                $.get('{{ route('admin.page.switch') }}', {id: id, status: status}, function (data, status) {});
            });
        });
    </script>
@endsection
