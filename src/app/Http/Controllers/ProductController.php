<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // 商品名検索（部分一致）
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 並び替え処理
        if ($request->sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        // ページネーション（1ページ6件）
        $products = $query->paginate(6)->appends($request->query());

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'between:0,10000'],
            'season' => ['required'],
            'description' => ['required', 'string', 'max:120'],
            'image' => ['required', 'image', 'mimes:png,jpeg', 'max:2048'],
            'season' => ['required', 'array'],
            'season.*' => ['exists:seasons,id'],
        ], [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.between' => '0〜10000円以内で入力してください',
            'season.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.image' => '画像ファイルを選択してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
        ]);

        // 画像の保存
        $imagePath = $request->file('image')->store('images', 'public');

        // データベースへ保存
        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => $imagePath,
            'description' => $validated['description'] ?? '',
        ]);

        // 中間テーブルへ保存
        $product->seasons()->sync($validated['season']);

        return redirect()->route('products.index')->with('success', '商品を登録しました！');

        // 商品一覧にリダイレクト
        return redirect()->route('products.index')->with('success', '商品を登録しました！');
    }

    public function show(Product $product)
    {
        $seasons = Season::all();
        $product->load('seasons');

        return view('products.show', compact('product', 'seasons'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|between:0,10000',
            'description' => 'nullable|string|max:120',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'season' => 'required|array',
            'season.*' => 'exists:seasons,id',
        ]);

        // 画像がある場合、保存・置き換え
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        // 更新
        $product->fill($validated)->save();

        // 季節更新
        $product->seasons()->sync($validated['season']);

        return redirect()->route('products.show', $product)->with('success', '商品を更新しました！');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました！');
    }
}
