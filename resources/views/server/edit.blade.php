@extends('layout.app')
@section('title','Simanja : Edit Data Server')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Data Physical Server</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('server.index')}}">Physical Server</a></div>
                <div class="breadcrumb-item">Edit Physical Server</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Server : {{$server->srv_name}} </h2>
            <p class="section-lead">
                Halaman Melakukan Edit Physical Server Device
            </p>

            @if (session('status'))
                <div class="alert alert-success alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Success</div>
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Server Details </h4>
                        </div>

                        <div class="card-body" >
                            <form METHOD="POST" enctype="multipart/form-data" action="/server/{{$server->id_srv}}">
                                @method('PUT')
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Server Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control @error('srv_name') is-invalid @enderror" name="srv_name" value="{{$server->srv_name}}">
                                        @error('srv_name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">IP Address</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control @error('srv_ip') is-invalid @enderror" name="srv_ip"  value="{{$server->srv_ip}}">
                                        @error('srv_ip')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">User : Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control @error('srv_auth') is-invalid @enderror" name="srv_auth" value="{{$server->srv_auth}}" placeholder="User :          /    Password :      ">
                                        @error('srv_auth')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Server Specification</label>
                                    <div class="col-sm-12 col-md-7">
                                    <textarea class="summernote-simple form-control @error('srv_spec') is-invalid @enderror" name="srv_spec" >
                                     {{$server->srv_spec}}
                                    </textarea>
                                        @error('srv_spec')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Owner</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control @error('srv_owner') is-invalid @enderror" name="srv_owner" value="{{$server->srv_owner}}">
                                        @error('srv_owner')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Rack Number</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select  class="form-control  selectric @error('id_rack')  is-invalid @enderror"  name="id_rack" id="id_rack" >
                                            @foreach($rack as $racks)
                                                <option @selected($racks->id_rack == $server->id_rack)
                                                        value="{{ $racks->id_rack }}">{{ $racks->rack_number }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_rack')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun Pengadaan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('id_pengadaan') is-invalid @enderror selectric" name="id_pengadaan" id="id_pengadaan">
                                            @foreach($pengadaan as $thn)
                                                <option @selected($thn->id_pengadaan == $server->id_pengadaan)
                                                        value="{{ $thn->id_pengadaan }}">{{ $thn->thn_pengadaan }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_pengadaan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control  @error('srv_status') is-invalid @enderror selectric" name="srv_status" id="srv_status">
                                            <option value="Aktif" @selected($server->srv_status == 'Aktif')>Aktif</option>
                                            <option value="Rusak" @selected($server->srv_status == 'Rusak')>Rusak</option>
                                            <option value="Mati" @selected($server->srv_status == 'Mati')>Mati</option>
                                        </select>
                                        @error('srv_status')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Details Server Information</label>
                                    <div class="col-sm-12 col-md-7">
                                    <textarea class="summernote-simple form-control @error('srv_keterangan') is-invalid @enderror" name="srv_keterangan">
                                       {{ $server->srv_keterangan}}
                                    </textarea>
                                        @error('srv_keterangan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Server Image</label>
                                    <div class="col-sm-20 col-md-7 border-0">
                                        <div class="editimagebox container">
                                            <a class="example-image-link" href="{{asset('storage/servers/' . $server->srv_image)}}" data-lightbox="example-1">
                                                <img class="editserver" src="{{asset('storage/servers/thumbnails/' . $server->srv_image)}} " alt="image-1" />
                                                <div class="middleedit">
                                                    <div class="text">Tampilkan Gambar</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Upload Image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div >
                                            <input type="file" name="image"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary" type="submit">Save Data Server</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customCss')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
@endpush

@push('customJS')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create( inputElement );
        FilePond.setOptions({
            credits: false,
            acceptedFileTypes: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'],
            server: {
                process: '/file-pond',
                revert: '/file-pond',
                headers: {
                    'accept' : 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
@endpush
