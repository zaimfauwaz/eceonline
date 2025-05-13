<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CarController extends Controller
{
     public function __construct() {
        $this->middleware(function ($request, $next) {
            if (Gate::denies('manage-cars')) {
                abort(403, 'You do not have permission to access car management.');
            }
            
            return $next($request);
        })->except(['index', 'show']);
    }

    public function index()
    {
        $cars = Car::with('branch')
            ->paginate(6);
        $mainBranch = Branch::where('branch_id', 1)->first();
        return view('car.index', compact(['cars', 'mainBranch']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainBranch = Branch::where('branch_id', 1)->first();
        $branches = Branch::all();
        return view('car.create', compact(['branches','mainBranch']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,branch_id',
            'car_brand' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_color' => 'required|string|max:255',
            'car_type' => 'required|string|max:255',
            'car_transmission' => 'required|integer',
            'car_generation' => 'nullable|integer',
            'car_description' => 'nullable|string|max:255',
            'car_image_url' => 'nullable|string|max:255',
            'car_mileage' => 'required|integer',
            'car_horsepower' => 'required|integer',
            'car_top_speed' => 'required|integer',
            'car_fuel_type' => 'required|string|max:255',
            'car_seats' => 'required|integer',
            'car_engine' => 'required|string|max:255',
            'car_market_price' => 'required|integer'
        ]);

        try {
            Car::create($validated);
            return redirect()->route('car.index')->with('success', 'Car created successfully.');
        } catch (\Exception $e) {
            \Log::error('Car creation failed: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create car. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $car = Car::with('branch')->findOrFail($car->car_id);
        $mainBranch = Branch::where('branch_id', 1)->first();
        return view('car.show', compact(['car', 'mainBranch']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $car = Car::with('branch')->findOrFail($car->car_id);
        $mainBranch = Branch::where('branch_id', 1)->first();
        return view('car.edit', compact(['car', 'mainBranch']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,branch_id',
            'car_brand' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_color' => 'required|string|max:255',
            'car_type' => 'required|string|max:255',
            'car_transmission' => 'required|integer',
            'car_generation' => 'nullable|integer',
            'car_description' => 'nullable|string|max:1000',
            'car_image_url' => 'nullable|string|max:255',
            'car_mileage' => 'required|integer',
            'car_horsepower' => 'required|integer',
            'car_top_speed' => 'required|integer',
            'car_fuel_type' => 'required|string|max:255',
            'car_seats' => 'required|integer',
            'car_engine' => 'required|string|max:255',
            'car_market_price' => 'required|integer'
        ]);

        try {
            $car->update($validated);
            return redirect()->route('car.show', $car->car_id)->with('success', 'Car updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update car. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        try {
            $car->delete();
            return redirect()->route('car.index')->with('success', 'Car deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete car. Please try again.');
        }
    }

}
