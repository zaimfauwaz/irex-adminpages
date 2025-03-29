    // Add custom attributes
    document.getElementById('add-attribute').addEventListener('click', function() {
    var container = document.getElementById('custom-attributes');
    var newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td><input type="text" name="custom_attributes[key][]" placeholder="Key" class="form-control" required></td>
        <td><input type="text" name="custom_attributes[value][]" placeholder="Value" class="form-control" required></td>
        <td><button type="button" class="btn btn-danger bi-trash remove-attribute">Remove</button></td>
    `;
    container.appendChild(newRow);
});

    // Remove custom attributes
    document.getElementById('custom-attributes').addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-attribute')) {
    // Remove the attribute field
        event.target.closest('tr').remove();
}
});
