// Form validation
function validateForm() {
    let phone = document.querySelector("input[name='phone']").value;

    if (phone.length !== 10 || isNaN(phone)) {
        alert("Enter valid 10-digit mobile number");
        return false;
    }
    return true;
}

window.onload = function () {
    console.log("Farmer Platform Loaded");
};

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

let chatBtn = document.getElementById("chatBtn");
let chatBox = document.getElementById("chatBox");

if (chatBtn && chatBox) {
    chatBtn.onclick = () => {
        chatBox.style.display = (chatBox.style.display === "block") ? "none" : "block";
    };
}

function sendMessage() {
    let inputField = document.getElementById("userInput");
    let chat = document.getElementById("chatBody");

    if (!inputField || !chat) {
        return;
    }

    let message = inputField.value.trim();

    if (message === "") return;

    chat.innerHTML += `<div style="text-align:right; margin:5px; color:green;"><b>You:</b> ${message}</div>`;
    inputField.value = "";

    fetch("chatbot.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message: message })
    })
    .then(res => res.json())
    .then(data => {
        chat.innerHTML += `<div style="text-align:left; margin:5px;"><b>AI:</b> ${data.reply}</div>`;
        chat.scrollTop = chat.scrollHeight;
    })
    .catch(() => {
        chat.innerHTML += `<div style="color:red;">Error connecting to AI</div>`;
    });
}

let inputBox = document.getElementById("userInput");
if (inputBox) {
    inputBox.addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            sendMessage();
        }
    });
}

function changeLang() {
    let lang = document.getElementById("lang").value;

    if(lang === "hi"){
        document.querySelector("h1").innerText = "???????????";
        document.querySelector(".lead").innerText = "??????? ?? ???????? ?? ?????? ???? ??????????";
    }
    else if(lang === "mr"){
        document.querySelector("h1").innerText = "???????????";
        document.querySelector(".lead").innerText = "?????? ??? ???????? ????? ??????? ??????????";
    }
    else {
        document.querySelector("h1").innerText = "FarmConnect";
        document.querySelector(".lead").innerText = "Direct Connection Between Farmers & Buyers";
    }
}

function processSelection() {
    document.getElementById('paymentSelection').style.display = 'none';
    document.getElementById('upiScannerArea').style.display = 'block';
}

function goBackToSelection() {
    document.getElementById('paymentSelection').style.display = 'block';
    document.getElementById('upiScannerArea').style.display = 'none';
}
