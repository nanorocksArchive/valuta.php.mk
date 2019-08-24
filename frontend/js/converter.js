var data;

async function LoadDropDownData() {
    let response = await fetch("https://valuta.php.mk/api/list");

    if (response.ok) { // if HTTP-status is 200-299
        // get the response body (see below)
        let json = await response.json();
        //console.log(json);
        data = json.data;
        FillDropDownData(data);


    } else {

    }
}

async function LoadConvertData(FirstCurrency, SecondCurrency, Amount) {
    var Concat = 'https://valuta.php.mk/api/converter/' + FirstCurrency + '/' + SecondCurrency + '/' + Amount;

    let response = await fetch(Concat);

    if (response.ok) { // if HTTP-status is 200-299
        // get the response body (see below)
        let json = await response.json();
        var float = parseFloat(json.data.price, 10);
        document.getElementById('Fresult').innerHTML = float.toFixed(4);
    } else {

    }
}

function FillDropDownData(data) {

    // get reference to select element
    var sel1 = document.getElementById('FromC');
    var sel2 = document.getElementById('ToC');

    for (var i = 0; i < data.length; i++) {

        // create new option element
        var opt1 = document.createElement('option');
        var opt2 = document.createElement('option');

        // create text node to add to option element (opt)
        opt1.appendChild(document.createTextNode(data[i].oznaka));
        opt2.appendChild(document.createTextNode(data[i].oznaka));
        // set value property of opt
        opt1.value = data[i].oznaka;
        opt2.value = data[i].oznaka;

        // add opt to end of select box (sel)
        sel1.appendChild(opt1);
        sel2.appendChild(opt2);
    }

}

function Convert() {

    var CurrencyOneSelect = document.getElementById("FromC");
    var CurrencyOneValue = CurrencyOneSelect.options[CurrencyOneSelect.selectedIndex].value;

    var CurrencyTwoSelect = document.getElementById("ToC");
    var CurrencyTwoValue = CurrencyTwoSelect.options[CurrencyTwoSelect.selectedIndex].value;

    var Amount = document.getElementById("Amount").value;

    LoadConvertData(CurrencyOneValue, CurrencyTwoValue, Amount);

}
