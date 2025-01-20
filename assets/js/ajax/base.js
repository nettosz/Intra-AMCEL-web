import server from "../../../js/server";

var categoria = document.querySelector("#categoria");
var categoriaModal = document.querySelector("#categoria-modal");

var categoriaCriar = document.querySelector("#categoria-criar");
var categoriaEditar = document.querySelector("#categoria-editar");
var categoriaDeletar = document.querySelector("#categoria-deletar");

var modalInput = document.querySelector(".modal-input");
var inputOption = document.querySelector("#inputOption");
var btnSalvarCategoria = document.querySelector("#btn-salvar-categoria");

var subCategoria = document.querySelector("#sub-categoria");
var isExistSubCategoriaId = subCategoria.dataset.id || "0";
var isExistDataSetId = categoria.dataset.id || "0";

var categoriaOption = "";

categoria.addEventListener("change", async (event) => {
  getCategoria(
    `/admin/categoria/${event.target.value}/sub?table=base_conhecimento`,
    "#sub-categoria"
  );
});

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
var modalInput1 = document.querySelector(".modal-input-sub");

var inputOptionSub = document.querySelector("#inputOptionSub");

function SubCategoriaAtivar1() {
  modalInput1.style.pointerEvents = "all";
  modalInput1.style.opacity = "1";
}

CategoriaModalSub.addEventListener("focusin", (event) => {
  getCategoria(
    "/admin/categoria?table=base_conhecimento",
    "#categoria-modal-sub"
  );
});

CategoriaModalSub.addEventListener("change", (event) => {
  getCategoria(
    `/admin/categoria/${event.target.value}/sub?table=base_conhecimento`,
    "#sub-categoria-modal"
  );
});

SubCategoriaCriar.addEventListener("click", (event) => {
  subCategoriaCRUDOption = event.target.id;
  console.log(subCategoriaCRUDOption);
  SubCategoriaAtivar1();
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
    let id_cat =
      CategoriaModalSub.options[CategoriaModalSub.selectedIndex].value;
    server({
      method: "post",
      url: `/admin/categoria/${id_cat}/sub/${id}/delete?table=base_conhecimento`,
      data: params,
    }).then((response) => {
      console.log(response.data);
      if (response.data.message === "ok") {
        getCategoria(
          `/admin/categoria/${id_cat}/sub?table=base_conhecimento`,
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
        let id_cat =
          CategoriaModalSub.options[CategoriaModalSub.selectedIndex].value;
        server({
          method: "post",
          url: `/admin/categoria/${id_cat}/sub/store?table=base_conhecimento`,
          data: params,
        }).then((response) => {
          console.log(response.data);
          if (response.data.message === "ok") {
            getCategoria(
              `/admin/categoria/${id_cat}/sub?table=base_conhecimento`,
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
          url: `/admin/categoria/${id_cat}/sub/${id}/update?table=base_conhecimento`,
          data: params,
        }).then((response) => {
          console.log(response.data);
          if (response.data.message === "ok") {
            getCategoria(
              `/admin/categoria/${id_cat}/sub?table=base_conhecimento`,
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
}

/* FIM SUB CATEGORIA */
function categoriaAtivar() {
  modalInput.style.pointerEvents = "all";
  modalInput.style.opacity = "1";
}

function categoriaDesativar() {
  modalInput.style.pointerEvents = "none";
  modalInput.style.opacity = "0.5";
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
      url: `/admin/categoria/${id}/delete?table=base_conhecimento`,
      data: params,
    }).then((response) => {
      console.log(response.data);
      if (response.data.message === "ok") {
        getCategoria("/admin/categoria", "#categoria-modal");
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
        url: "/admin/categoria/store?table=base_conhecimento",
        data: params,
      }).then((response) => {
        console.log(response.data);
        if (response.data.message === "ok") {
          getCategoria("/admin/categoria", "#categoria-modal");
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
          url: `/admin/categoria/${id}/update?table=base_conhecimento`,
          data: params,
        }).then((response) => {
          console.log(response.data);
          if (response.data.message === "ok") {
            getCategoria("/admin/categoria", "#categoria-modal");
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
  getCategoria("/admin/categoria", "#categoria");
});

categoriaModal.addEventListener("focusin", (event) => {
  getCategoria("/admin/categoria", "#categoria-modal");
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

if (document.querySelector("#form-base")) {

  let formSalvar = document.querySelector("#form-base");

  formSalvar.addEventListener("submit", async (e) => {
    e.preventDefault();
    const nome = document.querySelector("#titulo");
    const desc_curta = document.querySelector("#desc_curta");
    const categoria = document.querySelector("#categoria");
    const subCategoria = document.querySelector("#sub-categoria");
    const descricao = $("#summernote").summernote("code");

    if (categoria.options[categoria.selectedIndex].value === 0) {
      alert("Preencher todos os campos");
      return;
    }
    if (subCategoria.options[subCategoria.selectedIndex].value === 0) {
      alert("Preencher todos os campos");
      return;
    }
    

    
    salvar([
      {
        index: "titulo",
        value: nome.value,
      },
      {
        index: "desc_curta",
        value: desc_curta.value,
      },
      {
        index: "categoria",
        value: categoria.options[categoria.selectedIndex].value,
      },
      {
        index: "sub_categoria",
        value: subCategoria.options[subCategoria.selectedIndex].value,
      },
      {
        index: "descricao",
        value: descricao,
      },
    ]).then((response) => {
      if (response === "ok") {
        alert("Salvo com sucesso");
      } else {
        alert("Erro ao salvar");
      }
    });
  });

  
  function salvar([...params]) {
    const parameters = new URLSearchParams();
    const token = document.cookie.split("=")[1];
    parameters.append("token", token);
  
    for (let param = 0; param <= params.length - 1; param++) {
      if (params[param].value === "" || params[param].value === "0") {
        alert("Preencher todos os campos");
        return 0;
      } else {
        parameters.append(params[param].index, params[param].value);
      }
    }
    formSalvar.style.pointerEvents = "none";
    formSalvar.style.opacity = "0.5";
    return server({
      method: "POST",
      url: "/admin/base-conhecimento/store",
      data: parameters,
    }).then((response) => {
      formSalvar.style.pointerEvents = "all";
      formSalvar.style.opacity = "1";
      return response.data.message;
    });
  }
}

