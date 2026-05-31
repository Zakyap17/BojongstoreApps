<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman utama (tabel produk).
     */
    public function index()
    {
        $products = Product::with('category', 'umkm')->latest()->paginate(10);
        $total_products = Product::count();
        $total_featured = Product::where('is_featured', true)->count();
        $total_categories = \App\Models\Category::count();
        return view('admin.products.index', compact('products', 'total_products', 'total_featured', 'total_categories'));
    }

    /**
     * Menampilkan form untuk menambah produk baru.
     */
    public function create()
    {
        $categories = Category::all();
        $umkms = Umkm::where('status', 'terverifikasi')->orderBy('name')->get();
        return view('admin.products.create', compact('categories', 'umkms'));
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'shoppee' => 'nullable|url',
            'whatsapp' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'umkm_id' => 'nullable|exists:umkms,id',
            'tags' => 'nullable|string',
            'seller' => 'nullable|string|max:255',
        ]);
        $validatedData['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $path;
        }

        $validatedData['slug'] = Str::slug($request->name);

        Product::create($validatedData);

        // Arahkan kembali ke route user.products.index
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $umkms = Umkm::where('status', 'terverifikasi')->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories', 'umkms'));
    }

    /**
     * Memperbarui data produk di database.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'shoppee' => 'nullable|url',
            'whatsapp' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'umkm_id' => 'nullable|exists:umkms,id',
            'tags' => 'nullable|string',
            'seller' => 'nullable|string|max:255',
        ]);
        $validatedData['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $path;
        }

        $validatedData['slug'] = Str::slug($request->name);
        $product->update($validatedData);

        // Arahkan kembali ke route user.products.index
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
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Toggle status unggulan produk.
     */
    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);
        $status = $product->is_featured ? 'dijadikan unggulan' : 'dihapus dari unggulan';
        return back()->with('success', "Produk berhasil {$status}.");
    }
}