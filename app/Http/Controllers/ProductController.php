<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{


public function productView() {
    $products = Product::with(['category', 'subcategory'])->get();
    $categories = Category::all();
    $subcategories = []; // Prevent undefined variable error
    $selectedCategory = null; // Prevent undefined variable error

    return view('categories.product', compact('products','categories', 'subcategories', 'selectedCategory'));
}


function productCreate(Request $request){

    $categories = Category::all();
    
        $selectedCategory = $request->old('category_id', $request->input('category_id'));
        
        $subcategories = [];
        if ($selectedCategory) {
            $subcategories = Subcategory::where('category_id', $selectedCategory)->get();
        }
        $products = Product::all();
        return view('categories.product', compact('products','categories', 'subcategories', 'selectedCategory'));      
}

public function updateCategorySelection(Request $request)
    {
        return redirect()->route('product-view')->withInput([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);
        
        $subcategory = Subcategory::find($validated['subcategory_id']);
        if (!$subcategory || $subcategory->category_id != $validated['category_id']) {
            return redirect()->back()
                ->withErrors(['subcategory_id' => 'Invalid subcategory for selected category'])
                ->withInput();
        }
        
        // Handle image upload
    if ($request->hasFile('image')) {
        $destinationPath = 'images/products/'; // Better folder structure
        $profileImage = date('YmdHis') . "." . $request->image->getClientOriginalExtension();
        $request->image->move($destinationPath, $profileImage);
        $validated['image'] = $destinationPath . $profileImage;
    }
        
        Product::create($validated);
        
        return redirect()->route('product-view')
            ->with('success', 'Product created successfully!');
    }


    function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
       
        return view('categories.product_edit', compact('product', 'categories','subcategories'));
    }

    function updateProduct(Request $request,$id)
    {
     
       $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'status'=> $request->status,
        ]);

        return response()->json(['success' => 'Category updated successfully']);
    }

    public function userproductView(Request $request) {
    $query = Product::with('category');

    // Category filter
    if ($request->filled('category_id') && $request->category_id != 'all') {
        $query->where('category_id', $request->category_id);
    }

    // Sorting
    switch ($request->input('sort', 'default')) {
        case 'price-low':
            $query->orderBy('price', 'asc');
            break;
        case 'price-high':
            $query->orderBy('price', 'desc');
            break;
        case 'rating':
            $query->orderBy('rating', 'desc');
            break;
        default:
            $query->latest();
    }

    $products = $query->paginate(12);
    $categories = Category::all();

    return view('User-dashboard.home', compact('products', 'categories'));

}


/**
 * 
 * Cart Controller
 * 
 */


public function userproductCart()
    {
         return view('User-dashboard.products.cart');
         
    }
    
public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

       $userId = Auth::id();  // Current logged-in user ID
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        // Check if item already exists in cart
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Update quantity if exists
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create new cart item
            Cart::create([
                'user_id'    => $userId,
                'product_id' => $productId,
                'quantity'   => $quantity,
            ]);
        }

        return redirect()->route('user-product-view')
                ->with('success', 'Product added to cart successfully!');

    }

 // View Cart Items
    public function showCart()
    {

        $cartItems = Cart::with('product.category')
                    ->where('user_id', auth()->id())
                    ->get();

        return view('User-dashboard.products.cart', compact('cartItems')); // <-- This will send $cartItems to Blade
    }

// Update Quantity (increase/decrease)
    public function update(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:increase,decrease'
        ]);

        $cartItem = Cart::where('user_id', auth()->id())->findOrFail($id);

        if ($request->action === 'increase') {
            $cartItem->quantity += 1;
        } elseif ($request->action === 'decrease') {
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
        
        } else {
            // Remove item if quantity would become 0
            $cartItem->delete();
            return redirect()->route('show-cart')
                ->with('success', 'Product removed from cart successfully!');
        }
    }

        $cartItem->save();
        return redirect()->route('show-cart')
                ->with('success', 'Increaced or Decreased successfully!');
    }

    // Remove from Cart
    public function destroy($id)
    {
        $cartItem = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cartItem->delete();

        
        return redirect()->route('show-cart')
                ->with('success', 'Increaced successfully!');
    }


    // public function processCheckout(Request $request)
    //     {

    //         // Validate the form data
    //         $validatedData = $request->validate([
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'address' => 'required',
    //         'address_2' => 'nullable',
    //         'country' => 'required',
    //         'state' => 'required',
    //         'city' => 'required',
    //         'zip_code' => 'required',
    //         'phone' => 'required',
    //     ]);


    //     // Add user_id to the data array
    //     $validatedData['user_id'] = Auth::id();

    //     // Create a new checkout record
    //     Checkout::create($validatedData);

    //     return back()->with('success', 'Address saved!');

    // }


    public function processCheckout(Request $request)
{
    // return"rfkhgfjuyhg";
    // Validate the form data
    $validatedData = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'address' => 'required',
        'address_2' => 'nullable',
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
        'zip_code' => 'required',
        'phone' => 'required',
    ]);

    // Get current user's cart items
    $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
    
    if($cartItems->isEmpty()) {
        return back()->with('error', 'Your cart is empty!');
    }

    // Create order
    $order = Order::create([
        'user_id' => Auth::id(),
        'order_number' => 'ORD-' . strtoupper(uniqid()),
        'status' => 'pending',
        'grand_total' => $cartItems->sum(function($item) {
            return $item->quantity * $item->product->price;
        }),
        'item_count' => $cartItems->count(),
        'first_name' => $validatedData['first_name'],
        'last_name' => $validatedData['last_name'],
        'address' => $validatedData['address'],
        'address_2' => $validatedData['address_2'] ?? null,
        'country' => $validatedData['country'],
        'state' => $validatedData['state'],
        'city' => $validatedData['city'],
        'zip_code' => $validatedData['zip_code'],
        'phone' => $validatedData['phone'],
    ]);

    // Clear the cart
    Cart::where('user_id', Auth::id())->delete();

    // Save address if checkbox is checked
    if($request->has('save_address')) {
        $user = Auth::user();
        $user->update($validatedData);
    }

    return redirect()->route('user-checkout', ['order_id' => $order->id]);
}

public function success($order_id)
{
    $order = Order::findOrFail($order_id);
    return view('User-dashboard.products.cart', compact('order'));
}
        
    }