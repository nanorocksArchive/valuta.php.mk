let FetchClass = function () {

    this.msg500 = 'Internal server error.';

    this.data = async function (endpoint) {
        let response = await fetch(endpoint);
        try {
            let json = await response.json();
            return json;
        } catch (e) {
            console.log('Error: ' + e);
        }
        return null;
    };
};

let LangClass = function () {
    this.getLang = function () {
        let lang = localStorage.getItem('lang');

        if (lang == null) {
            return 'mk';
        } else if (lang === 'en') {
            return 'en';
        } else if (lang === 'mk') {
            return 'mk';
        } else {
            return 'mk';
        }

    };
};

let DropDownClass = function () {

    this.endpoint = "https://valuta.php.mk/api/list";

    this.fillData = async function (block, mkdOption='') {

        let fetch = new FetchClass();
        let data = await fetch.data(this.endpoint);

        data = data.data;
        data = data.sort( function() {
          return Math.random() - 0.5
        });

        if (data == null) {
            console.log(fetch.msg500);
            return fetch.msg500;
        }

        let lang = new LangClass();
        lang = lang.getLang();

        let val = null;

        let html = '';
        if(mkdOption !== '')
        {
            let selectOptionText = this.getOptionsConvertText();
            html += `<option selected="selected" disabled>${selectOptionText.optionTxt}</option>`

        }

        for (let i = 0; i < data.length; i++) {

            if (lang === 'mk') {
                val = data[i].valuta_mk.toUpperCase();
            } else {
                val = data[i].valuta_en.toUpperCase();
            }

            if(i === 3)
            {
                html += mkdOption;
            }

            html += `<option value="${data[i].oznaka.toUpperCase()}">${val}</option>`;
        }

        block.innerHTML = html;
    };

    this.randomizeSelectedOption = function(blockId) {
        let selected = document.getElementById(blockId);
        //console.log(selected);
    };

    this.getOptionsConvertText = function () {
        let lang = new LangClass();
        lang = lang.getLang();

        if (lang === 'mk') {
            return {
                'optionTxt': 'ОДБЕРЕТЕ ВАЛУТА',

            };
        }
        if (lang === 'en') {
            return {
                'optionTxt': 'SELECT VALUE',
            };
        }
    };

    this.changeDropDownEvent = function(el1, el2){

        let value = el2.value;

        for(let i = 0; i < el1.options.length; i++)
        {
            el1.options[i].style = 'display: inline';
        }

        for(let i = 0; i < el1.options.length; i++)
        {
            let optionVal = el1.options[i];
            if(optionVal.value === value)
            {
                el1.options[i].style = 'display: none';
                break;
            }
        }

    }
};

let ChartClass = function () {

    this.endpoint = function (name) {
        return "https://valuta.php.mk/api/history/" + name;
    };

    this.getChartDate = async function (name) {
        let fetch = new FetchClass();
        let endpoint = this.endpoint(name);

        let data = await fetch.data(endpoint);
        if (data == null) {
            //console.log(fetch.msg500);
            return null;
        }

        return data;
    };

    this.getChartLang = function () {
        let lang = new LangClass();
        lang = lang.getLang();

        if (lang === 'mk') {
            return {
                'bayer': 'Kupoven',
                'seller': 'Prodazen',
                'avg': 'Sreden'
            };
        }
        if (lang === 'en') {
            return {
                'bayer': 'Bayer value',
                'seller': 'Seller value',
                'avg': 'Avg value'
            };
        }
    };

    this.chartPrepare = async function (name) {
        let data = await this.getChartDate(name);

        let bayerValue = [];
        let sellerValue = [];
        let avgValue = [];
        let dates = [];

        for (let i = 0; i < data.length; i++) {
            bayerValue.push(data[i].kupoven);
            sellerValue.push(data[i].prodazen);
            avgValue.push(data[i].sreden);
            dates.push(data[i].datum.slice(0, 10));
        }

        let langCategory = this.getChartLang();

        return {
            chart: {
                height: 450,
                type: 'line',
                zoom: {
                    enabled: false
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [5, 7, 5],
                curve: 'straight',
                dashArray: [0, 8, 5]
            },
            series: [
                {
                    name: langCategory['bayer'],
                    data: bayerValue
                },
                {
                    name: langCategory['seller'],
                    data: sellerValue
                },
                {
                    name: langCategory['avg'],
                    data: avgValue
                }
            ],
            markers: {
                size: 0,

                hover: {
                    sizeOffset: 10
                }
            },
            xaxis: {
                categories: dates,
            },
            tooltip: {
                y: [{
                    title: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                }, {
                    title: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                }, {
                    title: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                }]
            },
            grid: {
                borderColor: '#f1f1f1',
            }
        }
    };

    this.renderChart = async function (name) {
        let options = await this.chartPrepare(name);
        //console.log(options);

        let chart = new ApexCharts(
            document.querySelector("#chart"),
            options
        );

        chart.render();
    };
};