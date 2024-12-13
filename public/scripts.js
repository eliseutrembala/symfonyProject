const API_URL = "http://127.0.0.1:8000/carros";

// Função para buscar todos os carros
async function buscarCarros() {
  const response = await fetch(API_URL);
  const carros = await response.json();

  const listaCarros = document.getElementById("lista-carros");
  listaCarros.innerHTML = ""; // Limpa a lista antes de renderizar

  carros.forEach(carro => {
    const li = document.createElement("li");
    li.innerHTML = `
      <span>${carro.marca} ${carro.modelo} (${carro.ano}) - ${carro.cor}</span>
      <button onclick="excluirCarro(${carro.id})">Excluir</button>
    `;
    listaCarros.appendChild(li);
  });
}

// Função para adicionar um novo carro
async function adicionarCarro(event) {
  event.preventDefault(); // Evita o reload da página

  const marca = document.getElementById("marca").value;
  const modelo = document.getElementById("modelo").value;
  const ano = document.getElementById("ano").value;
  const cor = document.getElementById("cor").value;

  const carro = { marca, modelo, ano, cor };

  console.log(carro)
  await fetch(API_URL, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(carro),
  });

  document.getElementById("form-carro").reset(); // Reseta o formulário
  buscarCarros(); // Atualiza a lista
}

// Função para excluir um carro
async function excluirCarro(id) {
  await fetch(`${API_URL}/${id}`, {
    method: "DELETE",
  });
  buscarCarros(); // Atualiza a lista
}

// Event listener para o formulário
document.getElementById("form-carro").addEventListener("submit", adicionarCarro);

// Carrega os carros ao abrir a página
buscarCarros();
