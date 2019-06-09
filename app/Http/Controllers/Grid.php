<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Grid extends Controller
{
    public function home() {
    	
    	$grids = DB::table('grid')
    		->select(DB::raw('concat(name, " ",sername) as fullname, department_name, grid.employee_id, grid.department_id'))
    		->join('employee', 'employee.employee_id', '=', 'grid.employee_id')
    		->join('department', 'department.id', '=', 'grid.department_id')
    		->get();


        $deps = DB::table('department')->groupBy('department_name')->get();
  
        $ems = DB::table('employee')
            ->select(DB::raw('concat(name, " ",sername) as fullname'))
            ->groupBy('employee_id')->get();

  


    	$countEmployee = DB::table('employee')
    		->select(DB::raw('count(*) as count'))
    		->get();


    	$countDepartment = DB::table('department')
    		->select(DB::raw('count(*) as count'))
    		->get();

        $a[0][0] = '';
        for ($i = 0; $i < $countDepartment[0]->count; $i++) {
            //echo $deps[$i]->department_name . '-';
            $a[0][$i + 1] = $deps[$i]->department_name;
        }

        for ($j = 0; $j < $countEmployee[0]->count; $j++) {
                //echo $ems[$j]->fullname . '-';
                $a[$j + 1][0] = $ems[$j]->fullname;
                for ($i = 0; $i < $countDepartment[0]->count; $i++) {
                    $a[$j + 1][$i + 1] = '';
                }
            }

        foreach ($grids as $grid) {
            for ($i = 0; $i < $countDepartment[0]->count; $i++) {
                if ($grid->department_name == $deps[$i]->department_name) {
                    break;
                }
            }
            for ($j = 0; $j < $countEmployee[0]->count; $j++) {
               if ($grid->fullname == $ems[$j]->fullname) {
                    break;
               } 
            }
            $a[$j + 1][$i + 1] = '+';

        }

    	return view('home', ['grids' => $a]);
    }
}
