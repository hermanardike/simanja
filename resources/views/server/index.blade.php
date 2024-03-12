@extends('layout.app')
@section('title','Simanja : Data Server')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Physical Server</h1>
            <div class="section-header-button">
                <a href="{{route('server.create')}}" class="btn btn-outline-primary">Add Physical Server</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('server.index')}}">Physical Server</a></div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Data Server</h2>
            <p class="section-lead">
                Server Management UPT TIK Universitas Lampung
            </p>


            @if (session('status'))
                <div class="alert alert-warning alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Success</div>
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link " href="{{route('server.index')}}"><h2> <i class="fas fa-server"></i> Total Data Physical Server : <span class="badge badge-success">{{$jumlahserver}}</span> Unit</h2> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Server  </h4>
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                                <select class="form-control selectric">
                                    <option>Fillter By Rack</option>
                                    <option>RACK 1</option>
                                    <option>RACK 2</option>
                                    <option>RACK 3</option>
                                    <option>RACK 4</option>
                                    <option>RACK 5</option>

                                </select>
                            </div>
                            <div class="float-right">
                                <form method="GET">
                                    <div class="input-group">
                                        <input  name="search" type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-center text-bold">No</th>
                                        <th>SERVER NAME</th>
                                        <th>IP ADDRESS</th>
                                        <th>RACK NUMBER</th>
                                        <th>PENGADAAN</th>
                                        <th>Status</th>
                                    </tr>
                                    @forelse($server as $index => $servers)


                                    <tr>
                                        <td class="text-bold text-center ">
                                            {{$index + $server->firstItem()}}

                                        </td>
                                        <td class="text-bold"> {{$servers->srv_name}}
                                            <div class="table-links">
                                                @can('show-server')
                                                <a href="server/{{$servers->id_srv}}">View</a>
                                                @endcan
                                                @can('edit-server')
                                                <div class="bullet"></div>
                                                <a href="server/{{$servers->id_srv}}/edit">Edit</a>
                                                <div class="bullet"></div>
                                                <a href="/user/{{$servers->id_srv}}"  class="text-danger"
                                                   onclick="event.preventDefault(); document.getElementById('del-{{$servers->id_srv}}')"

                                                   data-confirm="Hapus Data Server ? | Apakah Anda Yakin ingin Mengapus server : {{$servers->srv_name}} "  data-confirm-yes="submit({{$servers->id_srv}})">
                                                    Delete </a>
                                                <form id="del-{{$servers->id_srv}}" action="/server/{{$servers->id_srv}}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                                    @endcan
                                            </div>
                                        </td>
                                        <td>
                                             <div class="badge badge-primary text-bold">{{$servers->srv_ip}} </div>
                                        </td>
                                        <td>
                                            <div class="badge  text-bold">{{$servers->rack->rack_number}} </div>
                                        </td>
                                        <td class="text-primary text-bold">{{$servers->pengadaan->thn_pengadaan}}</td>
                                        <td>
                                            @if ($servers->srv_status == 'Aktif')
                                            <div class="badge badge-success">{{$servers->srv_status}}</div></td>
                                        @else
                                            <div class="badge badge-secondary">{{$servers->srv_status}}</div>
                                        @endif
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
                                        {{$server->withQueryString()->links()}}
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
