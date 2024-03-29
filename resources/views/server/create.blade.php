@extends('layout.app')
@section('title','Simanja : Add New Server')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('server.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Create New Physical Device Server</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('server.index')}}">Physical Server</a></div>
                <div class="breadcrumb-item">Add New Server</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Add New Server Physical Data </h2>
            <p class="section-lead">
               Halaman menambahkan server fisik baru
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
                            <h4><i class="fa fa-server" aria-hidden="true"></i> Add Server Details</h4>
                        </div>
                        <div class="card-body" >
                            <form METHOD="POST"  enctype="multipart/form-data"  action="{{route('server.store')}}">
                                @csrf
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Server Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control @error('srv_name') is-invalid @enderror" name="srv_name" value="{{old('srv_name')}}" placeholder="Nama Server Anda">
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
                                    <input type="text" class="form-control @error('srv_ip') is-invalid @enderror" name="srv_ip"  value="{{old('srv_ip')}}" placeholder="IPv4 Address Server">
                                    @error('srv_ip')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Auth IDRACK </label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control @error('srv_auth') is-invalid @enderror" name="srv_auth" value="{{old('srv_auth')}}" placeholder="User :      /    Password :                                         note :  jika tidak ada IDRACK atau Modul Management isikan 'NONE' ">
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
                                    <textarea class="summernote-simple form-control @error('srv_spec') is-invalid @enderror" name="srv_spec">
                                     {{old('srv_spec')}}
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
                                    <input type="text" class="form-control @error('srv_owner') is-invalid @enderror" name="srv_owner" value="{{old('srv_owner')}}" placeholder="Pengelola Server">
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
                                    <select class="form-control selectric @error('id_rack')  is-invalid @enderror" name="id_rack" id="id_rack" >
                                        @foreach($rack as $racks)
                                        <option value="{{$racks->id_rack}}" @selected(old('id_rack') == $racks->id_rack)>{{$racks->rack_number}}</option>
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
                                        <option value="{{$thn->id_pengadaan}}" @selected(old('id_pengadaan') == $thn->id_pengadaan)>{{$thn->thn_pengadaan}}</option>
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
                                        <option value="Aktif" @selected(old('srv_status') =='Aktif' )>Aktif</option>
                                        <option value="Rusak" @selected(old('srv_status') =='Rusak' )>Rusak</option>
                                        <option value="Mati" @selected(old('srv_status') =='Mati>' )>Mati</option>
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
                                    <textarea class="summernote-simple form-control @error('srv_keterangan') is-invalid @enderror" name="srv_keterangan" >
                                        {{old('srv_keterangan')}}
                                    </textarea>
                                    @error('srv_keterangan')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">upload_image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" name="image">
                                    </div>
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save" aria-hidden="true"></i> Save Data Server</button>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
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
            required: true,
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
