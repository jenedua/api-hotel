<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestStoreRequest;
use App\Http\Requests\GuestUpdateRequest;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $guest = Guest::query();

        if ($request->has('name')) {
            $guest =    $guest->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('is_foreign')) {
            $guest =    $guest->where('is_foreign', $request->is_foreign);
        }
        //return   $guest->tosql();

        return $guest->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuestStoreRequest $request)
    {
        $guest = FacadesDB::transaction(function () use ($request) {
            $user = User::create($request->validated());
            $user->guest()->create($request->validated());
            return $user->load('guest');
        });

        return $guest;
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return $guest->load('user','addresses','phones','reservations');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuestUpdateRequest $request, Guest $guest)
    {
        $guest = FacadesDB::transaction(function () use ($request, $guest) {
            $guest->update($request->validated());
            $guest->user->update($request->validated());
            return $guest->load('user');
        });

        return $guest;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        $user->guest->delete();
        $user->delete();

        return response()->noContent();
    }
}
