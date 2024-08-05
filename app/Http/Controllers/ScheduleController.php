<?php

namespace App\Http\Controllers;

use App\Helpers\ConstHelpers;
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
        private Animal $animal,
    ) {
        
    }

    public function index(Request $request)
    {
        $query = $this->schedule->query();

        if ($request->date) {
            $query->where('date', $request->date);
        }

        if ($request->type) {
            $query->whereHas('animal', function ($query) use ($request) {
                $query->where('type', $request->type);
            });
        }

        $userAuth = auth()->user();

        $doctors = [];
        $animals = [];
        if ($userAuth->role == 'receptionist' || $userAuth->role == 'admin') {
            $schedules = $query->with('animal', 'doctor')->get();
            $doctors = $this->user->where('role', 'doctor')->get();
            $animals = $this->animal->all();
        } else if ($userAuth->role == 'doctor') {
            $schedules = $query->where('doctor_id', auth()->id())->with('animal', 'doctor')->get();
            $animals = $this->animal->all();
        } else {
            $schedules = $query->where('user_id', auth()->id())->with('animal', 'doctor')->get();
            $animals = auth()->user()->animalsOptions;
        }

        $optionsAnimals = ConstHelpers::OPTIONS_ANIMALS_TYPE;

        return Inertia::render('Schedules/Index', [
            'schedules' => $schedules,
            'animals' => $animals,
            'doctors' => $doctors,
            'userAuth' => $userAuth,
            'optionsAnimals' => $optionsAnimals
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