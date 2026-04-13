// Validate form
function validateForm() {
    let phone = document.querySelector("input[name='phone']").value;

    if (phone.length !== 10 || isNaN(phone)) {
        alert("Enter valid 10-digit mobile number");
        return false;
    }
    return true;
}

// Page load
window.onload = function () {
    console.log("Farmer Platform Loaded 🚜");
};

// SEARCH (SAFE)
let searchInput = document.getElementById("searchInput");

if (searchInput) {
    searchInput.addEventListener("keyup", function () {
        let value = this.value.toLowerCase();
        let cards = document.querySelectorAll(".card");

        cards.forEach(card => {
            let text = card.innerText.toLowerCase();
            card.parentElement.style.display = text.includes(value) ? "" : "none";
        });
    });
}

// CHAT TOGGLE (FIXED)
function sendMessage() {
    let inputField = document.getElementById("userInput");
    let chat = document.getElementById("chatBody");
    let message = inputField.value.trim();

    if (message === "") return;

    // Display user message immediately
    chat.innerHTML += `<div style="text-align:right; margin: 5px; color: #2e7d32;"><b>You:</b> ${message}</div>`;
    inputField.value = ""; // Clear input immediately for better UX

    fetch("chatbot.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message: message })
    })
    .then(res => {
        if (!res.ok) throw new Error("Server Error");
        return res.json();
    })
    .then(data => {
        chat.innerHTML += `<div style="text-align:left; margin: 5px; color: #333;"><b>AI:</b> ${data.reply}</div>`;
        chat.scrollTop = chat.scrollHeight;
    })
    .catch(err => {
        chat.innerHTML += `<p style="color:red;"><b>Error:</b> Could not connect to AI.</p>`;
        console.error(err);
    });
}

// Add Enter Key Support
document.getElementById("userInput").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        sendMessage();
    }
});
// LANGUAGE SWITCH
const translations = {
    en: { title: "Marketplace" },
    hi: { title: "बाजार" },
    mr: { title: "मार्केटप्लेस" }
};

function changeLang() {
    let lang = document.getElementById("lang").value;

    if(lang === "hi"){
        document.querySelector("title").innerText = "फार्मकनेक्ट";
        document.querySelector(".lead").innerText = "किसानों और खरीदारों को जोड़ने वाला प्लेटफॉर्म";
    }

    else if(lang === "mr"){
        document.querySelector("title").innerText = "फार्मकनेक्ट";
        document.querySelector(".lead").innerText = "शेतकरी आणि खरेदीदार यांना जोडणारे प्लॅटफॉर्म";
    }

    else {
        document.querySelector("title").innerText = "FarmConnect";
        document.querySelector(".lead").innerText = "Direct Connection Between Farmers & Buyers";
    }
}
// SEARCH FILTER LOGIC
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let cards = document.querySelectorAll('.product-card');

    cards.forEach(card => {
        let title = card.querySelector('h5').innerText.toLowerCase();
        if (title.includes(filter)) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    });
});
function showUPIDetails() {
    // This highlights the UPI selection
    document.getElementById('upi').checked = true;
}

function processSelection() {
    let isUPI = document.getElementById('upi').checked;
    
    if (isUPI) {
        // Hide selection, show scanner
        document.getElementById('paymentSelection').style.display = 'none';
        document.getElementById('upiScannerArea').style.display = 'block';
    } else {
        // For COD or Card, you can just submit directly or show other screens
        alert("Proceeding with other payment method...");
        // You can add similar logic for Card details here
    }
}

function goBackToSelection() {
    document.getElementById('paymentSelection').style.display = 'block';
    document.getElementById('upiScannerArea').style.display = 'none';
}
function processSelection() {
    document.getElementById('paymentSelection').style.display = 'none';
    document.getElementById('upiScannerArea').style.display = 'block';
}
