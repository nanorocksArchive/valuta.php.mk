window.onload = function(e)
{
    let ddc = new DropDownClass();
    let ddcBlock = document.getElementById('ddc');
    ddc.fillData(ddcBlock);

    let cc = new ChartClass();
    cc.renderChart('eur');

    let chartBlock = document.getElementById('chart');

    ddcBlock.addEventListener('change', function () {

        let input = ddcBlock.value;
        chartBlock.innerHTML = '';
        cc.renderChart(input);
        history.pushState(input, null, window.location.pathname + '#' + input);
    });


    window.onpopstate = function (e) {
        if(e.state == null)
        {
            return -1;
        }

        let input = e.state;
        ddcBlock.value = input;
        chartBlock.innerHTML = '';
        cc.renderChart(input);
    }
};