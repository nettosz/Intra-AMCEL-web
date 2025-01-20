import server from "../../../js/server";

var categoria = document.querySelector("#categoria");
var categoriaModal = document.querySelector("#categoria-modal");

var categoriaCriar = document.querySelector("#categoria-criar");
var categoriaEditar = document.querySelector("#categoria-editar");
var categoriaDeletar = document.querySelector("#categoria-deletar");

var modalInput = document.querySelector(".modal-input");
var inputOption = document.querySelector("#inputOption");
var btnSalvarCategoria = document.querySelector("#btn-salvar-categoria");

var categoriaOption = "";

var subCategoria = document.querySelector("#sub-categoria");
var isExistSubCategoriaId = subCategoria.dataset.id || "0";
var isExistDataSetId = categoria.dataset.id || "0";

var id_video = document.querySelector("#video-id")
  ? document.querySelector("#video-id").dataset.categoria
  : 0;

/**
 * SUb Categoria CRUD
 */

var SubCategoriaCriar = document.querySelector("#sub-categoria-criar");
var SubCategoriaEditar = document.querySelector("#sub-categoria-editar");
var SubCategoriaDeletar = document.querySelector("#sub-categoria-deletar");

var CategoriaModalSub = document.querySelector("#categoria-modal-sub");
var SubCategoriaModalSub = document.querySelector("#sub-categoria-modal");

var btnSalvarSubCategoria = document.querySelector("#btn-salvar-sub-categoria");
let subCategoriaCRUDOption = "";

var inputOptionSub = document.querySelector("#inputOptionSub");

function SubCategoriaAtivar1() {
  var modalInput1 = document.querySelector(".modal-input-sub");
  modalInput1.style.pointerEvents = "all";
  modalInput1.style.opacity = "1";
}

CategoriaModalSub.addEventListener("focusin", (event) => {
  getCategoria("/admin/categoria?table=video", "#categoria-modal-sub");
});

SubCategoriaCriar.addEventListener("click", (event) => {
  subCategoriaCRUDOption = event.target.id;
  SubCategoriaAtivar1();
});

CategoriaModalSub.addEventListener("change", (event) => {
  getCategoria(
    `/admin/categoria/${event.target.value}/sub?table=video`,
    "#sub-categoria-modal"
  );
});

SubCategoriaEditar.addEventListener("click", (event) => {
  subCategoriaCRUDOption = event.target.id;
  SubCategoriaAtivar1();
});

btnSalvarSubCategoria.addEventListener("click", (event) => {
  SubcategoriaCrudoption();
});

SubCategoriaDeletar.addEventListener("click", (event) => {
  if (
    CategoriaModalSub.selectedIndex !== 0 ||
    SubCategoriaModalSub.selectedIndex !== 0
  ) {
    const params = new URLSearchParams();
    params.append("nome", inputOptionSub.value);
    let id =
      SubCategoriaModalSub.options[SubCategoriaModalSub.selectedIndex].value;
    let id_cat = CategoriaModalSub.dataset.id;
    server({
      method: "post",
      url: `/admin/categoria/${id_cat}/sub/${id}/delete?table=video`,
      data: params,
    }).then((response) => {
      console.log(response.data);
      if (response.data.message === "ok") {
        getCategoria(
          `/admin/categoria/${id_cat}/sub?table=video`,
          "#sub-categoria-modal"
        );
        alert("Criado com sucesso!");
      } else {
        alert("erro ao criar!");
      }
    });
  } else {
    alert("selecione uma categoria!");
  }
});

function SubcategoriaCrudoption() {
  if (subCategoriaCRUDOption === "sub-categoria-criar") {
    if (CategoriaModalSub.selectedIndex !== 0) {
      if (inputOptionSub.value === "") {
        alert("preencher campo!");
      } else {
        const params = new URLSearchParams();
        params.append("nome", inputOptionSub.value);
        let id =
          SubCategoriaModalSub.options[SubCategoriaModalSub.selectedIndex]
            .value;
        let id_cat =
          CategoriaModalSub.options[CategoriaModalSub.selectedIndex].value;
        console.log(id_cat);
        server({
          method: "post",
          url: `/admin/categoria/${id_cat}/sub/store?table=video`,
          data: params,
        }).then((response) => {
          if (response.data.message === "ok") {
            getCategoria(
              `/admin/categoria/${id_cat}/sub?table=video`,
              "#sub-categoria-modal"
            );
            alert("Criado com sucesso!");
          } else {
            alert("erro ao criar!");
          }
        });
      }
    } else {
      alert("selecione uma categoria!");
    }
  } else if (subCategoriaCRUDOption === "sub-categoria-editar") {
    if (
      CategoriaModalSub.selectedIndex !== 0 ||
      SubCategoriaModalSub.selectedIndex !== 0
    ) {
      if (inputOptionSub.value === "") {
        alert("preencher campo!");
      } else {
        const params = new URLSearchParams();
        params.append("nome", inputOptionSub.value);
        let id =
          SubCategoriaModalSub.options[SubCategoriaModalSub.selectedIndex]
            .value;
        let id_cat =
          CategoriaModalSub.options[CategoriaModalSub.selectedIndex].value;
        server({
          method: "post",
          url: `/admin/categoria/${id_cat}/sub/${id}/update?table=video`,
          data: params,
        }).then((response) => {
          console.log(response.data);
          if (response.data.message === "ok") {
            getCategoria(
              `/admin/categoria/${id_cat}/sub?table=video`,
              "#sub-categoria-modal"
            );
            alert("Criado com sucesso!");
          } else {
            alert("erro ao criar!");
          }
        });
      }
    } else {
      alert("selecione uma categoria!");
    }
  }

  // else if (categoriaOption === "sub-categoria-editar") {
  //   if (inputOptionSub.value === "") {
  //     alert("preencher campo!");
  //   } else {
  //     console.log("ok");
  //     if (categoriaModal.selectedIndex !== 0) {
  //       const params = new URLSearchParams();
  //       params.append("nome", inputOption.value);
  //       let id = categoriaModal.options[categoriaModal.selectedIndex].value;
  //       axios({
  //         method: "post",
  //         url: `http://localhost/intra-amcel-web/admin/categoria/${id}/update?table=video`,
  //         data: params,
  //       }).then((response) => {
  //         console.log(response.data);
  //         if (response.data.message === "ok") {
  //           getCategoria("/admin/categoria?table=video", "#categoria-modal");
  //           alert("alterado com sucesso!");
  //         } else {
  //           alert("erro ao criar!");
  //         }
  //       });
  //     } else {
  //       alert("Selecione uma opção!");
  //     }
  //   }
  // }
}

/* FIM SUB CATEGORIA */

categoria.addEventListener("change", async (event) => {
  getCategoria(
    `/admin/categoria/${event.target.value}/sub?table=video`,
    "#sub-categoria"
  );
});

function SubCategoriaAtivar() {
  modalInput.style.pointerEvents = "all";
  modalInput.style.opacity = "1";
}

function categoriaDesativar() {
  modalInput.style.pointerEvents = "none";
  modalInput.style.opacity = "0.5";
}
function categoriaAtivar() {
  modalInput.style.pointerEvents = "all";
  modalInput.style.opacity = "1";
}

categoriaCriar.addEventListener("click", (event) => {
  categoriaOption = event.target.id;
  categoriaAtivar();
});
categoriaEditar.addEventListener("click", (event) => {
  categoriaOption = event.target.id;
  categoriaAtivar();
});

categoriaDeletar.addEventListener("click", () => {
  if (categoriaModal.selectedIndex !== 0) {
    const params = new URLSearchParams();
    params.append("nome", inputOption.value);
    let id = categoriaModal.options[categoriaModal.selectedIndex].value;
    server({
      method: "post",
      url: `/admin/categoria/${id}/delete?table=video`,
      data: params,
    }).then((response) => {
      console.log(response.data);
      if (response.data.message === "ok") {
        getCategoria("/admin/categoria?table=video", "#categoria-modal");
        alert("delteado com sucesso!");
      } else {
        alert("erro ao criar!");
      }
    });
  } else {
    alert("Selecione uma opção!");
  }
});

function categoriaCrudoption() {
  if (categoriaOption === "categoria-criar") {
    if (inputOption.value === "") {
      alert("preencher campo!");
    } else {
      const params = new URLSearchParams();
      params.append("nome", inputOption.value);
      server({
        method: "post",
        url: "/admin/categoria/store?table=video",
        data: params,
      }).then((response) => {
        console.log(response.data);
        if (response.data.message === "ok") {
          getCategoria("/admin/categoria?table=video", "#categoria-modal");
          alert("Criado com sucesso!");
        } else {
          alert("erro ao criar!");
        }
      });
    }
  } else if (categoriaOption === "categoria-editar") {
    if (inputOption.value === "") {
      alert("preencher campo!");
    } else {
      console.log("ok");
      if (categoriaModal.selectedIndex !== 0) {
        const params = new URLSearchParams();
        params.append("nome", inputOption.value);
        let id = categoriaModal.options[categoriaModal.selectedIndex].value;
        server({
          method: "post",
          url: `/admin/categoria/${id}/update?table=video`,
          data: params,
        }).then((response) => {
          console.log(response.data);
          if (response.data.message === "ok") {
            getCategoria("/admin/categoria?table=video", "#categoria-modal");
            alert("alterado com sucesso!");
          } else {
            alert("erro ao criar!");
          }
        });
      } else {
        alert("Selecione uma opção!");
      }
    }
  }
}

btnSalvarCategoria.addEventListener("click", (event) => {
  categoriaCrudoption();
});

categoria.addEventListener("focusin", (event) => {
  getCategoria("/admin/categoria?table=video", "#categoria");
});

categoriaModal.addEventListener("focusin", (event) => {
  getCategoria("/admin/categoria?table=video", "#categoria-modal");
});

export const getCategoria = async (url, id) => {
  var element = document.querySelector(id);
  var html = '<option value="0"> Selecionar...</option>';

  const response = await server.get(url);

  if (id === "#categoria") {
    response.data.map((cat) => {
      console.log(typeof cat.id);
      if (isExistDataSetId !== 0 && cat.id === isExistDataSetId) {
        html += `<option value="${cat.id}" selected> ${cat.nome} </option>`;
      } else {
        html += `<option value="${cat.id}"> ${cat.nome} </option>`;
      }
    });
  } else {
    response.data.map((cat) => {
      if (isExistSubCategoriaId !== "0" && cat.id === isExistSubCategoriaId) {
        html += `<option value="${cat.id}" selected> ${cat.nome} </option>`;
      } else {
        html += `<option value="${cat.id}" > ${cat.nome} </option>`;
      }
    });
  }

  element.innerHTML = html;
};
