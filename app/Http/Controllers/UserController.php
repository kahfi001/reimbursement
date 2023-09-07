<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::whereIn('name', ['Finance', 'Staff'])->get();
            $user = User::role($roles)->get();
            return DataTables::of($user)
                ->addIndexColumn()
                ->editColumn('role', function ($item) {
                    return $item->getRoleNames()->first() ?? '-';
                })
                ->addColumn('actions', function ($item) {
                    return 
                    '<div class="dropdown text-end">
                        <button type="button" class="btn btn-secondary btn-sm btn-active-light-primary rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-bs-toggle="dropdown">
                            Actions
                            <span class="svg-icon svg-icon-3 rotate-180 ms-3 me-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                </svg>
                            </span>
                        </button>
                        <div class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-100px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="' . route('user.edit', $item->id) . '" class="menu-link px-3">
                                    Edit Profile
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                            </div>
                        </div>
                    </div>';
                })
                ->rawColumns(['actions'])
                ->make();
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create', [
            'user' => new User(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'nip' => 'required',
                'password' => 'required',
            ]);

            $user = User::create([
                'name' => $request->name,
                'nip' => $request->nip,
                'password' => Hash::make($request->password),
            ]);
            
            $role = Role::firstOrCreate(['name' => $request['role']]);
            $user->assignRole($role);
            
            return to_route('user.index',$user)->with('success', 'User create successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
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
        return view('admin.users.edit', [
            'user' => User::whereId($id)->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'nip' => 'required',
            ]);

            $user = User::findOrFail($id);


            $user->update([
                'name'          => $request->name ?? $user->name,
                'nip'           => $request->nip ?? $user->nip,
            ]);

            return to_route('user.index')->with('success', 'User update successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            //check if photo exist
            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'User Deleted!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
