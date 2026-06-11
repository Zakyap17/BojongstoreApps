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

        // Single query untuk semua stats produk
        $stats = \DB::selectOne("
            SELECT
                COUNT(*) AS total,
                SUM(CASE WHEN is_featured = true THEN 1 ELSE 0 END) AS featured,
                SUM(CASE WHEN DATE_TRUNC('month', created_at) = DATE_TRUNC('month', NOW()) THEN 1 ELSE 0 END) AS this_month,
                SUM(CASE WHEN DATE_TRUNC('month', created_at) = DATE_TRUNC('month', NOW() - INTERVAL '1 month') THEN 1 ELSE 0 END) AS last_month
            FROM products
        ");

        $total_products   = (int) $stats->total;
        $total_featured   = (int) $stats->featured;
        $total_categories = Category::count();
        $thisMonthProducts = (int) $stats->this_month;
        $lastMonthProducts = (int) $stats->last_month;
        $productGrowth = $lastMonthProducts === 0
            ? ($thisMonthProducts > 0 ? 100 : 0)
            : round((($thisMonthProducts - $lastMonthProducts) / $lastMonthProducts) * 100);

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
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
            'image.max' => 'Ukuran foto produk terlalu besar (Maksimal 5MB).'
        ]);
        
        $validatedData['is_featured'] = $request->boolean('is_featured');

        if ($request->filled('tags')) {
            $validatedData['tags'] = array_map('trim', explode(',', $request->tags));
        } else {
            $validatedData['tags'] = [];
        }

        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->processAndStoreImage($request->file('image'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
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
            'image.max' => 'Ukuran foto produk terlalu besar (Maksimal 5MB).'
        ]);
        
        $validatedData['is_featured'] = $request->boolean('is_featured');

        if ($request->filled('tags')) {
            $validatedData['tags'] = array_map('trim', explode(',', $request->tags));
        } else {
            $validatedData['tags'] = [];
        }

        if ($request->hasFile('image')) {
            if ($product->image && !\Illuminate\Support\Str::startsWith($product->image, '/images/')) {
                Storage::disk('s3')->delete($product->image);
            }
            $validatedData['image'] = $this->processAndStoreImage($request->file('image'));
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
        if ($product->image && !\Illuminate\Support\Str::startsWith($product->image, '/images/')) {
            Storage::disk('s3')->delete($product->image);
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
        $product->update(['is_featured' => !$product->is_featured]);
        $status = $product->is_featured ? 'dijadikan unggulan' : 'dihapus dari unggulan';
        return back()->with('success', "Produk berhasil {$status}.");
    }

    /**
     * Kompres gambar dengan GD (resize + JPEG 82%) lalu upload ke S3.
     * Jika GD tidak tersedia, upload file asli.
     */
    private function processAndStoreImage($file): string
    {
        if (!extension_loaded('gd')) {
            return $file->store('products', 's3');
        }

        try {
            $mime = $file->getMimeType();
            $path = $file->getRealPath();

            $src = match(true) {
                str_contains($mime, 'jpeg'), str_contains($mime, 'jpg') => imagecreatefromjpeg($path),
                str_contains($mime, 'png')  => imagecreatefrompng($path),
                str_contains($mime, 'webp') => function_exists('imagecreatefromwebp') ? imagecreatefromwebp($path) : null,
                str_contains($mime, 'gif')  => imagecreatefromgif($path),
                default => null,
            };

            if (!$src) {
                return $file->store('products', 's3');
            }

            // Flatten PNG transparency ke background putih
            if (str_contains($mime, 'png')) {
                $w = imagesx($src);
                $h = imagesy($src);
                $bg = imagecreatetruecolor($w, $h);
                imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                imagecopy($bg, $src, 0, 0, 0, 0, $w, $h);
                imagedestroy($src);
                $src = $bg;
            }

            // Resize jika lebih dari 1200px
            $origW = imagesx($src);
            $origH = imagesy($src);
            $maxPx = 1200;

            if ($origW > $maxPx || $origH > $maxPx) {
                $ratio = min($maxPx / $origW, $maxPx / $origH);
                $newW  = (int) round($origW * $ratio);
                $newH  = (int) round($origH * $ratio);
                $dst   = imagecreatetruecolor($newW, $newH);
                imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
                imagedestroy($src);
                $src = $dst;
            }

            // Encode ke JPEG buffer
            ob_start();
            imagejpeg($src, null, 82);
            $jpeg = ob_get_clean();
            imagedestroy($src);

            $filename = 'products/' . Str::random(40) . '.jpg';
            Storage::disk('s3')->put($filename, $jpeg);

            return $filename;
        } catch (\Throwable $e) {
            // Fallback ke upload original jika ada error GD
            return $file->store('products', 's3');
        }
    }
}