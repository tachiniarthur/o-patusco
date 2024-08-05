<?php

namespace App\Http\Controllers;

use App\Helpers\ConstHelpers;
use App\Http\Requests\AnimalCreateRequest;
use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnimalController extends Controller
{
    public function __construct(
        private Animal $animal,
    ) {
        
    }
    public function index()
    {
        $userAuth = auth()->user();

        $animals = [];

        if ($userAuth->role == 'receptionist' || $userAuth->role == 'admin') {
            $animals = $this->animal->all();
        } else {
            $animals = $this->animal->where('user_id', auth()->id())->get();
        }

        $optionsAnimals = ConstHelpers::OPTIONS_ANIMALS_TYPE;
        $optionsSizes = ConstHelpers::OPTIONS_ANIMALS_SIZES;

        return Inertia::render('Animals/Index', [
            'animals' => $animals,
            'userAuth' => $userAuth,
            'optionsAnimals' => $optionsAnimals,
            'optionsSizes' => $optionsSizes
        ]);
    }

    public function create(AnimalCreateRequest $request)
    {
        $this->animal->create([
            'name' => $request->name,
            'age' => $request->age,
            'type' => $request->type,
            'breed' => $request->breed,
            'weight' => $request->weight,
            'size' => $request->size,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('animals');
    }

    public function update(Request $request, int $animalId)
    {
        $animal = $this->animal->findOrFail($animalId);

        $animal->update($request->all());

        return redirect()->route('animals');
    }

    public function destroy(int $animalId)
    {
        $animal = $this->animal->findOrFail($animalId);

        $animal->delete();

        return redirect()->route('animals');
    }
}