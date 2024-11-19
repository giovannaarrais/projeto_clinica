async function carregar_palavra(valor) {
    const resultadoPesq = document.querySelector('#resultado_pesquisa');

    resultadoPesq.innerHTML += '';

    if (valor.length >= 3) {
        try {
            const dados = await fetch('pesquisar_palavra.php?nome=' + valor);
            const resposta = await dados.json();

            if (resposta.status) {
                let html = '';
                resposta.data.forEach(item => {
                    html += `
                        <div class="result-item">
                            <p><strong>Nome:</strong> ${item.nome_paciente}</p>
                            <p><strong>CPF:</strong> ${item.cpf_paciente}</p>
                            <hr>
                        </div>
                    `;
                });
                resultadoPesq.innerHTML = html;
            } else {
                resultadoPesq.innerHTML = `<p>${resposta.msg}</p>`;
            }
        } catch (error) {
            resultadoPesq.innerHTML = `<p>Erro na busca, tente novamente.</p>`;
            console.error('Erro ao buscar:', error);
        }
    } else {
        resultadoPesq.innerHTML = '<p>Digite ao menos 3 caracteres para buscar.</p>';
    }

    
}

function addClass(){
    let resultadoPesq = document.querySelector('#resultado_pesquisa');
    let containerPesq = document.querySelector('.container-pesquisa');
    let inputPesq = document.querySelector('.input-pesquisa');
    let itemResult = document.querySelectorAll('.result-item')

    inputPesq.addEventListener('click', function() {
        resultadoPesq.classList.add('show');
        containerPesq.classList.add('active-palavra');
        
    });

    // element.addEventListener('mouseout', function() {
    //     resultadoPesq.classList.remove('activepesq');
    // });

}

function init(){
    addClass();
}

init()





// <p><strong>Data de Nascimento:</strong> ${item.dt_nasc_paciente}</p>
// <p><strong>Email:</strong> ${item.email_paciente}</p>
// <p><strong>Endereço:</strong> ${item.endereco_paciente}</p>
// <p><strong>Telefone:</strong> ${item.fone_paciente}</p>
// <p><strong>Sexo:</strong> ${item.sexo_paciente}</p>