<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index', [
            'roles' => Role::with('users.employee')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->only('createTitle', 'createDescription'),
            [
                'createTitle' => 'required|string|unique:roles,title',
                'createDescription' => 'sometimes'
            ],
            [],
            [
                'createTitle' => 'title',
                'createDescription' => 'description'
            ]
        )->validate();

        Role::create([
            'title' => $request->createTitle,
            'description' => $request->createDescription
        ]);

        return redirect(route('roles.index'))->with('alert', [
            'type' => 'success',
            'message' => 'Role successfully created!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        Validator::make(
            $request->only('editTitle', 'editDescription'),
            [
                'editTitle' => 'required|string',
                'editDescription' => 'sometimes'
            ],
            [],
            [
                'editTitle' => 'title',
                'editDescription' => 'description'
            ]
        )->validate();

        $role->update([
            'title' => $request->editTitle,
            'description' => $request->editDescription
        ]);

        return redirect(route('roles.index'))->with('alert', [
            'type' => 'success',
            'message' => 'Role successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
    }
}
