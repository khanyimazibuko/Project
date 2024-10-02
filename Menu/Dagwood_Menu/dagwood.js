    // Initialize an empty array to represent the cart
    let cart = [];

    // Function to extract price and item name from the button text
    function getItemDetails(button) {
        const text = button.textContent;
        const priceMatch = text.match(/R(\d+)/); // Extract price using regex
        const price = priceMatch ? parseFloat(priceMatch[1]) : 0;
        const itemName = text.replace(/<b>R\d+<\/b>/g, '').trim(); // Remove the price from the item name
        return { name: itemName, price: price };
    }

    // Function to add item to the cart
    function addToCart(item) {
        const existingItem = cart.find(cartItem => cartItem.name === item.name);
        if (existingItem) {
            existingItem.quantity += 1; // Increment quantity if item exists
        } else {
            cart.push({ ...item, quantity: 1 }); // Add new item to the cart
        }

        displayCart(); // Update the cart display
    }

    // Function to display the cart
    function displayCart() {
        console.clear(); // For debugging, clear console to show updated cart
        console.table(cart); // Display the cart items in the console (this can be replaced with HTML display logic)
    }

    // Attach click event listeners to all buttons with the "btn" class
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor behavior
            const itemDetails = getItemDetails(button); // Get item details from the clicked button
            addToCart(itemDetails); // Add the item to the cart
        });
    });

