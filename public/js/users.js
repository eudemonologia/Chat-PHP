const searchBar = document.querySelector(".search input");
const searchButton = document.querySelector(".search button");
const iconSearchButton = document.querySelector(".search button span");
const chats = document.querySelector(".chats");

searchButton.addEventListener("click", function () {
  searchBar.classList.toggle("active");
  searchButton.classList.toggle("active");
  iconSearchButton.innerHTML =
    iconSearchButton.innerHTML === "search" ? "close" : "search";
  searchBar.focus();
});

searchBar.addEventListener("keyup", function (e) {
  let searchValue = e.target.value;

  // get user list from getUsers.php
  fetch("services/search.php?search=" + searchValue).then((res) =>
    res.json().then((data) => {
      if (data.length > 0) {
        chats.innerHTML = "";
        data.forEach((user) => {
          chats.innerHTML += `
          <a href="chat.php?id=${user.id}" class="chat">
            <figure>
                <img src="public/images/avatars/${
                  user.image ? user.image : "unknown-user.jpg"
                }" alt="${user.name}">
                <div>
                    <h3>
                      ${user.name}
                    </h3>
                    <p>${user.last_msg ? user.last_msg : "No hay mensajes."}</p>
                </div>
            </figure>
            <span class="material-icons status ${
              // Saber si tuvo actividad los ultimos 5 minutos
              formatDate(user.last_activity) < 120 ? "online" : "offline"
            }">
            }">
                circle
            </span>
          </a>
          `;
        });
      } else {
        chats.innerHTML = `
        <h3>No hay resultados para "${e.target.value}"</h3>
      `;
      }
    })
  );
});
