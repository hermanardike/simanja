@extends('layout.app')
@section('title','Rack Numbers')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1><i class="fa fa-cog"></i> Rack Management Setting</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('rack.index')}}">Rack Numbers</a></div>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Success</div>
                    {{ session('status') }}
                </div>
            </div>
        @endif
        <div class="section-body">
            <h2 class="section-title">Table Rack Server</h2>
            <p class="section-lead">Halaman Management Rack Assets</p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if(Auth::user()->role == 'operator')
                                <h4> Table Rack Server</h4>
                            @endif
                            @can('create-server')
                            <h4>
                                <div class="section-header-button">
                                    <a href="{{route('rack.create')}}" class="btn btn-primary"> <i class="fa fa-plus"> </i> Add Rack Numbers </a>
                                </div>
                            </h4>
                            @endcan
                            <div class="card-header-form float-right">
                                <form method="GET">
                                    <div class="input-group">
                                        <input name="search" type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>No</th>
                                        <th>Rack Numbers</th>
                                        <th>Create At</th>
                                        <th>Update At</th>
                                        @can('create-server')
                                        <th>Action</th>
                                        @endcan
                                    </tr>
                                    @forelse($rack as $index => $rack_number)
                                        <tr>
                                            <td>
                                                {{$index + $rack->firstItem()}}
                                            </td>
                                            <td>{{$rack_number->rack_number}}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($rack_number->created_at)->format('h M, Y')}}
                                            </td>
                                            <td>
                                            {{ \Carbon\Carbon::parse($rack_number->updated_at)->format('h M, Y')}}
                                            </td>
                                            @can('create-server')
                                            <td>
                                                <a href="/rack/{{$rack_number->id_rack}}/edit" class="btn btn-primary">Edit</a>
                                                <a href="/rack/{{$rack_number->id_rack}}" class="btn btn-danger"
                                                   onclick="event.preventDefault(); document.getElementById('del-{{$rack_number->id_rack}}')"
                                                   data-confirm="Hapus Data Operating System ? | Apakah Anda Yakin ingin Mengapus Operating System : {{$rack_number->rack_number}} "  data-confirm-yes="submit({{$rack_number->id_rack}})">
                                                    Delete </a>
                                                <form id="del-{{$rack_number->id_rack}}" action="/rack/{{$rack_number->id_rack}}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                            @endcan
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="empty-state" data-height="400">
                                                            <div class="empty-state-icon">
                                                                <i class="fas fa-question"></i>
                                                            </div>
                                                            <h2>We couldn't find any data</h2>
                                                            <p class="lead">
                                                                Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        {{$rack->withQueryString()->links()}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
