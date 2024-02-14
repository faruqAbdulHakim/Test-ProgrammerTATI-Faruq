<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

function predikat_kinerja($hasil_kerja, $perilaku)
{
    $predikat = [
        ['Sangat Kurang', 'Butuh Perbaikan', 'Butuh Perbaikan'],
        ['Kurang/misconduct', 'Baik', 'Baik'],
        ['Kurang/misconduct', 'Baik', 'Sangat Baik'],
    ];

    return $predikat[$hasil_kerja][$perilaku];
}

function helloworld($n)
{
    $value = '';
    for ($i = 1; $i <= $n; $i++) {
        $tmp = '';
        if ($i % 4 == 0) {
            $tmp = $tmp . 'hello';
        }
        if ($i % 5 == 0) {
            $tmp = $tmp . 'world';
        }
        $tmp = strlen($tmp) == 0 ? $i : $tmp;
        $value = $value . $tmp . ' ';
    }
    return $value;
}

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('index');
    }

    public function test_2()
    {
        $provinces = Province::all();
        return view('test-2', compact('provinces'));
    }

    public function test_3(Request $request)
    {

        if ($request->isMethod('POST')) {
            $request->validate([
                'hasil_kerja'     => 'required|numeric',
                'perilaku'     => 'required|numeric',
            ]);
            $data = predikat_kinerja($request['hasil_kerja'], $request['perilaku']);
            return view('test-3', compact('data'));
        }

        return view('test-3');
    }

    public function test_4(Request $request)
    {


        if ($request->isMethod('POST')) {
            $request->validate([
                'input'     => 'required|numeric',
            ]);
            $data = helloworld($request['input']);
            return view('test-4', compact('data'));
        }

        return view('test-4');
    }
}
