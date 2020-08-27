@extends('back.layouts.master')

@section('title', 'Ayarlar')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.config.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Site Başlığı</label>
                            <input type="text" name="title" id="title" required class="form-control" value="{{ $config->title }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="active">Site Aktiflik Durumu</label>
                            <select name="active" id="active" class="form-control">
                                <option @if($config->active == 1) selected @endif value="1">Açık</option>
                                <option @if($config->active == 0) selected @endif value="0">Kapalı</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logo">Site Logo</label>
                            <input type="file" name="logo" id="logo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="favicon">Site Favicon</label>
                            <input type="file" name="favicon" id="favicon" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $config->facebook }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" name="twitter" id="twitter" class="form-control" value="{{ $config->twitter }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="github">Github</label>
                            <input type="text" name="github" id="github" class="form-control" value="{{ $config->github }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="linkedin">Linkedin</label>
                            <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{ $config->linkedin }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="youtube">Youtube</label>
                            <input type="text" name="youtube" id="youtube" class="form-control" value="{{ $config->youtube }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instagram">İnstagram</label>
                            <input type="text" name="instagram" id="instagram" class="form-control" value="{{ $config->instagram }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-block btn-success">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
@endsection
