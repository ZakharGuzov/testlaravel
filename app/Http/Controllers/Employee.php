<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Employee extends Controller
{
    
	public function show()
    {

        $joins = DB::table('grid')
            ->join('department', 'department.id', '=', 'grid.department_id')
            ->get();
    	
    	$employees = DB::table('employee')->get();
    	return view('employee.show', [
            'employees' => $employees,
            'joins' => $joins
        ]);

    }

    public function add()
    {
    	$departments = DB::table('department')->get();

        if (empty($departments[0])){
            $err = 'Нужно сначала дабавить отдел';
            return view('err', ['err' => $err]);
        }

    	return view('employee.add', ['departments' => $departments]);
    }

    public function store(Request $request)
    {
    	$employeeId = DB::table('employee')->insertGetId([
    		'name' => $request->name,
    		'sername' => $request->sername,
    		'patronymic' => $request->patronymic,
    		'sex' => $request->sex,
    		'salary' => $request->salary
    	]);	
    	
    	
        foreach ($request['department'] as $value) {
			DB::table('grid')->insert([
	    		'department_id' => $value,
	    		'employee_id' => $employeeId
	    	]);
    	}


    	return redirect('/employee');
    }

    public function delete($id)
    {
    	DB::table('employee')->where('employee_id', $id)->delete();
        DB::table('grid')->where('employee_id', $id)->delete();
    	return redirect('/employee');
    }

    public function edit($id)
    {
    	$employee = DB::table('employee')->where('employee_id', $id)->get();

    	$male = $female = '';
    	$employee[0]->sex == 'male' ? $male = 'checked' : $female = 'checked'; 

        $departments = DB::table('department')->get();
        $checkDepartments = DB::table('department')->where('id', $id)->get();

        $joins = DB::table('grid')
            ->join('department', 'department.id', '=', 'grid.department_id')
            ->where('employee_id', $id)
            ->get();

        foreach ($departments as $department) {
            $department->check = '';
            foreach ($joins as $join) {
                if ($department->id == $join->id) {
                    $department->check = 'checked';
                    break;
                }
            }
        }

    	return view('employee.edit', [
    		'id' => $id,
    		'name' => $employee[0]->name,
    		'sername' => $employee[0]->sername,
    		'patronymic' => $employee[0]->patronymic,
    		'male' => $male,
    		'female' => $female,
    		'salary' => $employee[0]->salary,
            'departments' => $departments
    	]);
    }

    public function update(Request $request, $id)
    {
    	DB::table('employee')->where('employee_id', $id)->update([
    		'name' => $request->name,
    		'sername' => $request->sername,
    		'patronymic' => $request->patronymic,
    		'sex' => $request->sex,
    		'salary' => $request->salary
    	]);
        
        
        $departments = DB::table('department')->get();
        DB::table('grid')->where('employee_id', $id)->delete();
        foreach ($departments as $department) {
            if ($request[$department->id]) {
                DB::table('grid')->insert([
                    'department_id' => $request[$department->id],
                    'employee_id' => $id
                ]);
            }
        }

    	return redirect('/employee');
    }
}
