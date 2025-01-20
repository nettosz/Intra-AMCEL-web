import server from "../../../js/server";

const searchInput = document.querySelector("#search-base");
const conatinerBases = document.querySelector(".container-bases");

async function getSearch(event) {
  if (event.target.value === "") return;

  const data = await server.get(
    "/base-conhecimento/search?search=" + event.target.value
  );
  conatinerBases.innerHTML = "";

  if (data.data === "")
    conatinerBases.innerHTML = "<h6> Nenhum resultado encontrado </h6>";
  else conatinerBases.innerHTML = data.data;
}

searchInput.addEventListener("keypress", getSearch);
