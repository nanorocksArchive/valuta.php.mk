import { Component, OnInit } from '@angular/core';
import { ExchangeRatesService } from "../../_services/index";
import { Rate } from 'src/app/_models/Rate';
import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-history',
  templateUrl: './history.component.html'
})
export class HistoryComponent implements OnInit {

  public historyRates: Rate[] = [];

  public rates: Rate[] = [];

  public dates = [];

  public selectedRates: Rate[] = [];

  public selectedRatesValue:string = 'No selection';

  constructor(private exchangeRatesService: ExchangeRatesService, private spinner: NgxSpinnerService) { }

  ngOnInit(): void {
    this.loadExhangeRates();
    this.loadHistoryRates();
  }

  loadHistoryRates()
  {

    this.exchangeRatesService.historyRates().subscribe(res => {
      res.forEach(element => {

        let date = new Date(element.datum);
        let dateStr = date.getDate() + '/' + date.getMonth() + '/' + date.getFullYear();
        if (this.dates.indexOf(dateStr) == -1){
          this.dates.push(dateStr);
        }

        this.historyRates.push(new Rate(
          element.datum,
          element.oznaka,
          element.kupoven,
          element.sreden,
          element.prodazen,
          element.valuta_id,
          element.edinica,
          element.drzava_mk,
          element.drzava_en,
          element.valuta_en,
          element.valuta_mk
        ));
      });

    }, error => {
      alert("No history of exchange rates.");
    });
  }

  loadExhangeRates() {
    this.spinner.show();
    this.exchangeRatesService.todayRates().subscribe(res => {
      res.data.forEach(element => {
        this.rates.push(new Rate(
          element.datum,
          element.oznaka,
          element.kupoven,
          element.sreden,
          element.prodazen,
          element.valuta_id,
          element.edinica,
          element.drzava_mk,
          element.drzava_en,
          element.valuta_en,
          element.valuta_mk
        ));
      });
      setTimeout(() => this.spinner.hide(), 1000);

    }, error => {
      alert("There was an error no rates for today.");
    });
  }

  setFromValue(rate: Rate)
  {
    let flag = rate.flag;
    this.selectedRatesValue = rate.contryPriceEn;
    this.selectedRates = [];
    this.historyRates.forEach(element => {
      if(element.flag == flag)
      {
        this.selectedRates.push(element);
      }
    });
    // console.log("MMM",this.selectedRates);
  }

}
