<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Auth;
use Str;

use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getOrangtua();
        $data['header_title'] = "List Orang Tua";
        return view('admin.orangtua.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Orang Tua";
        return view('admin.orangtua.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'no_telepon' => 'max:15|min:8',
            'alamat' => 'max:255',
            'pekerjaan' => 'max:255'
        ]);



        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->jenis_kelamin = trim($request->jenis_kelamin);
        $student->pekerjaan = trim($request->pekerjaan);
        $student->alamat = trim($request->alamat);

        if(!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }

        $student->no_telepon = trim($request->no_telepon);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 4;
        $student->save();

        return redirect('admin/orangtua/list')->with('success', "Orang Tua Successfully Created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Orang Tua";
            return view('admin.orangtua.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' .$id,
            'no_telepon' => 'max:15|min:8',
            'alamat' => 'max:255',
            'pekerjaan' => 'max:255'
        ]);



        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->jenis_kelamin = trim($request->jenis_kelamin);
        $student->pekerjaan = trim($request->pekerjaan);
        $student->alamat = trim($request->alamat);

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }

        $student->no_telepon = trim($request->no_telepon);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if(!empty($request->password))
        {
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect('admin/orangtua/list')->with('success', "Orang Tua Successfully Updated");
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();

            return redirect()->back()->with('success', "Orang Tua Successfully Deleted");
        }
        else
        {
            abort(404);
        }
    }

    public function myStudent($id)
    {
        $data['getOrangtua'] = User::getSingle($id);
        $data['orangtua_id'] = $id;
        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = User::getMyStudent($id);
        $data['header_title'] = "List Orang Tua Siswa";
        return view('admin.orangtua.my_student', $data);
    }

    public function AssignStudentOrangtua($student_id, $orangtua_id)
    {
        $student = User::getSingle($student_id);
        $student->orangtua_id = $orangtua_id;
        $student->save();

        return redirect()->back()->with('success', "Student Successfully Assign" );
    }

    public function AssignStudentOrangtuaDelete($student_id)
    {
        $student = User::getSingle($student_id);
        $student->orangtua_id = null;
        $student->save();

        return redirect()->back()->with('success', "Student Successfully Assign Deleted" );
    }

    //parent Side
    public function myStudentOrangTua()
    {
        $id = Auth::user()->id;
        $data['getRecord'] = User::getMyStudent($id);
        $data['header_title'] = "List Orang Tua Siswa";
        return view('orangtua.my_student', $data);
    }
   
}
