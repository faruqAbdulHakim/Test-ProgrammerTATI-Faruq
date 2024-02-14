<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::all();

        return response()->json([
            'status' => 'success',
            'data'  => $provinces
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'name'  =>  'required',
                'lat'   =>  'required|numeric',
                'lng'  =>  'required|numeric',
            ]);

            $province = Province::create([
                'name' => $request->name,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);

            return redirect()->route('test.2');
        }

        return view('test-2.form')->with('type', 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
            'lat'   =>  'required|numeric',
            'lng'  =>  'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Fail',
                'errors' => $validator->errors()
            ], 400);
        }

        $province = Province::create([
            'name' => $request->name,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);


        return response()->json([
            'status' => 'success',
            'data' => $province
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $province = Province::find($id);

        if ($province == null) {
            return response()->json([
                'status' => 'Not Found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $province,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $province = Province::find($id);

        if ($province == null) {
            return redirect()->route('test.2')->with('delete-failed', 'Gagal mengubah data');
        }

        if ($request->isMethod('PUT')) {
            $request->validate([
                'name'  =>  'required',
                'lat'   =>  'required|numeric',
                'lng'  =>  'required|numeric',
            ]);

            $province->name = $request->name;
            $province->lat = $request->lat;
            $province->lng = $request->lng;
            $province->save();

            return redirect()->route('test.2');
        }

        return view('test-2.form', compact('province'))->with('type', 'edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $province = Province::find($id);

        if ($province == null) {
            return response()->json([
                'status' => 'Not Found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'  =>  'required',
            'lat'   =>  'required|numeric',
            'lng'  =>  'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Fail',
                'errors' => $validator->errors()
            ], 400);
        }

        $province->name = $request->name;
        $province->lat = $request->lat;
        $province->lng = $request->lng;
        $province->save();

        return response()->json([
            'status' => 'success',
            'data' => $province,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $province = Province::find($id);

        if ($province == null) {
            return response()->json([
                'status' => 'Not Found'
            ], 404);
        }

        $province->delete();
        return response()->json([
            'status' => 'success'
        ], 204);
    }

    /**
     * Delete the specified resource and restart.
     */
    public function delete($id)
    {
        $province = Province::find($id);

        if ($province == null) {
            return redirect()->route('test.2')->with('delete-failed', 'Gagal menghapus data');
        }

        $province->delete();
        return redirect()->route('test.2')->with('delete-success', 'Berhasil menghapus data');
    }
}
