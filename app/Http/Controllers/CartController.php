<?php
namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = $this->cartService->addToCart(1, $request->product_id, $request->quantity);

        return response()->json([
            'message' => 'Product added to cart',
        ], 200);
    }
    public function removeItem( $cartId, $productId)
    {
        $response = $this->cartService->removeItem($cartId, $productId);

        if (!$response) {
            return response()->json(['message' => 'Item not found'], 200);
        }

        return response()->json([ 'message' => 'Item removed from cart'], 404);
    }
   
}
