<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffStoreRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\Http\Resources\StaffResource;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $all = Staff::all();
        return StaffResource::collection($all);
    }

    public function store(StaffStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $staff = Staff::create($validated);

        return StaffResource::make($staff);
    }

    public function show($id)
    {
        $staff = Staff::findOrFail($id);

        return StaffResource::make($staff);
    }

    public function update($id, StaffUpdateRequest $request)
    {
        $staff = Staff::findOrFail($id);
        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $staff->update($validated);

        return StaffResource::make($staff);
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return response()->json([
            'message' => 'Staff deleted successfully'
        ]);
    }
}
