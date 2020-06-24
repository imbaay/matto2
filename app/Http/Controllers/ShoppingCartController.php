<?php

namespace App\Http\Controllers;

use App\Phone;
use Cart;
use Illuminate\Http\Request;
class ShoppingCartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $phone = Phone::findOrFail($request->phone_id);

        if ($phone->quantity >= $request->quantity){

            if ($request->quantity >= 1)
            {
                $cartItem = Cart::add([
                    'id' => $phone->id,
                    'name' => $phone->title,
                    'price' => $phone->price,
                    'qty' => $request->quantity,
                    'weight' => 0,
                    'options' => [
                        'image' => $phone->image
                    ]
                ]);
                return redirect()->back();
            }
            else
                {
                return redirect()->back()
                    ->with('cart_alert', "Quantity must be larger than 0");
                }

        }
        else {
            return redirect()->back()
                ->with('cart_alert', "We don't have that much quantity.");
        }

    }

    public function cart()
    {
        return view('public.cart');
    }

    public function cart_delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }
    public function cart_increment($id, $qty, $phone_id)
    {
        $phone = Phone::findOrFail($phone_id);

        if($phone->quantity > $qty)
        {
            Cart::update($id, $qty+1);
            return redirect()->back();
        }
        else
        {
            return redirect()->back()
                ->with('cart_alert', "No more quantity left in stock for this phone");
        }

    }


    public function cart_decrement($id, $qty)
    {
        Cart::update($id, $qty-1);
        return redirect()->back();
    }
}
