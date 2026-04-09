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
let chatBtn = document.getElementById("chatBtn");
let chatBox = document.getElementById("chatBox");

if (chatBtn) {
    chatBtn.onclick = () => {
        if (chatBox.style.display === "block") {
            chatBox.style.display = "none";
        } else {
            chatBox.style.display = "block";
        }
    };
}

// CHATBOT (ONLY ONE FUNCTION)
function sendMessage() {
    let inputField = document.getElementById("userInput");
    let message = inputField.value.trim();

    if (message === "") return; // prevent empty

    let chat = document.getElementById("chatBody");

    chat.innerHTML += `<p><b>You:</b> ${message}</p>`;

    fetch("chatbot.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message: message })
    })
    .then(res => res.json())
    .then(data => {
        chat.innerHTML += `<p><b>AI:</b> ${data.reply}</p>`;
        chat.scrollTop = chat.scrollHeight; // auto scroll
    });

    inputField.value = "";
}

// LANGUAGE SWITCH
const translations = {
    en: { title: "Marketplace" },
    hi: { title: "बाजार" },
    mr: { title: "मार्केटप्लेस" }
};

function changeLang() {
    let lang = document.getElementById("lang").value;
    let title = document.querySelector("#marketplace h2");

    if (title) {
        title.innerText = translations[lang].title;
    }
}
