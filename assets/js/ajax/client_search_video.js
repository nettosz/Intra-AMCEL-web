import server from "../../../js/server";

const searchInput = document.querySelector("#search-video");
const containerVideos = document.querySelector("#container-body");

async function getSearch(event) {
  if (event.target.value === "") return;
  const data = await server.get("/video/search?search=" + event.target.value);
  containerVideos.innerHTML = "";
  if (data.data === "")
    containerVideos.innerHTML = "<h6> Nenhum resultado encontrado </h6>";
  else containerVideos.innerHTML = data.data;
}

searchInput.addEventListener("keypress", getSearch);
