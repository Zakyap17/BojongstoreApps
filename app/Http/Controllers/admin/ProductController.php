<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman utama (tabel produk).
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();
        
        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $products = $query->paginate(10)->withQueryString();
        $total_products = Product::count();
        $total_featured = Product::where('is_featured', true)->count();
        $total_categories = Category::count();
        
        // Calculate Product Growth
        $thisMonthProducts = Product::whereMonth('created_at', \Carbon\Carbon::now()->month)
                                    ->whereYear('created_at', \Carbon\Carbon::now()->year)->count();
        $lastMonthProducts = Product::whereMonth('created_at', \Carbon\Carbon::now()->subMonth()->month)
                                    ->whereYear('created_at', \Carbon\Carbon::now()->subMonth()->year)->count();
        $productGrowth = $lastMonthProducts == 0 ? ($thisMonthProducts > 0 ? 100 : 0) : round((($thisMonthProducts - $lastMonthProducts) / $lastMonthProducts) * 100);
        
        return view('admin.products.index', compact('products', 'total_products', 'total_featured', 'total_categories', 'productGrowth'));
    }

    /**
     * Menampilkan form untuk menambah produk baru.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        if ($request->has('price')) {
            $price = str_replace('.', '', $request->price);
            $request->merge(['price' => $price]);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'shoppee' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
            'seller' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'packaging' => 'nullable|string|max:255',
            'shelf_life' => 'nullable|string|max:255',
            'production' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama produk tidak boleh kosong.',
            'name.unique' => 'Nama produk sudah terdaftar, silakan gunakan nama lain.',
            'description.required' => 'Deskripsi produk tidak boleh kosong.',
            'price.required' => 'Harga produk tidak boleh kosong.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'image.required' => 'Foto produk wajib diunggah.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.max' => 'Ukuran foto produk terlalu besar (Maksimal 2MB).'
        ]);
        
        $validatedData['is_featured'] = $request->boolean('is_featured');

        if ($request->filled('tags')) {
            $validatedData['tags'] = array_map('trim', explode(',', $request->tags));
        } else {
            $validatedData['tags'] = [];
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $path;
        }

        $validatedData['slug'] = Str::slug($request->name);

        Product::create($validatedData);

        Activity::create([
            'user_id' => Auth::id(),
            'action' => 'menambah produk',
            'description' => $validatedData['name']
        ]);

        // Arahkan kembali ke route admin.products.index
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data produk di database.
     */
    public function update(Request $request, Product $product)
    {
        if ($request->has('price')) {
            $price = str_replace('.', '', $request->price);
            $request->merge(['price' => $price]);
        }

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'shoppee' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
            'seller' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'packaging' => 'nullable|string|max:255',
            'shelf_life' => 'nullable|string|max:255',
            'production' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama produk tidak boleh kosong.',
            'name.unique' => 'Nama produk sudah terdaftar, silakan gunakan nama lain.',
            'description.required' => 'Deskripsi produk tidak boleh kosong.',
            'price.required' => 'Harga produk tidak boleh kosong.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.max' => 'Ukuran foto produk terlalu besar (Maksimal 2MB).'
        ]);
        
        $validatedData['is_featured'] = $request->boolean('is_featured');

        if ($request->filled('tags')) {
            $validatedData['tags'] = array_map('trim', explode(',', $request->tags));
        } else {
            $validatedData['tags'] = [];
        }

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $path;
        }

        $validatedData['slug'] = Str::slug($request->name);
        $product->update($validatedData);

        Activity::create([
            'user_id' => Auth::id(),
            'action' => 'mengedit produk',
            'description' => $validatedData['name']
        ]);

        // Arahkan kembali ke route admin.products.index
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk dari database.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $productName = $product->name;
        $product->delete();
        
        Activity::create([
            'user_id' => Auth::id(),
            'action' => 'menghapus produk',
            'description' => $productName
        ]);
        
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Toggle status unggulan produk.
     */
    public function toggleFeatured(Product $product)
    {
        $product->is_featured = !$product->is_featured;
        $product->save();
        
        $status = $product->is_featured ? 'dijadikan unggulan' : 'dihapus dari unggulan';
        return back()->with('success', "Produk berhasil {$status}.");
    }
}