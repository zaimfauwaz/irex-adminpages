<table id="attribute-table" class="table">
    <tbody id="custom-attributes">
    @if(isset($product) && isset($product->RSkuAttributes))
        @foreach($product->RSkuAttributes as $key => $value)
            @if(is_array($value))
                @foreach($value as $item)
                    <tr>
                        <td><input type="text" name="custom_attributes[key][]" placeholder="Key" class="form-control" value="{{ $key }}" required></td>
                        <td><input type="text" name="custom_attributes[value][]" placeholder="Value" class="form-control" value="{{ $item }}" required></td>
                        <td><button type="button" class="btn btn-danger bi-trash remove-attribute">Remove</button></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td><input type="text" name="custom_attributes[key][]" placeholder="Key" class="form-control" value="{{ $key }}" required></td>
                    <td><input type="text" name="custom_attributes[value][]" placeholder="Value" class="form-control" value="{{ $value }}" required></td>
                    <td><button type="button" class="btn btn-danger bi-trash remove-attribute">Remove</button></td>
                </tr>
            @endif
        @endforeach
    @else
        <tr>
            <td><input type="text" name="custom_attributes[key][]" placeholder="Key" class="form-control" required></td>
            <td><input type="text" name="custom_attributes[value][]" placeholder="Value" class="form-control" required></td>
            <td><button type="button" class="btn btn-danger bi-trash remove-attribute">Remove</button></td>
        </tr>
    @endif
    </tbody>
</table>
<button type="button" id="add-attribute" class="btn btn-success bi bi-plus">Add Another Attribute</button>

<script src="{{asset('dist/assets/js/keyvalue.js')}}"></script>
