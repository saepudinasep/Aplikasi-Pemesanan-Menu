@foreach ($data as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->menu }}</td>
        <td>{{ $item->qty }}</td>
        <td>{{ $item->price }}</td>
        <td>{{ $item->total }}</td>
        <td>{{ $item->status }}</td>
    </tr>
@endforeach
<script>
    var table = document.getElementById("table_order");
    var rows = table.getElementsByTagName("tr");
    var total = 0;

    for (var i = 0; i < rows.length; i++) {
        var harga = parseInt(rows[i].cells[4].innerHTML);
        if (!isNaN(harga)) {
            total += harga;
        }
    }

    document.getElementById("total").innerHTML = total;
</script>
