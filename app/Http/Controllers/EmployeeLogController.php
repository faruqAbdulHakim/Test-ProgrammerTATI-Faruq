<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $employeeLogs = EmployeeLog::where('user_id', $user->id)->orderBy('date', 'desc')->get();        
        $subordinateLogs = DB::table('employee_logs')
            ->leftJoin('users', 'users.id', '=', 'employee_logs.user_id')
            ->where('users.superior_id', $user->id)
            ->select('employee_logs.*', 'users.name as subordinate')
            ->orderBy('employee_logs.date', 'desc')
            ->orderBy('users.name', 'asc')
            ->get();

        return view('test-1', compact('employeeLogs', 'subordinateLogs'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('test-1.form')->with('type', 'create');
        }

        $user = Auth::user();

        $request->validate([
            'log' => 'required',
            'date' => 'required|date'
        ]);

        EmployeeLog::create([
            'log' => $request->log,
            'date' => $request->date,
            'status' => 'Pending',
            'user_id' => $user->id,
        ]);
        
        return redirect()->route('test.1')->with('success', 'Berhasil Menambahkan Log Baru'); 
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Pending,Disetujui,Ditolak',
        ]);

        if ($validator->fails()) {
            return redirect()->route('test.1')->with('error', 'Gagal mengubah status log');
        }

        $employeeLog = EmployeeLog::find($id);

        if ($employeeLog == null) {
            return redirect()->route('test.1')->with('error', 'Tidak dapat menemukan Log');
        }

        $employeeLog->status = $request->status;
        $employeeLog->save();
        return redirect()->route('test.1')->with('success', 'Berhasil mengubah status Log');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $employeeLog = EmployeeLog::find($id);

        if ($employeeLog == null) {
            return redirect()->route('test.1')->with('error', 'Tidak dapat menemukan Log');
        }

        $employeeLog->delete();
        return redirect()->route('test.1')->with('success', 'Berhasil Menghapus Log');
    }
}
