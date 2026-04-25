@extends('layout')

@section('content')

<h3>🤖 AIDIA Health Assistant</h3>
<p style="color:gray;">Tanyakan seputar diabetes dan kesehatan</p>

<div id="chat-box" style="
    border:1px solid #ddd;
    padding:15px;
    height:400px;
    overflow:auto;
    background:#f5f7fb;
    border-radius:10px;
">

</div>

<div style="display:flex; gap:10px; margin-top:10px;">
    <input type="text" id="message" placeholder="Tanya sesuatu..." class="form-control">
    <button onclick="sendMessage()" class="btn btn-primary">Kirim</button>
</div>

<style>
.chat-user {
    text-align: right;
    margin-bottom: 10px;
}

.chat-user span {
    background: #007bff;
    color: white;
    padding: 8px 12px;
    border-radius: 15px;
    display: inline-block;
}

.chat-ai {
    text-align: left;
    margin-bottom: 10px;
}

.chat-ai span {
    background: #e4e6eb;
    padding: 8px 12px;
    border-radius: 15px;
    display: inline-block;
}
</style>

<script>
function sendMessage() {
    let input = document.getElementById('message');
    let msg = input.value;

    if (!msg) return;

    let box = document.getElementById('chat-box');

    // tampil user
    box.innerHTML += `
        <div class="chat-user">
            <span>${msg}</span>
        </div>
    `;

    // loading
    let id = 'ai-' + Date.now();
    box.innerHTML += `
        <div class="chat-ai" id="${id}">
            <span>mengetik...</span>
        </div>
    `;

    box.scrollTop = box.scrollHeight;

    fetch('/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({message: msg})
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById(id).innerHTML = `<span>${data.reply}</span>`;
        box.scrollTop = box.scrollHeight;
    })
    .catch(() => {
        document.getElementById(id).innerHTML = `<span>ERROR</span>`;
    });

    input.value = "";
}

// 🔥 ENTER = KIRIM
document.getElementById("message").addEventListener("keypress", function(e) {
    if (e.key === "Enter") {
        sendMessage();
    }
});
</script>

@endsection