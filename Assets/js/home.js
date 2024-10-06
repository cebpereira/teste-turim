let pessoas = [];

function gravar() {
  let jsonData = JSON.stringify({
    pessoas: pessoas,
  });

  $.ajax({
    url: "../Controller/Controller.php?action=gravar",
    type: "POST",
    data: {
      json: jsonData,
    },
    success: function (response) {
      alert("Dados gravados com sucesso!");
    },
    error: function () {
      alert("Erro ao gravar os dados.");
    },
  });
}

function ler() {
  $.ajax({
    url: "../Controller/Controller.php?action=ler",
    type: "GET",
    success: function (response) {
      let data = JSON.parse(response);
      pessoas = data.pessoas;
      atualizarTabela();
    },
    error: function () {
      alert("Erro ao ler os dados.");
    },
  });
}

function incluirPessoa() {
  let nome = document.getElementById("nomePessoa").value;
  if (nome) {
    pessoas.push({
      nome: nome,
      filhos: [],
    });
    atualizarTabela();
    document.getElementById("nomePessoa").value = "";
  } else {
    alert("Por favor, insira um nome.");
  }
}

// Função para remover uma pessoa
function removerPessoa(index) {
  pessoas.splice(index, 1);
  atualizarTabela();
}

// Função para adicionar um filho
function adicionarFilho(index) {
  let nomeFilho = prompt("Nome do filho:");
  if (nomeFilho) {
    pessoas[index].filhos.push(nomeFilho);
    atualizarTabela();
  }
}

// Função para remover um filho
function removerFilho(pessoaIndex, filhoIndex) {
  pessoas[pessoaIndex].filhos.splice(filhoIndex, 1);
  atualizarTabela();
}

// Função para atualizar a tabela HTML e o JSON
function atualizarTabela() {
  let tabela = document.getElementById("listaPessoas");
  tabela.innerHTML = "";

  pessoas.forEach((pessoa, pessoaIndex) => {
    let pessoaHTML = `
                    <tr>
                        <td>
                            <div class="pessoa-item">
                                <div class="pessoa">
                                    <div class="nomePessoa">
                                        <span>${pessoa.nome}</span>
                                    </div>
                                    
                                    <div class="removerPessoa">
                                        <button onclick="removerPessoa(${pessoaIndex})">Remover</button>
                                    </div>
                                </div>

                                <div class="filhos">
                                    <ul style="list-style: none;">
                                        ${pessoa.filhos
                                          .map(
                                            (filho, filhoIndex) => `
                                            <li>
                                                <div class="nomeFilho">
                                                    -<span>${filho}</span>
                                                </div> 
                                                
                                                <div class="removerFilho">
                                                    <button onclick="removerFilho(${pessoaIndex}, ${filhoIndex})">Remover filho</button>
                                                </div>
                                            </li>
                                        `
                                          )
                                          .join("")}
                                    </ul>
                                </div>

                                <div class="addFilhos">
                                    <button onclick="adicionarFilho(${pessoaIndex})">Adicionar filho</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
    tabela.innerHTML += pessoaHTML;
  });

  atualizarJSON();
}

function atualizarJSON() {
  document.getElementById("jsonOutput").textContent = JSON.stringify(
    {
      pessoas: pessoas,
    },
    null,
    4
  );
}

atualizarTabela();
