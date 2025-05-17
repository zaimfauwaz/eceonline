<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Branch;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth'); // Line penting, jangan buang

        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user) {
                // Restrict customers (role 7) to specific routes
                if ($user->role == 7) {
                    $allowedRoutes = ['booking.index', 'booking.create', 'booking.store', 'booking.show'];
                    $currentRoute = $request->route()->getName();

                    if (!in_array($currentRoute, $allowedRoutes)) {
                        abort(403, 'Customers are only allowed to create, view, and list bookings.');
                    }
                }

                // Restrict admins (role 9) from accessing booking routes
                if ($user->role == 9) {
                    abort(403, 'Admins are not allowed to access booking routes.');
                }
            }

            return $next($request);
        });
    }

    public function index()
    {
        $user = Auth::user();
        $mainBranch = Branch::where('branch_id', 1)->first();

        $query = Booking::with('cars', 'user')->orderBy('created_at', 'desc');

        if ($user->role == 7) {
            // Customers see only their own bookings
            $query->where('user_id', $user->user_id);
        } 

        $bookings = $query->paginate(12);

        return view('booking.index', compact('bookings', 'mainBranch'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $cars = Car::with('branch')->get()->groupBy(function ($car) {
            return $car->branch->branch_name ?? 'No Branch';
        });
        $users = User::where('role', '7')->get(); // Fetch only users with the role '7'
        $mainBranch = Branch::where('branch_id', 1)->first();
        return view('booking.create', compact('cars', 'users', 'mainBranch'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_ids' => [
                'required',
                'array',
                function ($attribute, $value, $fail) use ($request) {

                    if (count($value) > 2) {
                        $fail('You can only book up to two cars at a time.');
                    }

                    foreach ($value as $carId) {
                        $overlappingBookings = Booking::whereHas('cars', function ($query) use ($carId) {
                            $query->where('booking_cars.car_id', $carId); // Specify table name for car_id
                        })
                        ->where(function ($query) use ($request) {
                            $query->whereBetween('booking_start', [$request->booking_start, $request->booking_end])
                                  ->orWhereBetween('booking_end', [$request->booking_start, $request->booking_end])
                                  ->orWhere(function ($query) use ($request) {
                                      $query->where('booking_start', '<=', $request->booking_start)
                                            ->where('booking_end', '>=', $request->booking_end);
                                  });
                        })
                        ->exists();

                        if ($overlappingBookings) {
                            $fail('One or more selected cars are already booked during the specified date range.');
                        }
                    }
                },
            ],
            'car_ids.*' => 'exists:cars,car_id',
            'user_id' => [
                'required',
                'exists:users,user_id',
                function ($attribute, $value, $fail) use ($request) {
                    $activeBookings = Booking::where('user_id', $value)
                        ->where('booking_status', 0) // Check for active bookings (Pending status)
                        ->where(function ($query) use ($request) {
                            $query->where('booking_start', '<=', $request->booking_end)
                                  ->where('booking_end', '>=', $request->booking_start);
                        })
                        ->first();

                    if ($activeBookings) {
                        $fail('You already have an active booking from ' . $activeBookings->booking_start->format('Y-m-d H:i') . ' to ' . $activeBookings->booking_end->format('Y-m-d H:i') . '.');
                    }
                },
            ],
            'booking_start' => 'required|date|after:' . now()->addDays(2)->toDateString(), // Ensure booking_start is at least two days from today
            'booking_end' => 'required|date|after_or_equal:booking_start', // Aligning with form field name
            'booking_status' => 'required|in:0,1,2', // Validate booking status (Pending, Approved, Rejected)
        ]);

        $booking = new Booking();
        $booking->user_id = $request->user_id;
        $booking->booking_start = $request->booking_start; // Aligning with form field name
        $booking->booking_end = $request->booking_end; // Aligning with form field name
        $booking->booking_status = $request->booking_status; // Correctly assigning booking_status
        
        // Set approved_by based on booking_status
        if ($request->booking_status == 1) {
            $booking->approved_by = Auth::id(); // Assign the current staff's user_id
        } else {
            $booking->approved_by = null; // Set to null for Pending or Rejected status
        }

        // Debugging logs to check booking_status
        Log::info('Before save:', ['booking_status' => $request->booking_status]);

        $booking->save();

        Log::info('After save:', ['booking_status' => $booking->booking_status]);

        // Attach cars to the booking using the pivot table
        $booking->cars()->attach($request->car_ids);

        return redirect()->route('booking.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $user = Auth::user();

        // Customers: can only view their own bookings
        if ($user->role == 7 && $booking->user_id != $user->user_id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        // Restricted staff: can only view bookings they approved or not yet approved
        if ($user->role == 3 && $booking->booking_status == 1 && $booking->approved_by != $user->user_id) {
            abort(403, 'Unauthorized access to this booking.');
        }

        // All other staff roles (e.g., admin, manager) can view everything

        $booking = Booking::with('cars', 'user')->findOrFail($booking->booking_id);
        $cars = $booking->cars;
        $user = $booking->user;
        $mainBranch = Branch::where('branch_id', 1)->first();

        return view('booking.show', compact(['booking', 'cars', 'user', 'mainBranch']));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $user = Auth::user();

        // Allow edit if not approved OR approved by this user
        if ($booking->booking_status == 1 && $booking->approved_by != $user->user_id) {
            abort(403, 'Unauthorized access to edit this booking.');
        }

        $cars = Car::with('branch')->get()->groupBy(function ($car) {
            return $car->branch->branch_name ?? 'No Branch';
        });

        $users = User::where('role', 7)->get(); // Only role 7 users
        $mainBranch = Branch::where('branch_id', 1)->first();
        $selectedCars = $booking->cars->pluck('car_id')->toArray();

        return view('booking.edit', compact('booking', 'cars', 'selectedCars', 'users', 'mainBranch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'car_ids' => [
                'required',
                'array',
                function ($attribute, $value, $fail) use ($request, $booking) {

                    if (count($value) > 2) {
                        $fail('You can only book up to two cars at a time.');
                    }

                    foreach ($value as $carId) {
                        $overlappingBookings = Booking::whereHas('cars', function ($query) use ($carId) {
                            $query->where('booking_cars.car_id', $carId); // Specify table name for car_id
                        })
                        ->where('booking_id', '!=', $booking->booking_id)
                        ->where(function ($query) use ($request) {
                            $query->whereBetween('booking_start', [$request->booking_start, $request->booking_end])
                                  ->orWhereBetween('booking_end', [$request->booking_start, $request->booking_end])
                                  ->orWhere(function ($query) use ($request) {
                                      $query->where('booking_start', '<=', $request->booking_start)
                                            ->where('booking_end', '>=', $request->booking_end);
                                  });
                        })
                        ->exists();

                        if ($overlappingBookings) {
                            $fail('One or more selected cars are already booked during the specified date range.');
                        }
                    }
                },
            ],
            'car_ids.*' => 'exists:cars,car_id',
            'user_id' => [
                'required',
                'exists:users,user_id'
            ],
            'booking_start' => 'required|date|after:' . now()->addDays(2)->toDateString(), // Ensure booking_start is at least two days from today
            'booking_end' => 'required|date|after_or_equal:booking_start', // Aligning with form field name
            'booking_status' => 'required|in:0,1,2', // Validate booking status (Pending, Approved, Rejected)
        ]);

        $booking->user_id = $request->user_id;
        $booking->booking_start = $request->booking_start; // Aligning with form field name
        $booking->booking_end = $request->booking_end; // Aligning with form field name
        $booking->booking_status = $request->booking_status; // Correctly assigning booking_status

        // Set approved_by based on booking_status
        if ($request->booking_status == 1) {
            $booking->approved_by = Auth::id(); // Assign the current staff's user_id
        } else {
            $booking->approved_by = null; // Set to null for Pending or Rejected status
        }

        // Debugging logs to check booking_status
        Log::info('Before save:', ['booking_status' => $request->booking_status]);

        $booking->save();

        Log::info('After save:', ['booking_status' => $booking->booking_status]);

        // Sync cars to the booking using the pivot table
        $booking->cars()->sync($request->car_ids);

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $user = Auth::user();

    // Only allow deletion if the user is the one who approved it
        if ($booking->approved_by !== $user->user_id && $booking->booking_status == 1) {
            return back()->with('error', 'You are not authorized to delete this booking.');
        }

        if ($booking->booking_status === 1) {
            return back()->with('error', 'Cannot delete an approved booking.');
        }

        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully.');
    }
}
