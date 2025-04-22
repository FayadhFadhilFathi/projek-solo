<form action="{{ route('order-items.update', $orderItem->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Input fields with default values -->
</form>
