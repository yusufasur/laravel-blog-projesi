@extends('back.layouts.master')

@section('title', 'Tüm Kategoriler')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="category">Kategori Adı</label>
                            <input type="text" name="category" id="category" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlamler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->articleCount() }}</td>
                                    <td>
                                        <input class="switch" data-id="{{ $category->id }}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($category->status == 1) checked @endif data-toggle="toggle">
                                    </td>
                                    <td>
                                        <a data-id="{{ $category->id }}" title="Düzenle" class="btn btn-primary btn-sm edit-click"><i class="fa fa-pen text-white"></i> </a>
                                        <a data-id="{{ $category->id }}" data-count="{{ $category->articleCount() }}" data-name="{{ $category->name }}" title="Sil" class="btn btn-danger btn-sm remove-click"><i class="fa fa-times text-white"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('admin.category.update') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="modalCategory">Kategori Adı</label>
                            <input type="text" name="category" id="modalCategory" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="modalSlug">Kategori Slug</label>
                            <input type="text" name="slug" id="modalSlug" class="form-control">
                        </div>
                        <input type="hidden" name="id" id="category_id">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    <!-- The Delete Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Sil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div id="articleAlert"></div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <form action="{{ route('admin.category.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="deleteId">
                        <button id="deleteButton" type="submit" class="btn btn-success">Sil</button>
                    </form>
                </div>

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
            $('.remove-click').click(function () {
                var id = $(this).data('id');
                var count = $(this).data('count');
                var name = $(this).data('name');

                if (id == 1) {
                    $('#articleAlert').html('<div class="alert alert-info">' + name + ' kategorisi sabit kategoridir. Silinen diğer kategorilere ait makaleler bu kategoriye eklenecektir.</div>');
                    $('#deleteButton').hide();
                    $('#deleteModal').modal();
                    return;
                }
                $('#deleteButton').show();

                $('#deleteId').val(id);
                $('#articleAlert').html('Bu kategoriyi silmek istediğinize emin misiniz ?');
                if (count > 0) {
                    $('#articleAlert').html('<div class="alert alert-warning">Bu kategoriye ait ' + count + ' adet makale bulunmaktadır.</div> Silmek istediğinize emin misiniz ?');
                }
                $('#deleteModal').modal();
            });

            $('.edit-click').click(function () {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url : '{{ route('admin.category.getdata') }}',
                    data: {id: id},
                    success: function (data) {
                        console.log(data);
                        $('#modalCategory').val(data.name);
                        $('#modalSlug').val(data.slug);
                        $('#category_id').val(data.id);
                        $('#editModal').modal();
                    }
                })
            });

            $('.switch').change(function () {
                var id = $(this)[0].getAttribute('data-id');
                var status = $(this).prop('checked');
                $.get('{{ route('admin.category.switch') }}', {id: id, status: status}, function (data, status) {});
            });
        });
    </script>
@endsection
