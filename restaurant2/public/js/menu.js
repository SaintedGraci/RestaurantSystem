// ====== menu.js ======

// Cart object to store items
let cart = {};

// DOM elements
const cartToggle = document.getElementById("cart-toggle");
const cartDisplay = document.getElementById("cart-display");
const closeCart = document.getElementById("close-cart");
const cartItemsContainer = document.getElementById("cart-items");
const cartTotal = document.getElementById("cart-total");
const cartCount = document.getElementById("cart-count");

const checkoutBtn = document.getElementById("checkout-btn");
const checkoutModal = document.getElementById("checkout-modal");
const closeModal = document.getElementById("close-modal");
const checkoutForm = document.getElementById("checkout-form");

// ====== CART FUNCTIONS ======
function updateCartDisplay() {
    cartItemsContainer.innerHTML = "";
    let total = 0;
    let itemCount = 0;

    for (const id in cart) {
        const item = cart[id];
        total += item.price * item.quantity;
        itemCount += item.quantity;

        const cartItem = document.createElement("div");
        cartItem.className = "flex justify-between items-center mb-2";
        cartItem.innerHTML = `
            <span>${item.name} x ${item.quantity}</span>
            <span>₱${(item.price * item.quantity).toFixed(2)}</span>
        `;
        cartItemsContainer.appendChild(cartItem);
    }

    cartTotal.textContent = `₱${total.toFixed(2)}`;

    if (itemCount > 0) {
        cartCount.textContent = itemCount;
        cartCount.classList.remove("hidden");
    } else {
        cartCount.classList.add("hidden");
    }
}

// Add item to cart
document.querySelectorAll(".add-to-cart-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
        const id = btn.dataset.itemId;
        const name = btn.dataset.itemName;
        const price = parseFloat(btn.dataset.itemPrice);
        const quantityElem = document.querySelector(
            `.quantity-display[data-item-id="${id}"]`,
        );
        const quantity = parseInt(quantityElem.textContent);

        if (cart[id]) {
            cart[id].quantity += quantity;
        } else {
            cart[id] = { name, price, quantity };
        }

        updateCartDisplay();
        alert(`${name} added to cart!`);
    });
});

// Quantity buttons
document.querySelectorAll(".quantity-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
        const id = btn.dataset.itemId;
        const action = btn.dataset.action;
        const quantityElem = document.querySelector(
            `.quantity-display[data-item-id="${id}"]`,
        );
        let quantity = parseInt(quantityElem.textContent);

        if (action === "increase") quantity++;
        if (action === "decrease" && quantity > 1) quantity--;

        quantityElem.textContent = quantity;
    });
});

// ====== CART TOGGLE ======
cartToggle.addEventListener("click", () => {
    cartDisplay.classList.toggle("hidden");
});

closeCart.addEventListener("click", () => {
    cartDisplay.classList.add("hidden");
});

// ====== CHECKOUT MODAL ======
checkoutBtn.addEventListener("click", () => {
    if (Object.keys(cart).length === 0) {
        alert("Your cart is empty!");
        return;
    }
    checkoutModal.classList.remove("hidden");
});

closeModal.addEventListener("click", () => {
    checkoutModal.classList.add("hidden");
});

// ====== SUBMIT ORDER ======
checkoutForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const name = document.getElementById("customer-name").value.trim();
    const phone = document.getElementById("customer-phone").value.trim();
    const tableNumber = document.getElementById("table-number").value.trim();

    if (!name || !phone) {
        alert("Please fill in all fields.");
        return;
    }

    // Calculate total
    let total = 0;
    for (const id in cart) {
        total += cart[id].price * cart[id].quantity;
    }

    if (total === 0) {
        alert("Your cart is empty!");
        return;
    }

    try {
        const orderData = {
            customer_name: name,
            customer_phone: phone,
            table_number: tableNumber || null, // Optional field
            total: total,
            cart: cart, // Controller expects 'cart', not 'items'
        };

        const response = await fetch("/orders", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify(orderData),
        });

        const result = await response.json();

        if (response.ok && result.success) {
            alert(
                `Thank you, ${name}! Your order has been received. Order #${result.order_id}`,
            );
            cart = {};
            updateCartDisplay();
            checkoutForm.reset();
            checkoutModal.classList.add("hidden");
        } else {
            alert(result.message || "Something went wrong. Please try again.");
        }
    } catch (error) {
        console.error("Error submitting order:", error);
        alert("Failed to submit order. Please try again.");
    }
});
