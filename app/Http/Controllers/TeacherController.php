<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Auth;
use Str;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "List Guru";
        return view('admin.teacher.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Guru";
        return view('admin.teacher.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'no_telepon' => 'max:15|min:8',
            'status_pernikahan' => 'max:50',
        ]);

        $teacher = new User;
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->jenis_kelamin = trim($request->jenis_kelamin);

        if(!empty($request->tanggal_lahir))
        {
            $teacher->tanggal_lahir = trim($request->tanggal_lahir);
        }

        if(!empty($request->tanggal_masuk))
        {
            $teacher->tanggal_masuk = trim($request->tanggal_masuk);
        }

        if(!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->status_pernikahan = trim($request->status_pernikahan);
        $teacher->alamat = trim($request->alamat);
        $teacher->no_telepon = trim($request->no_telepon);
        $teacher->alamat_asli = trim($request->alamat_asli);
        $teacher->kualifikasi = trim($request->kualifikasi);
        $teacher->pengalaman_kerja = trim($request->pengalaman_kerja);
        $teacher->note = trim($request->note);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher Successfully Created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Teacher";
            return view('admin.teacher.edit', $data);
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
            'status_pernikahan' => 'max:50',
        ]);

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->jenis_kelamin = trim($request->jenis_kelamin);

        if(!empty($request->tanggal_lahir))
        {
            $teacher->tanggal_lahir = trim($request->tanggal_lahir);
        }

        if(!empty($request->tanggal_masuk))
        {
            $teacher->tanggal_masuk = trim($request->tanggal_masuk);
        }

        if(!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->status_pernikahan = trim($request->status_pernikahan);
        $teacher->alamat = trim($request->alamat);
        $teacher->no_telepon = trim($request->no_telepon);
        $teacher->alamat_asli = trim($request->alamat_asli);
        $teacher->kualifikasi = trim($request->kualifikasi);
        $teacher->pengalaman_kerja = trim($request->pengalaman_kerja);
        $teacher->note = trim($request->note);
        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        if(!empty($request->password))
        {
            $teacher->password = Hash::make($request->password); 
        }
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher Successfully Updated");
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();

            return redirect()->back()->with('success', "Teacher Successfully Deleted");
        }
        else
        {
            abort(404);
        }
    }
}
