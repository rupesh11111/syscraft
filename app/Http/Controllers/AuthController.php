<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function dashboard()
    {
        $auth = Auth::user();
        if ($auth->role->name == 'admin') {
            return view('adminDashboard');
        }
        if (in_array($auth->role->name, ['customer', 'vendor'])) {
            $data['products'] = Product::paginate(20);
            return view('customerDashboard', $data);
        }
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:8',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['success' => true, 'message' => "Successfully Logged In"]);
        } else {
            return response()->json(['success' => false, 'message' => "Invalid Credentials"]);
        }
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'role' => 'nullable|in:customer,vendor|exists:roles,name',
                'name' => 'nullable|string',
                'address' => 'nullable|string',
                'contact' => 'nullable|string|min:10|max:13',
                'email' => 'nullable|email|unique:users,email',
                'username' => 'nullable|unique:users,username',
                'password' => 'nullable|min:8',
                // 'profile_picture' => 'nullable|mimes:png,jpg,img,jpeg,webp',
                'dob' => 'nullable|date_format:Y-m-d',
            ]);

            DB::beginTransaction();

            request()->merge(['role_id' => Role::whereName(request('role'))->value('id')]);

            $user = User::create(request()->only('name', 'address', 'role_id', 'contact', 'email', 'username', 'password', 'dob'));

            if (request()->hasFile('profile_picture')) {
                $file = request('profile_picture');
                $extension = null;
                if (is_file($file)) {
                    $extension = $file->getClientOriginalExtension();
                } else if (filter_var($file, FILTER_VALIDATE_URL)) {
                    $file_info = pathinfo($file);
                    $extension = $file_info['extension'];
                } else {
                    return false;
                }
                $fileName = random() . '.' . $extension;
                Storage::disk('local')->put('public/user_profile/' . $fileName, file_get_contents(request()->file('profile_picture')));
                $user->profile_picture = $fileName;
            }
            $user->save();

            DB::commit();

            Mail::to($user->email)->send(new WelcomeEmail($user));

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function profile()
    {
        $data['user'] = Auth::user();
        return view('profile', $data);
    }

    public function editProfile()
    {
        $data['user'] = Auth::user();
        return view('editProfile', $data);
    }

    public function updateProfile(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'contact' => 'required|string',
                'email' => "required|email|unique:users,email,$id",
                'username' => "required|string|unique:users,username,$id",
                'profile_picture' => 'nullable',
                'profile_picture_old' => 'nullable|string',
                'dob' => 'required|string',
            ]);

            $user = User::find(Auth::id());

            $user->update(request()->only('name', 'address', 'contact', 'email', 'username', 'dob'));

            if (empty(request('profile_picture_old'))) {
                $user->profile_picture = null;
            } else if (request()->hasFile('profile_picture')) {
                $file = request('profile_picture');
                $extension = null;
                if (is_file($file)) {
                    $extension = $file->getClientOriginalExtension();
                } else if (filter_var($file, FILTER_VALIDATE_URL)) {
                    $file_info = pathinfo($file);
                    $extension = $file_info['extension'];
                } else {
                    return false;
                }
                $fileName = random() . '.' . $extension;
                Storage::disk('local')->put('public/user_profile/' . $fileName, file_get_contents(request()->file('profile_picture')));
                $user->profile_picture = $fileName;
            } else {
                //
            }
            $user->save();
            DB::commit();
            $data['user'] = $user->fresh();
            return response()->json(['status' => true, 'message' => "Profile Updated Successfully", 'data' => $data]);
        } catch (Exception $e) {
            DB::commit();
            return response()->json(['status' => true, 'message' => $e->getMessage()], 400);
        }
    }
}
