const chatBox = document.querySelector(".chat-box");
const chatForm = document.querySelector("#chat-form");

// Get id from url
const url = window.location.href;
const id = url.split("=")[1];

chatForm.addEventListener("submit", function (e) {
  e.preventDefault();
  let data = new FormData(chatForm);

  fetch("services/sendMessages.php", {
    method: "POST",
    body: data,
  }).then((res) =>
    res.json().then((data) => {
      chatBox.innerHTML += `
      <div class="bubble outgoing">
            <p>
                ${data}
            </p>
        </div>
        `;
      chatForm.message.value = "";
      chatBox.scrollTop = chatBox.scrollHeight;
    })
  );
});

// Get messages from database
function getMessages() {
  fetch("services/getMessages.php?id=" + id).then((res) =>
    res.json().then((data) => {
      chatBox.innerHTML = "";
      data.forEach((message) => {
        chatBox.innerHTML += `
            <div class="bubble ${
              message.incoming_id == id ? "outgoing" : "incoming"
            }">
                <p>
                    ${message.msg}
                </p>
            </div>
            `;
        chatBox.scrollTop = chatBox.scrollHeight;
      });
    })
  );
}

setInterval(getMessages, 2000);
