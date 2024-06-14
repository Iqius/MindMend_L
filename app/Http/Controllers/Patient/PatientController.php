<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\Session;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Method untuk mengambil data umum yang diperlukan
    private function getGeneralData()
    {
        return [
            'user' => Auth::user(),
            'doctorCount' => Doctor::count(),
            'patientCount' => Patient::count(),
            'appointmentCount' => Appointment::count(),
            'sessionCount' => Session::count(),
            'appointments' => Appointment::all(),
        ];
    }

    // Method untuk menampilkan halaman index patient
    public function index()
    {
        $data = $this->getGeneralData();

        return view('patient.index', $data);
    }
    
    // Method untuk menampilkan halaman daftar dokter patient
    public function doctors()
    {
        $user = Auth::user(); // Mengambil data user yang sedang login
        $doctors = Doctor::orderBy('docid', 'desc')->get();
        $list = Doctor::select('docname', 'docemail')->get();
        $specialties = Specialty::all(); // Ambil semua spesialisasi
        $list11 = Doctor::all(); // Atau query yang sesuai untuk mendapatkan jumlah baris
    
        return view('patient.doctors', compact('user', 'doctors', 'list', 'list11', 'specialties'));
    }

    // Method untuk pencarian dokter
    public function searchDoctor(Request $request)
    {
        $searchTerm = $request->input('search');

        $doctors = Doctor::where('docname', 'like', '%' . $searchTerm . '%')->get();

        return view('patient.doctor', compact('doctors'));
    }

    // Method untuk menampilkan halaman sesi yang dijadwalkan patient
 // Method untuk menampilkan halaman sesi yang dijadwalkan patient
public function schedule(Request $request)
{
    $data = $this->getGeneralData();
    
    $searchTerm = $request->input('search');
    
    $schedules = Schedule::where('title', 'like', '%' . $searchTerm . '%')
                        ->orWhere('scheduledate', 'like', '%' . $searchTerm . '%')
                        ->orWhereHas('doctor', function ($query) use ($searchTerm) {
                            $query->where('docname', 'like', '%' . $searchTerm . '%');
                        })
                        ->orderBy('scheduledate')
                        ->orderBy('scheduletime')
                        ->get();

    $data['schedules'] = $schedules;

    // Ambil daftar dokter untuk ditampilkan di form pencarian
    $doctors = Doctor::distinct()->select('docname')->get();
    
    // Mengambil semua jadwal (mungkin hanya untuk keperluan tambahan)
    // $schedules = Schedule::all(); // Tidak perlu diambil lagi karena sudah di atas
    $list11 = Schedule::all();
    // Ambil user yang sedang login
    $user = Auth::user();
    // Kembalikan view dengan data yang dibutuhkan
    return view('patient.schedule', compact('user', 'doctors', 'schedules','list11'));
}

public function searchSchedule(Request $request)
{
    $data = $this->getGeneralData();
    
    // Lakukan pencarian sesuai dengan input yang diberikan
    $searchTerm = $request->input('search');
    
    // Lakukan query untuk mencari jadwal berdasarkan judul, tanggal, atau nama dokter
    $schedules = Schedule::where('title', 'like', '%' . $searchTerm . '%')
                        ->orWhere('scheduledate', 'like', '%' . $searchTerm . '%')
                        ->orWhereHas('doctor', function ($query) use ($searchTerm) {
                            $query->where('docname', 'like', '%' . $searchTerm . '%');
                        })
                        ->orderBy('scheduledate')
                        ->orderBy('scheduletime')
                        ->get();

    // Menyimpan hasil pencarian jadwal ke dalam data
    $data['schedules'] = $schedules;
    
    // Ambil daftar dokter untuk ditampilkan di form pencarian
    $doctors = Doctor::distinct()->select('docname')->get();
    
    // Ambil user yang sedang login
    $user = Auth::user();
    
    // Variabel untuk judul halaman (opsional)
    $searchschedule = "Your Search Results"; // Misalnya
    
    // Kembalikan view dengan data yang dibutuhkan
    return view('patient.schedule', compact('user', 'doctors', 'schedules', 'searchschedule'));
}

public function appointment($id)
    {
        // Query untuk mendapatkan data schedule berdasarkan $id
        $schedule = Schedule::findOrFail($id);

        // Hitung nomor appointment yang baru
        $appointmentNumber = Appointment::where('schedule_id', $id)->count() + 1;

        // Ambil tanggal hari ini
        $today = now()->format('Y-m-d');

        // Kembalikan view dengan data yang dibutuhkan
        return view('patient.appointment', compact('schedule', 'appointmentNumber', 'today'));
    }

    public function completeBooking(Request $request)
    {
        // Validasi form booking disini jika diperlukan
        $request->validate([
            // Atur validasi sesuai kebutuhan
        ]);

        // Proses penyimpanan data booking ke dalam database
        Appointment::create([
            'schedule_id' => $request->schedule_id,
            'appointment_number' => $request->appointment_number,
            'appointment_date' => $request->appointment_date,
            // Sesuaikan dengan field-field yang diperlukan
        ]);

        // Redirect user ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('patient.index')->with('success', 'Booking completed successfully!');
    }
    // Method untuk pengaturan lainnya seperti pengelolaan appointment, dsb
}
