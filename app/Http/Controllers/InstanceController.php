<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Instance;
use App\Models\Os;
use App\Models\Rack;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Auth;

class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::denies('index-server')) {
            abort(404,'Anda Tidak Memilki Akses');
        }

       $active =  Instance::where('instance_status', 'Active')->count();
       $deactivate =  Instance::where('instance_status', 'Deactivate')->count();
       $deleted = Instance::where('instance_status', 'Deleted')->count();
        $jumlahinstance = Instance::all()->count();
        $instance = Instance::with('host')
                    ->when($request->input('search'), function($query, $search){
                        $query->where('instance_name','like' ,  "%" . $search . "%")
                            ->orWhere('instance_ip', 'like',  "%" . $search . "%")
                            ->orwhereHas('host', function ($query) use ($search) {
                                $query->where('host_name','like',"%" . $search . "%");
                            });
                    })->paginate('5');
        return view('server.instance.index', [
            'jumlahinstance' => $jumlahinstance,
            'active' => $active,
            'deactivate' => $deactivate,
            'deleted' => $deleted,
            'instance' => $instance,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-server')) {
            abort(404,'Anda Tidak Memilki Akses');
        }
        $os = Os::all();
        $host = Host::all();
        return view('server.instance.create',[
            'os' => $os,
            'host' => $host
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('store-server')) {
            abort(404,'Anda Tidak Memilki Akses');
        }
        $request->validate([
            'instance_name' => ['required','max:255','string'],
            'instance_ip' => ['required','ipv4','unique:instance','string'],
            'instance_auth' => ['required','string'],
            'instance_spec' => ['required','max:255','string'],
            'instance_owner' => ['required','string'],
            'instance_domain' => ['required','string'],
            'id_os' => ['required','integer'],
            'id_host' => ['required','integer'],
            'instance_status' => ['required',],
            'instance_keterangan' => ['required','string','max:255']
        ]);
        $instance =  new Instance();
        $instance->instance_name = $request->instance_name;
        $instance->instance_ip = $request->instance_ip;
        $instance->instance_auth = $request->instance_auth;
        $instance->instance_spec = $request->instance_spec;
        $instance->instance_owner = $request->instance_owner;
        $instance->instance_domain = $request->instance_domain;
        $instance->id_os = $request->id_os;
        $instance->id_host = $request->id_host;
        $instance->instance_status = $request->instance_status;
        $instance->instance_keterangan = $request->instance_keterangan;
        $instance->author = Auth::user()->name;
        $instance->save();
        return redirect()->route('instance.index')->with('status','Berhasil Menambah VM Instance');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('show-server')) {
            abort(404,'Anda Tidak Memilki Akses');
        }
        $instance = Instance::find($id);
        $host = $instance->host->id_host;
        $servers = $instance->host->id_srv;
        $os = Os::select('os_name')->where('id_os', '=', $host)->get();
        $server = Server::select('*')->where('id_srv', '=', $servers)->get();
        return view('server.instance.show',[
            'instance' => $instance,
            'os' => $os,
            'server' => $server,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('edit-server')) {
            abort(404,'Anda Tidak Memilki Akses');
        }
        $instance = Instance::find($id);
        $os = Os::all();
        $host = Host::all();
        return view('server.instance.edit',[
            'instance' => $instance,
            'os' => $os,
            'host' => $host
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instance $instance)
    {
        if (Gate::denies('update-server')) {
            abort(404,'Anda Tidak Memilki Akses');
        }
        $request->validate([
            'instance_name' => ['required','max:255','string'],
            'instance_ip' => ['required','ipv4',Rule::unique('instance','instance_ip')->ignore($instance)],
            'instance_auth' => ['required','string'],
            'instance_spec' => ['required','max:1000','string'],
            'instance_owner' => ['required','string'],
            'instance_domain' => ['required','string'],
            'id_os' => ['required','integer'],
            'id_host' => ['required','integer'],
            'instance_status' => ['required',],
            'instance_keterangan' => ['required','string','max:1000']
        ]);
        $instance->instance_name = $request->instance_name;
        $instance->instance_ip = $request->instance_ip;
        $instance->instance_auth = $request->instance_auth;
        $instance->instance_spec = $request->instance_spec;
        $instance->instance_owner = $request->instance_owner;
        $instance->instance_domain = $request->instance_domain;
        $instance->id_os = $request->id_os;
        $instance->id_host = $request->id_host;
        $instance->instance_status = $request->instance_status;
        $instance->instance_keterangan = $request->instance_keterangan;
        $instance->author = Auth::user()->name;
        $instance->save();
        return redirect()->back()->with('status',"Berhasil Merubah Data VM $instance->instance_name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('destroy-server')) {
            abort(404,'Anda Tidak Memilki Akses');
        }
        Instance::destroy($id);
        return redirect()->route('instance.index')->with('status','Berhasil Menghapus Data');
    }
}
