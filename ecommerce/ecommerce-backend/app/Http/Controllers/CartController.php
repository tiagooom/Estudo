<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->with('product')->get();
        return response()->json($cart);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json($cartItem);
    }

    public function decreaseQuantity(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:carts,product_id']);

        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        
        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }
        }

        return response()->json(['message' => 'Quantidade reduzida ou item removido']);
    }

    public function destroy($productId)
    {
        Cart::where('user_id', Auth::id())->where('product_id', $productId)->delete();
        return response()->json(['message' => 'Item removido do carrinho']);
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return response()->json(['message' => 'Carrinho esvaziado']);
    }

    public function sync(Request $request) //limpa carrinho e adiciona itens do estado local
    {
        $cartItems = $request->input('cart'); 
        $userId = Auth::id();

        Cart::where('user_id', $userId)->delete();

        foreach ($cartItems as $item) {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity']
            ]);
        }

        return response()->json(['message' => 'Carrinho sincronizado com sucesso']);
    }

}
