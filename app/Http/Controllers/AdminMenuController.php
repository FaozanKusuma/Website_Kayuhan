<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminMenuController extends Controller
{
    // READ: Menampilkan daftar menu ke halaman Admin
    public function index()
    {
        // Mengambil semua menu beserta nama kategorinya
        $menus = Menu::with('category')->get();
        return view('admin.menus.index', compact('menus'));
    }

    // CREATE: Menampilkan form tambah menu (Data kategori dikirim agar bisa dipilih di dropdown)
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    // STORE: Memproses data dari form dan menyimpannya ke Database
    public function store(Request $request)
    {
        // 1. Validasi Input dari FE (NFR01)
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Maks 2MB
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available'); // Checkbox FE

        // 2. Logika Upload Foto
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Simpan foto ke folder public/images
            $file->move(public_path('images'), $filename);
            $data['photo'] = $filename;
        }

        // 3. Simpan ke Database MySQL
        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }
    
    // ... (Anda bisa mengosongkan fungsi show, edit, update, destroy untuk saat ini, kita fokus ke Create dulu)
}