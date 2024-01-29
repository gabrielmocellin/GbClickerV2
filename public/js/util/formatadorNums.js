function formatador(num, digits)
{
    var si = [
      { value: 1, symbol: ""  },
      { value: 1E3, symbol: "K" },
      { value: 1E6, symbol: "M" },
      { value: 1E9, symbol: "B" },
      { value: 1E12, symbol: "T" },
      { value: 1E15, symbol: "q" },
      { value: 1E18, symbol: "Q" },
      { value: 1E21, symbol: "s" },
      { value: 1E24, symbol: "S" },
      { value: 1E27, symbol: "O" },
      { value: 1E30, symbol: "N" },
      { value: 1E33, symbol: "D" }
    ];
    var regex = /\.0+$|(\.[0-9]*[1-9])0+$/;
    var i;
    for (i = si.length - 1; i > 0; i--) {
      if (Math.abs(num) >= si[i].value) {
        break;
      }
    }
    return (num / si[i].value).toFixed(digits).replace(regex, "$1") + si[i].symbol;
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