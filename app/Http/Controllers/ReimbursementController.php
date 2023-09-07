<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reimbursement;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $reimbursement = Reimbursement::get();
            return DataTables::of($reimbursement)
                ->addIndexColumn()
                ->editColumn('photo', function ($item) {
                    return '<img src="' .  asset('storage/'.$item->photo)  . '" width="100px" height="100px">';
                })
                ->addColumn('status', function ($item) {
                    if ($item->status == "approved") {
                        return '
                    <td>
                        <div class="badge bg-light-success">
                            <span style="font-size:13px; color: #00AC78; padding:0.5rem"><b>Diterima</b></span>
                        </div>
                    </td>';
                    } elseif ($item->status == "rejected") {
                        return '
                    <td>
                        <div class="badge bg-light-danger">
                            <span style="font-size:13px; color: #F65464; padding:0.5rem"><b>Ditolak</b></span>
                        </div>
                    </td>
                    ';
                    } else {
                        return '
                        <td>
                            <div class="badge bg-light-warning">
                            <span style="font-size:13px; color: #FF7F22; padding:0.5rem"><b>Belum Disetujui</b></span>
                            </div>
                        </td>
                        ';
                    };
                })
                ->addColumn('actions', function ($item) {
                    $user = Auth::user(); 
                    
                    if (!$user->hasRole('Staff')) {
                        return '
                        <td>
                            <a href="' . route('reimbursement.edit', $item->id) . '" type="button" class="btn btn-light-primary btn-sm">
                            Validasi
                            </a>
                        </td>';
                    } else {
                        return '
                        <div class="dropdown text-end">
                            <!-- Dropdown untuk Staff -->
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
                                    <a href="' . route('reimbursement.edit', $item->id) . '" class="menu-link px-3">
                                        Edit 
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                                </div>
                            </div>
                        </div>';
                    }
                })
                ->rawColumns(['actions','photo','status'])
                ->make();
        }
        return view('reimbursement.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reimbursement.create', [
            'reimbursement' => new Reimbursement(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name_reimbursement' => 'required|string|max:255',
                'description' => 'required',
                'date' => 'required',
            ]);

            $photo = $request->file('photo');

            if ($photo) {
                $file_name = time() . '.' . $photo->getClientOriginalExtension();
                $file_path = $photo->storeAs('reimbursement', $file_name, 'public');
            }

            $request['user_id'] = auth()->user()->id;

            $reimbursement = Reimbursement::create([
                'user_id'       => $request->user_id,
                'photo'         => $file_path ?? null,
                'name_reimbursement' => $request->name_reimbursement,
                'description' => $request->description,
                'date' => $request->date,
            ]);
            
            
            return to_route('reimbursement.index',$reimbursement)->with('success', 'Reimbursement create successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reimbursement $reimbursement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('reimbursement.edit', [
            'reimbursement' => Reimbursement::whereId($id)->firstOrFail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $reimbursement = Reimbursement::findOrFail($id);

            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name_reimbursement' => 'required|string|max:255',
                'description' => 'required',
                'date' => 'required',
                'status' => 'required' 
            ]);
    

            if ($request->hasFile('photo')) {
                if ($reimbursement->photo) {
                    Storage::delete("storage/" . $reimbursement->photo);
                }
    
                $file_name = time() . '.' . $request->file('photo')->getClientOriginalExtension();
                $file_path = $request->file('photo')->storeAs('reimbursement', $file_name, 'public');
    
                $reimbursement->photo = $file_path;
            }
    
            $reimbursement->update([
                'name_reimbursement' => $request->name_reimbursement,
                'description' => $request->description,
                'date' => $request->date,
                'status'            => $request->status,
                'approved_at'       => $request->status == 'approved' ? now() : null,
                'rejected_at'       => $request->status == 'rejected' ? now() : null,
            ]);
    
            return redirect()->route('reimbursement.index')->with('success', 'Reimbursement updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reimbursement $reimbursement)
    {
        try {
            //check if photo exist
            if ($reimbursement->photo) {
                //delete photo
                Storage::disk('public')->delete($reimbursement->photo);
            }
            $reimbursement->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Reimbursement Deleted!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
