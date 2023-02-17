<?php

namespace App\Http\Controllers;

use App\Models\Robot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RobotController extends Controller
{
    // set index page view
    public function index() {
        return view('index');
    }

    // handle fetch all eamployees ajax request
    public function read() {
        $read_robots = Robot::all();
        $output = '';
        if ($read_robots->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Creator</th>
                <th>Country</th>
                <th>Year</th>
                <th>Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($read_robots as $read_robot) {
                $output .= '<tr>
                <td>' . $read_robot->id . '</td>
                <td><img src="storage/images/' . $read_robot->robot_image . '" width="50" class="img-thumbnail "></td> 
                <td>' . $read_robot->robot_name . '</td>
                <td>' . $read_robot->robot_desc . '</td>
                <td>' . $read_robot->robot_creator . '</td>
                <td>' . $read_robot->robot_country . '</td>
                <td>' . $read_robot->robot_year . '</td>
                <td>' . $read_robot->robot_type . '</td>
                <td>
                  <a href="#" id="' . $read_robot->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editRobotModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $read_robot->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new robot ajax request
    public function create(Request $request) {
        $file = $request->file('robot_image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $robotData = ['robot_name' => $request->robot_name, 'robot_desc' => $request->robot_desc, 'robot_creator' => $request->robot_creator, 'robot_country' => $request->robot_country, 'robot_year' => $request->robot_year, 'robot_type' => $request->robot_type, 'robot_image' => $fileName];
        Robot::create($robotData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an robot ajax request
    public function edit(Request $request) {
        $id = $request->id;
        $edit_robot = Robot::find($id);
        return response()->json($edit_robot);
    }

    // handle update an robot ajax request
    public function update(Request $request) {
        $fileName = '';
        $update_robot = Robot::find($request->update_robot_id);
        if ($request->hasFile('robot_image')) {
            $file = $request->file('robot_image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($update_robot->robot_image) {
                Storage::delete('public/images/' . $update_robot->robot_image);
            }
        } else {
            $fileName = $request->update_robot_image;
        }

        $robotData = ['robot_name' => $request->robot_name, 'robot_desc' => $request->robot_desc, 'robot_creator' => $request->robot_creator, 'robot_country' => $request->robot_country, 'robot_year' => $request->robot_year, 'robot_type' => $request->robot_type, 'robot_image' => $fileName];

        $update_robot->update($robotData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an robot ajax request
    public function delete(Request $request) {
        $id = $request->id;
        $delete_robot = Robot::find($id);
        if (Storage::delete('public/images/' . $delete_robot->robot_image)) {
            Robot::destroy($id);
        }
    }

}
