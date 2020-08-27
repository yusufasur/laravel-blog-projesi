@extends('front.layouts.master')

@section('title', 'İletişim')

@section('bg', 'front/img/contact-bg.jpg')

@section('content')
    <div class="col-md-8">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h3 align="center" class="text-muted">Bizimle iletişime geçebilirsiniz.</h3>
        <hr>
        <form action="{{ route('contact.post') }}" method="post">
            @csrf
            <div class="control-group">
                <div class="form-group controls">
                    <label>Ad Soyad</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Ad Soyadınız" id="name" required>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group controls">
                    <label>Email Adresi</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email Adresiniz" id="email" required>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group col-xs-12 controls">
                    <label>Konu</label>
                    <select name="topic" class="form-control">
                        <option @if(old('topic') == 'Bilgi') selected @endif>Bilgi</option>
                        <option @if(old('topic') == 'Destek') selected @endif>Destek</option>
                        <option @if(old('topic') == 'Genel') selected @endif>Genel</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group controls">
                    <label>Mesajınız</label>
                    <textarea rows="5" name="message" class="form-control" placeholder="Mesajınız" id="message" required>{{ old('message') }}</textarea>
                </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
            </div>
        </form>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Kategoriler</div>

            <div class="list-group">
                <a href="http://larablog.local/kategori/bilisim" class="list-group-item ">Bilişim
                    <span class="badge badge-secondary float-right">2</span>
                </a>
                <a href="http://larablog.local/kategori/eglence" class="list-group-item ">Eğlence
                    <span class="badge badge-secondary float-right">0</span>
                </a>
                <a href="http://larablog.local/kategori/spor" class="list-group-item ">Spor
                    <span class="badge badge-secondary float-right">1</span>
                </a>
                <a href="http://larablog.local/kategori/gezi" class="list-group-item ">Gezi
                    <span class="badge badge-secondary float-right">0</span>
                </a>
                <a href="http://larablog.local/kategori/teknoloji" class="list-group-item ">Teknoloji
                    <span class="badge badge-secondary float-right">0</span>
                </a>
                <a href="http://larablog.local/kategori/gunluk-yasam" class="list-group-item ">Günlük Yaşam
                    <span class="badge badge-secondary float-right">1</span>
                </a>
                <a href="http://larablog.local/kategori/saglik" class="list-group-item ">Sağlık
                    <span class="badge badge-secondary float-right">0</span>
                </a>
            </div>
        </div>
    </div>
@endsection

