<x-mail::message>
# ការបញ្ជាទិញបានជោគជ័យ!
# Order Placed Successfully!

អរគុណសម្រាប់ការបញ្ជាទិញរបស់លោកអ្នក។
Thank you for your order.

លេខកូដបញ្ជាទិញរបស់អ្នកគឺ៖ **{{ $order->id }}**។
Your order number is: **{{ $order->id }}**.

<x-mail::button :url="$url">
មើលការបញ្ជាទិញ / View Order
</x-mail::button>

សូមអរគុណ,
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>