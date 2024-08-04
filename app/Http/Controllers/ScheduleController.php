<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleCreateRequest;
use App\Models\Animal;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function __construct(
        private Schedule $schedule,
        private User $user,
        private Animal $animal
    ) {
        
    }
    public function index(Request $request)
    {
        dd($request->all());
        $userAuth = auth()->user();

        $schedules = [];
        $doctors = [];
        $animals = [];
        if ($userAuth->role == 'receptionist' || $userAuth->role == 'admin') {
            $schedules = $this->schedule
                ->with('animal', 'doctor')
                ->get();            
            $doctors = $this->user->where('role', 'doctor')->get();
            $animals = $this->animal->all();
        } else if ($userAuth->role == 'doctor') {
            $schedules = $this->schedule
                ->where('doctor_id', auth()->id())
                ->with('animal', 'doctor')
                ->get();
            $animals = $this->animal->all();
        } else {
            $schedules = $this->schedule
                ->where('user_id', auth()->id())
                ->with('animal', 'doctor')
                ->get();
            $animals = auth()->user()->animalsOptions;
        }

        return Inertia::render('Schedules/Index', [
            'schedules' => $schedules,
            'animals' => $animals,
            'doctors' => $doctors,
            'userAuth' => $userAuth,
        ]);
    }

    public function create(ScheduleCreateRequest $request)
    {
        $animal = Animal::findOrFail($request->animal_id);

        if ($animal) {
            $this->schedule->create([
                'symptoms' => $request->symptoms,
                'date' => $request->date,
                'time' => $request->time,
                'animal_id' => $animal->id,
                'user_id' => auth()->id()
            ]);
    
            return redirect()->route('schedules');
        } else {
            return redirect()->back()->withErrors(['animal_id' => 'Animal not found']);
        }
    }

    public function update(Request $request, int $scheduleId)
    {
        $schedule = $this->schedule->findOrFail($scheduleId);

        $animal = Animal::findOrFail($request->animal_id);

        if ($animal) {
            $schedule->update($request->all());
    
            return redirect()->route('schedules');
        } else {
            return redirect()->back()->withErrors(['animal_id' => 'Animal not found']);
        }
    }

    public function updateAddDoctor(Request $request, int $scheduleId)
    {
        $schedule = $this->schedule->findOrFail($scheduleId);

        $doctor = $this->user->findOrFail($request->doctor_id);

        if ($doctor) {
            $schedule->update([
                'doctor_id' => $doctor->id
            ]);

            return redirect()->route('schedules');
        } else {
            return redirect()->back()->withErrors(['doctor_id' => 'Doctor not found']);
        }
    }

    public function destroy(int $scheduleId)
    {
        $schedule = $this->schedule->findOrFail($scheduleId);

        $schedule->delete();

        return redirect()->route('schedules');
    }
}