@foreach($orders as $order)
<tr>
    <td>{{ $order->client->fullName() }}</td>
    <td>{{ $order->order_name }}</td>
    <td>{{ $order->order_type->toTranslate() }}</td>
    <td>{{ $order->quantity }}</td>
    <td>{{ $order->deadline }}</td>
</tr>
@endforeach

<script>

</script>
