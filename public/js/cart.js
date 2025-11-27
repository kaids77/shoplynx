document.addEventListener('DOMContentLoaded', function() {
    // Update cart when quantity changes
    const quantityInputs = document.querySelectorAll('.update-cart');
    
    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            const row = this.closest('tr');
            const id = row.getAttribute('data-id');
            const quantity = parseInt(this.value);
            
            if (quantity < 1) {
                this.value = 1;
                return;
            }
            
            // Update the cart via AJAX
            fetch('/update-cart', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id: id,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                // Update the subtotal for this row
                const price = parseFloat(row.querySelector('[data-th="Price"]').textContent.replace('₱', '').replace(',', ''));
                const subtotal = price * quantity;
                row.querySelector('[data-th="Subtotal"]').textContent = '₱' + subtotal.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                
                // Update the total
                updateTotal();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
    
    function updateTotal() {
        let total = 0;
        document.querySelectorAll('[data-th="Subtotal"]').forEach(subtotalCell => {
            const subtotal = parseFloat(subtotalCell.textContent.replace('₱', '').replace(',', ''));
            total += subtotal;
        });
        
        const totalElement = document.querySelector('tfoot h3 strong');
        if (totalElement) {
            totalElement.textContent = 'Total: ₱' + total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }
    }
});
