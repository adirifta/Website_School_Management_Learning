<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Str;

class UserController extends Controller
{
    public function MyAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";
        if(Auth::user()->user_type == 1)
        {
            return view('admin.my_account', $data);
        }
        elseif(Auth::user()->user_type == 2)
        {
            return view('teacher.my_account', $data);
        }
        elseif(Auth::user()->user_type == 3) 
        {
            return view('student.my_account', $data);
        }
        elseif(Auth::user()->user_type == 4) 
        {
            return view('orangtua.my_account', $data);
        }
    }

    public function UpdateMyAccountAdmin(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' .$id,
            'no_telepon' => 'max:15|min:8',
            'status_pernikahan' => 'max:50',
        ]);

        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);
        $admin->save();
        
        return redirect()->back()->with('success', "Account Successfully Updated");
    }

    public function UpdateMyAccount(Request $request)
    {
        $id = Auth::user()->id;
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
        $teacher->email = trim($request->email);
        $teacher->save();

        return redirect()->back()->with('success', "Account Successfully Updated");
    }

    public function UpdateMyAccountStudent(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' .$id,
            'berat' => 'max:10',
            'golongan_darah' => 'max:10',
            'no_telepon' => 'max:15|min:8',
            'caste' => 'max:50',
            'agama' => 'max:50',
            'tinggi' => 'max:10',
        ]);


        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->jenis_kelamin = trim($request->jenis_kelamin);

        if(!empty($request->tanggal_lahir))
        {
            $student->tanggal_lahir = trim($request->tanggal_lahir);
        }

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

        $student->caste = trim($request->caste);
        $student->agama = trim($request->agama);
        $student->no_telepon = trim($request->no_telepon);
        $student->golongan_darah = trim($request->golongan_darah);
        $student->tinggi = trim($request->tinggi);
        $student->berat = trim($request->berat);
        $student->email = trim($request->email);
        $student->save();

        return redirect()->back()->with('success', "Account Successfully Updated");
    }

    public function UpdateMyAccountOrangtua(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required|email|unique:users,email,' .$id,
            'no_telepon' => 'max:15|min:8',
            'alamat' => 'max:255',
            'pekerjaan' => 'max:255'
        ]);



        $orangtua = User::getSingle($id);
        $orangtua->name = trim($request->name);
        $orangtua->last_name = trim($request->last_name);
        $orangtua->jenis_kelamin = trim($request->jenis_kelamin);
        $orangtua->pekerjaan = trim($request->pekerjaan);
        $orangtua->alamat = trim($request->alamat);

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($orangtua->getProfile()))
            {
                unlink('upload/profile/'.$orangtua->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $orangtua->profile_pic = $filename;
        }

        $orangtua->no_telepon = trim($request->no_telepon);
        $orangtua->email = trim($request->email);
        $orangtua->save();

        return redirect()->back()->with('success', "Account Successfully Updated");
    }

    public function change_password()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }

    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->old_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', "Password successfully updated");
        }
        else
        {
            return redirect()->back()->with('error', "Old Password is not Currect");
        }
    }
}
