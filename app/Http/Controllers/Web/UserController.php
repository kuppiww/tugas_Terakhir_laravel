<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\Transaction;


class UserController extends Controller
{

    public function index(Request $request)
    {
        return view('index');
    }

    public function callSession(Request $request)
    {
        return redirect()->back()->with('status', 'Berhasil memanggil sesi');
    }



    public function getAdmin(User $user)
    {
        $products = Product::where('user_id', $user->id)->get();
        return view('admin_page', ['products' => $products, 'user' => $user]);
        if (!$user) {
            return redirect()->route('home')->with('error', 'User not found');
        }

        $products = Product::where('user_id', $user->id)->get();
        return view('admin_page', ['products' => $products, 'user' => $user]);
    }

    public function editProduct(Request $request, User $user, Product $product)
    {
        return view('edit_product', ['product' => $product, 'user' => $user]);
    }

    public function updateProduct(Request $request, User $user, Product $product)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama' => 'required',
            'berat' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'kondisi' => 'required',
            'deskripsi' => 'required',
        ]);


        if ($request->hasFile('image')) {

            Storage::delete($product->image);


            $imagePath = $request->file('image')->store('public/uploads');


            $product->image = $imagePath;
        }

        $product->name = $request->nama;
        $product->stock = $request->stok;
        $product->weight = $request->berat;
        $product->price = $request->harga;
        $product->description = $request->deskripsi;
        $product->condition = $request->kondisi;
        $product->save();

        return redirect()->route('admin_page', ['user' => $user->id])->with('message', 'Berhasil update data');
        if (!$user) {
            return redirect()->route('home')->with('error', 'User not found');
        }
    }

    public function deleteProduct(Request $request, User $user, Product $product)
    {
        if ($product->user_id === $user->id) {
            $product->delete();
        }
        return redirect()->back()->with('status', 'Berhasil menghapus data');

        if (!$user) {
            return redirect()->route('home')->with('error', 'User not found');
        }

        if ($product->user_id === $user->id) {
            $product->delete();
            return redirect()->back()->with('status', 'Product successfully deleted');
        }

        return redirect()->back()->with('error', 'You do not have permission to delete this product');
    }





    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }


    public function showTransactionDetail($transactionId)
    {
        $transaction = Transaction::find($transactionId);

        if (!$transaction) {
            return redirect()->route('transaction', ['id' => $transaction->id]);
        }

        $merchant = $transaction->merchant; // Misalnya, ini relasi ke merchant

        if (!$merchant) {
            return redirect()->route('transaction', ['id' => $transaction->id]);
        }

        return redirect()->route('transaction', ['id' => $transaction->id]);
    }








    public function getFormRequest()
    {
        return view('form_request');
    }

    public function sendRequest(Request $request)
    {
        dd($request->gender);
    }


    public function handleRequest(Request $request, User $user)
    {
        return view('handle_request', ['user' => $user]);
    }

    public function postRequest(Request $request, User $user)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imageName = basename($imagePath);

            Product::create([
                'user_id' => $user->id,
                'image' => $imageName,
                'name' => $request->nama,
                'weight' => $request->berat,
                'price' => $request->harga,
                'condition' => $request->kondisi,
                'stock' => $request->stok,
                'description' => $request->deskripsi,
            ]);


            return redirect()->route('admin_page', ['user' => $user->id])->with('message', 'Berhasil menambahkan produk');
        }

        return redirect()->back()->with('error', 'Error. Gambar wajib diunggah.');
    }

    public function getProduct()
    {
        // $data = Product::all();
        $user = User::find(1);
        $data = $user->products;
        // return view('list_product')->with('products', $data);
        return view('products')->with('products', $data);
    }


    public function getProfile(Request $request, User $user)
    {
        $user = Auth::user();
        $user = User::with('summarize')->find($user->id);
        // dd($user);
        return view('profile', ['user' => $user]);
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function home()
    {
        return view('home');
    }

    public function register()
    {
        return view('register');
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'gender' => 'required|in:male,female',
            'age' => 'required|integer|min:1',
            'birth' => 'required|date',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'age' => $request->age,
            'birth' => $request->birth,
            'address' => $request->address,
        ]);

        // assign role
        $user->assignRole('superadmin');

        if ($user) {
            return redirect()->route('register')
                ->with('success', 'User created successfully');
        } else {
            return redirect()->route('register')
                ->with('error', 'Failed to create user');
        }
    }

    public function showProfile(Request $request)
    {
        $varInsert = "Halo ini adalah variable yang disisipkan";
        $varOther = "Variable ini merupakan variable lain yang disisipkan";
        return view('show', compact('varInsert', 'varOther'));
    }



    public function login()
    {
        return view('login');
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')
                ->with('error', 'Login failed email or password is incorrect');
        }
    }

    public function dashboard()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to view the dashboard');
        }

        return view('dashboard', compact('user'));

        // get user role
        // dd($user->roles[0]->name);

        // change role
        // $user->roles()->detach();
        // $user->assignRole('superadmin');

        // if (!$user) {
        //     return redirect()->route('login');
        // }

        return view('dashboard', compact('user'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function loginGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = new User();
            $newUser->google_id = $user->id;
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->password = Hash::make(Str::random(15));
            $newUser->gender = 'male';
            $newUser->age = 25;
            $newUser->birth = '1996-05-13';
            $newUser->address = 'Jakarta Selatan';
            $newUser->save();

            // assign role
            $newUser->assignRole('user');

            Auth::login($newUser);
        }

        return redirect()->route('dashboard');
    }
}
