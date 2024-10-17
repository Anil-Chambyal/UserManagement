<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }
    public function adminView(){
        return view('admin.auth.register');
    }

    public function adminRegister(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = $this->create($request->all());
        auth()->login($admin);
        return redirect()->route('index'); 
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role'=>'admin',
        ]);
    }


    public function adminlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
            $errors = [];
        
        if (!Admin::where('email', $request->email)->exists()) {
            $errors['email'] = 'No account found with this email.';
        } else {
            $errors['password'] = 'The provided password is incorrect.';
        }
    
        return back()->withErrors($errors)->withInput();
    }

    public function adminDashboard()
    {
        $users = User::all(); 

        return view('admin.auth.dashboard', compact('users'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('message', 'Successfully logged out.');
    }
    
}
?>