import Vue from 'vue'

var rateUrl = 'https://api.php.mk/nbrm/v1.0/?token=c40b5ab8a3b190ac6c40aaef3df88717';
var historyUrl = 'https://valuta.php.mk/service/endpoint/';

export const state = new Vue({
    data: {
        rateData: [],
        historyData: []
    },
    methods:{
        erData: function () {
            var self = this;
            var rate = localStorage.getItem('rateData');
            if(rate != null)
            {
                self.rateData = JSON.parse(rate);
                return;
            }
        
            fetch(rateUrl)
            .then(function (response) {
                return response.json();
            })
            .then(function (response) {
                if (!response.error){
                    self.rateData = response.data;
                    //console.log(response.data);
                    //localStorage.setItem('rateData', JSON.stringify(response.data));
                }
            })
            .catch(function (err) {
                console.log(err);
            });
        },
        history: function () {
            var self = this;
            fetch(historyUrl)
                .then(function (response) {
                    return response.json();
                })
                .then(function (response) {
                    if (!response.error) {
                        //console.log(response);
                        self.historyData = response;
                    }
                })
                .catch(function (err) {
                    console.log(err);
                });  
        }
    },
    created: function () {
        this.erData();
        this.history();
    }
})