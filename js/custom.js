async function carregar_palavra(valor){
    if (valor.length >=3){
    const dados =  await fetch('pesquisar_palavra.php?nome=' + valor)

    const resposta = await dados.json()
    console.log(resposta);
    }
}