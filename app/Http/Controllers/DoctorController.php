<?php
// app/Http/Controllers/Patient/DoctorController.php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        // Ambil data dokter dari model Doctor
        $doctors = Doctor::orderBy('docid', 'desc')->get();
        return view('patient.doctor', compact('doctors'));
    }

    public function view($id)
    {
        // Ambil data dokter berdasarkan ID
        $doctor = Doctor::find($id);
        return view('patient.doctor', compact('doctor'));
    }

    public function edit($id)
    {
        // Ambil data dokter berdasarkan ID untuk diedit
        $doctor = Doctor::find($id);
        return view('patient.doctor', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        // Validasi dan simpan data yang diperbarui
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'tele' => 'required',
            'spec' => 'required',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password',
        ]);

        $doctor = Doctor::find($id);
        $doctor->docname = $request->name;
        $doctor->docemail = $request->email;
        $doctor->doctel = $request->tele;
        $doctor->specialties = $request->spec;
        $doctor->docpassword = bcrypt($request->password);
        $doctor->save();

        return redirect()->route('patient.doctors')->with('success', 'Doctor updated successfully!');
    }

    public function delete($id)
    {
        // Hapus dokter berdasarkan ID
        $doctor = Doctor::find($id);
        $doctor->delete();

        return redirect()->route('patient.doctors')->with('success', 'Doctor deleted successfully!');
    }
}
