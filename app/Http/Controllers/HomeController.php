<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students;
use App\Models\Projects;
use DB;
use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {

        $students =  students::get();
        $projects = projects::get();
        return view('welcome',['students'=>$students, 'projects' =>$projects]);
    }

    public function addStudent(Request $req)
    {
        if ($this->checkFullName($req->First_name, $req->Last_name) == true)
        {
            $students = new students();
            $students->firstname = $req->First_name;
            $students->lastname = $req->Last_name;
            $students->save();
            $success = 'Student added successfully';
            return back()->with(['success' => $success]);
        }else
        $error = 'Failed to add a new student, students must have a unique full name';
        return back()->with(['error' => $error]);
    }

    public function deleteStudent(Request $req)
    {
        $students = students::where('id', '=', $req->Delete);
        $students->delete();
        $success = 'Student deleted successfully';
        return back()->with(['success' => $success]);
    }

    public function addNewProjets(Request $req)
    {
        if ($this->checkIfProjectExists($req->Project_name) == true)
        {
            $projects = new projects();
            $projects->projectName = $req->Project_name;
            $projects->numberOfGroups = $req->Amount_of_groups;
            $projects->studentsPerGroup = $req->Students_per_group;
            $projects->save();
            $success = 'New project added successfully';
            return back()->with(['success' => $success]);
        }else{
            $error = 'Failed to add a new project, project with the same name already exists';
            return back()->with(['error' => $error]);
        }
    }

    public function addStudentToGroup(Request $req)
    {
        if ($this->checkIfProjectGroupHasSpace($req->Project_name, $req->Group_number) == true){
            $projects = projects::get();
            $student = students::where('firstname', '=', $req->First_name)->where('lastname', '=', $req->Last_name )->first();
            foreach ($projects as $project){
                if ($project->projectName == $req->Project_name ){
                    $student->projectID = $project->id;
                }
            }
            $student->projectGroup = $req->Group_number;
            $student->save();
            $success = 'Student has been assigned to a project successfully';
            return back()->with(['success' => $success]);
        }else{
            $error = 'Failed to assign a student to the project group, group is full';
            return back()->with(['error' => $error]);
        }

    }

    function checkFullName ($firstname, $lastname): bool
    {
        $students =  students::get();
        foreach ($students as $student){
            if ($firstname == $student->firstname && $lastname == $student->lastname)
            {
                return false;
            }
        }
        return true;
    }

    function checkIfProjectExists($projectname): bool
    {
        $projects =  projects::get();
        foreach ($projects as $project){
            if ($projectname == $project->projectName)
            {
                return false;
            }
        }
        return true;
    }

    function checkIfProjectGroupHasSpace($projectname, $groupnumber): bool
    {
        $project = projects::select('studentsPerGroup', 'id')->where('projectName', '=', $projectname)->first();
        $students = students::get();
        $count = 0;
        foreach ($students as $student){
            if ($student->projectGroup == $groupnumber && $student->projectID == $project->id){
                $count++;
            }
        }
        if ($count < $project->studentsPerGroup){
            return true;
        }
        return false;

    }
}
