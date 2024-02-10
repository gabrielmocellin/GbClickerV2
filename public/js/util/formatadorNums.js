function formatador(numero, precisao) {
  var valoresSufixosMap = [
    { valor: 1,    sufixo: ""  },
    { valor: 1E3,  sufixo: "K" },
    { valor: 1E6,  sufixo: "M" },
    { valor: 1E9,  sufixo: "B" },
    { valor: 1E12, sufixo: "T" },
    { valor: 1E15, sufixo: "q" },
    { valor: 1E18, sufixo: "Q" },
    { valor: 1E21, sufixo: "s" },
    { valor: 1E24, sufixo: "S" },
    { valor: 1E27, sufixo: "O" },
    { valor: 1E30, sufixo: "N" },
    { valor: 1E33, sufixo: "D" }
  ];
  //var regex = /\.0+$|(\.[0-9]*[1-9])0+$/;
  var chave;
  for (chave = valoresSufixosMap.length - 1; chave > 0; chave--) {
      let sufixoEncontrado = Math.abs(numero) >= valoresSufixosMap[chave].valor;
      if (sufixoEncontrado) {
        break;
      }
  }
  let numeroSimplificado = numero / valoresSufixosMap[chave].valor;
  let numeroFormatado = numeroSimplificado.toFixed(precisao);
  let isCentenaOuMenos = valoresSufixosMap[chave].valor === 1;
  if (isCentenaOuMenos) {
      numeroFormatado = numeroSimplificado;
  }
  let stringFormatada = numeroFormatado + valoresSufixosMap[chave].sufixo;
  return stringFormatada;
}

function formatarNumerosNasDivs(querySelector, casasDecimais)
{
    var divs = document.querySelectorAll(querySelector);
    divs.forEach(function(div) {
      var numero = parseInt(div.innerText);
      if (Number.isInteger(numero)) {
        div.innerText = formatador(numero, casasDecimais);
      }
    });
}

window.onload = function() {
  formatarNumerosNasDivs();
};