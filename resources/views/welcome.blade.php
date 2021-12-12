<!DOCTYPE html>
@if(session()->has('error'))
    <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{session('error')}}
    </div>
@endif
@if(session()->has('success'))
    <div id="successMessage" class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{session('success')}}
    </div>
@endif
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            table, td {
                border: 1px solid black;
            }
            body {
                font-family: 'Nunito', sans-serif;
            }
            .button {
                background-color: #e7e7e7;
                border: none;
                color: black;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }
        </style>
    </head>
    <body class="antialiased">

    <div class="card-body">
        <button class="button" data-toggle="modal" data-target="#addStudent">Add a new student</button>
    </div>
    <div>
        <h2 >Students</h2>
    </div>
    <form method="post" action="{{ route('delete') }}">
        @csrf
        <div class="card-body">
            <table class="table">
                <thead >
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Actions</th>
                </thead>
                @foreach($students as $key => $student)
                    <tbody>
                    <tr>
                        <td>{{$student->firstname}}</td>
                        <td>{{$student->lastname}}</td>
                        <td>
                            <button class="button" type="submit" name="Delete" value={{$student->id}}>Delete</button>
                        </td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </form>

    <div class="card-body">
        <button class="button" data-toggle="modal" data-target="#addProject">Create new project</button>
        <button  class="button" data-toggle="modal" data-target="#addStudentToGroup" >Add student to the group</button>
    </div>

    @foreach($projects as $project)
        <div class="card-body">
            <h2> Project name: {{$project->projectName}}</h2>
            <h2> Number of groups: {{$project->numberOfGroups}}</h2>
            <h2> Students per group: {{$project->studentsPerGroup}}</h2>
        </div>
        @for ($i = 0; $i < $project->numberOfGroups; $i++)
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Group nr {{$i+1}}</th>
                    </thead>
                    <script>
                        var temp = []
                    </script>
                        @for($x = 0 ; $x <$students->count(); $x++)
                            <script>
                               if ({{$students[$x]->projectID}} == {{$project->id}} && {{$students[$x]->projectGroup}} == {{$i}}+1) {
                                   temp.push("{{$students[$x]->firstname}} {{$students[$x]->lastname}}")
                               }
                            </script>
                        @endfor
                    @for ($j = 0; $j < $project->studentsPerGroup; $j++)
                    <tbody >
                    <tr>
                        <td>
                           <script>
                               if (temp[{{$j}}] != undefined  ) {
                                   document.write(temp[{{$j}}]);
                               }
                           </script>
                        </td>
                    </tr>
                    </tbody>
                    @endfor
                </table>
            </div>
        @endfor
    @endforeach

    <div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form method="post" action="{{ route('save') }}" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="First_name">First name:</label>
                            <br>
                            <input type="text" name="First_name" size="50">
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="Last_name">Last name:</label>
                            <br>
                            <input type="text" name="Last_name" size="50">
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button class="button" data-dismiss="modal">Close</button>
                            <button id="Add" class="button" type="submit" name="Add">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form method="post" action="{{ route('saveProject') }}" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Project_name">Project name:</label>
                            <br>
                            <input type="text" name="Project_name" size="50">
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="Amount_of_groups">Amount of groups:</label>
                            <br>
                            <input type="text" name="Amount_of_groups" size="50">
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="Students_per_group">Students per group:</label>
                            <br>
                            <input type="text" name="Students_per_group" size="50">
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button class="button" data-dismiss="modal">Close</button>
                            <button id="Add" class="button" type="submit" name="Add">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addStudentToGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add student</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form method="post" action="{{ route('addStudent') }}" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="First_name">First name:</label>
                            <br>
                            <input type="text" name="First_name" size="50">
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="Last_name">Last name:</label>
                            <br>
                            <input type="text" name="Last_name" size="50">
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="Project_name">Project name:</label>
                            <br>
                            <input type="text" id="Project_name" name="Project_name" size="50">
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="Group_number">Group number:</label>
                            <br>
                            <input type="text" id="Group_number" name="Group_number" size="50">
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button class="button" data-dismiss="modal">Close</button>
                            <button id="AddToGroup" class="button" type="submit" name="AddToGroup">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
</html>
