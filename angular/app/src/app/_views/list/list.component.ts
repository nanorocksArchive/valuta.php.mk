import { Component, OnInit, Input } from '@angular/core';
import { ExchangeRatesService } from '../../_services/index';
import { Rate } from '../../_models/Rate';
import { NgxSpinnerService } from "ngx-spinner";

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
})
export class ListComponent implements OnInit {

  public rates: Rate[] = [];

  public todayDate: string = "";

  constructor(private exchangeRatesService: ExchangeRatesService, private spinner: NgxSpinnerService) { }

  ngOnInit(): void {
    this.loadExhangeRates();

    let date = new Date();
    this.todayDate = date.getDate() + '/' + date.getMonth() + '/' + date.getFullYear();
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
}
