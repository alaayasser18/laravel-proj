<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
  
    public function index()
    {
     
        $managerId = auth()->user()->id; 
        $employees = Employee::where('manager_id', $managerId)->get();

        
        return view('employees.index', compact('employees'));
    }

  
    
    public function create()
    {
        
        return view('employees.create');
    }

    
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email|max:255',
            'phone' => 'required|string|max:15',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('employees', 'public');
            $validatedData['picture'] = $path;
        }

       
        $validatedData['manager_id'] = auth()->user()->id; 

        
        Employee::create($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully');
    }

  
    public function edit($id)
    {
      
        $employee = Employee::findOrFail($id);

       
        return view('employees.edit', compact('employee'));
    }

  
    public function update(Request $request, $id)
    {
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $id, // Ensure unique email
            'phone' => 'required|string|max:15',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        
        $employee = Employee::findOrFail($id);

      
        if ($request->hasFile('picture')) {
            // Delete the old picture if exists
            if ($employee->picture) {
                Storage::disk('public')->delete($employee->picture);
            }
           
            $path = $request->file('picture')->store('employees', 'public');
            $validatedData['picture'] = $path;
        }

    
        $employee->update($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    
    public function destroy($id)
    {
        
        $employee = Employee::findOrFail($id);

       
        if ($employee->picture) {
            Storage::disk('public')->delete($employee->picture);
        }

       
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
