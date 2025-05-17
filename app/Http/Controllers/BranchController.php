<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (Gate::denies('manage-branches')) {
                abort(403, 'You do not have permission to access branches management.');
            }
            
            return $next($request);
        }) -> except(['index', 'show']);
    }

    public function index()
    {
        $branches = Branch::with('cars')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        $mainBranch = Branch::where('branch_id', 1)->first();
        return view('branch.index', compact(['branches', 'mainBranch']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainBranch = Branch::where('branch_id', 1)->first();
        return view('branch.create', compact('mainBranch'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_location' => 'required|string|max:255',
        ]);

        Branch::create($request->all());

        return redirect()->route('branch.index')->with('success', 'Branch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        $mainBranch = Branch::where('branch_id', 1)->first();
        return view('branch.show', compact(['branch', 'mainBranch']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        $mainBranch = Branch::where('branch_id', 1)->first();
        return view('branch.edit', compact(['branch', 'mainBranch']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_location' => 'required|string|max:255',
        ]);

        $branch->update($request->all());

        return redirect()->route('branch.index')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branch.index')->with('success', 'Branch deleted successfully.');
    }
}
