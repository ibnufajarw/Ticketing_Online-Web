<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.user.index');
    }

    public function datatableJson()
    {
        $data = User::user();

        return DataTables::of($data)
            ->editColumn('is_active', function ($data) {
                $status = ($data->is_active ? "<span class='badge badge-primary'>Aktif</span>" : "<span class='badge badge-secondary'>Tidak Aktif</span>");

                return $status;
            })
            ->addColumn('aksi', function ($data) {
                return '
                                    <button type="button" class="btn btn-sm btn-warning"
                                    data-toggle="modal" data-target="#reset"
                                    data-id="' . $data->id . '">Reset Password</button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                    data-toggle="modal" data-target="#delete"
                                    data-id="' . $data->id . '">Hapus</button>
                                ';
            })
            ->rawColumns(['aksi', 'is_active'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function reset(Request $request)
    {
        $user = User::find($request->id);
        $user->update([
            'password' => bcrypt($user->email)
        ]);
        return redirect()->back()->with('success', 'Password berhasil reset');
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
