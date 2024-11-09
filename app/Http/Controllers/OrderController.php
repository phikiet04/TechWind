<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function showOrderDetails($id)
    {
        try {
            // Lấy đơn hàng với các item liên quan (bao gồm variant)
            $order = Order::with('orderItems.variant', 'orderItems.product')  // Kiểm tra quan hệ đã được load đầy đủ chưa
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'order' => [
                    'code' => $order->code,
                    'name' => $order->name,
                    'email' => $order->email,
                    'phone' => $order->phone,
                    'address' => $order->address,
                    'status' => $order->status,
                    'created_at' => $order->created_at,
                    'total' => number_format($order->total, 2),
                    'taxes' => number_format($order->taxes, 2),  // Thuế
                    'items' => $order->orderItems->map(function ($item) {
                        return [
                            'product_name' => $item->product->name,
                            'color' => $item->variant ? $item->variant->color : 'N/A',
                            'size' => $item->variant ? $item->variant->size : 'N/A',
                            'quantity' => $item->quantity,
                            'price' => number_format($item->price, 2),
                            'total_price' => number_format($item->total_price, 2),
                        ];
                    }),
                ]
            ]);
        } catch (\Exception $e) {
            Log::error("Error fetching order details for order ID: " . $id, ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Unable to fetch order details']);
        }
    }


    public function destroy(Order $order)
    {
        // Get the user associated with this order
        $user = $order->user;

        // Delete the order
        $order->delete();

        // Redirect back to the user's profile with a success message
        return redirect()->route('users.show', ['id' => $user->id])
            ->with('success', 'Order has been deleted successfully.');
    }

}
