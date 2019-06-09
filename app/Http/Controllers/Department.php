<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Department extends Controller
{

    public function show()
    {
    	$departments = DB::table('department')->get();

    	$counts = DB::table('department')
    		->select(DB::raw('count(*) as count, department_name, department_id'))
    		->groupBy('department_id')
    		->join('grid', 'department.id', '=', 'department_id')
    		->get();

    	$maxs = DB::table('employee')
    		->select(DB::raw('employee.salary, grid.department_id'))
    		->join('grid', 'employee.employee_id', '=', 'grid.employee_id')
    		->get();

    	foreach ($departments as $department) {
            $department->count = 0;
    		foreach ($counts as $count) {
    			if ($department->id == $count->department_id) {
    				$department->count = $count->count;
    				break;
    			}
    		}
    		$department->max = 0;
    		foreach ($maxs as $max) {
    			if ($department->id == $max->department_id) {
    				$department->max = max($department->max, $max->salary);
    			}
    		}
    	}

        // echo '<pre>';
        // echo var_dump($counts) . '</pre>';

    	return view('department.show', [
            'departments' => $departments
        ]);
    }

    public function add()
    {	
    	return view('department.add');
    }

    public function store(Request $request)
    {
    	try {
    		DB::table('department')->insert(['department_name' => $request->department]);	
    	} catch(Exception $e) {
    		return $e->getMessage();
    	}
    	//!!
    	return redirect('/department');
    }

    public function edit($id)
    {
    	$department = DB::table('department')->where('id', $id)->get();
    	return view('department.edit', [
    		'department_name' => $department[0]->department_name,
    		'id' => $id
    	]);
    }

    public function delete($id)
    {
        $department = DB::table('department')
            ->join('grid', 'id', '=', 'department_id')
            ->where('id', $id)->get();

        if (empty($department[0])){
            DB::table('department')->where('id', $id)->delete();
            return redirect('/department');
        }

        $err = 'Нельзя удалить в этом отделе есть сотрудник';
        return view('err', ['err' => $err]);
    }

    public function update(Request $request, $id)
    {
    	DB::table('department')->where('id', $id)
    		->update(['department_name' => $request->department]);
    	return redirect('/department');
    }
}
