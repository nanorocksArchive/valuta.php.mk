import { Component, OnInit } from '@angular/core';
import { ExchangeRatesService } from "../../_services/index";
import { Rate } from 'src/app/_models/Rate';

@Component({
  selector: 'app-convert',
  templateUrl: './convert.component.html',
  styleUrls: ['./convert.component.css']
})
export class ConvertComponent implements OnInit {

  public rates: Rate[] = [];

  public fromValue: string = "";

  public fromValueAvgPrice: number = 0;

  public fromValueFlag: string = "";

  public toValue: string = "";

  public toValueAvgPrice: number = 0;

  public toValueFlag: string = "";

  public calcValue: string = "0.00";

  public money: number = 0.00;

  constructor(private exchangeRatesService: ExchangeRatesService) { }

  ngOnInit(): void {
    this.getTodayExchangeRate();
  }

  setFromValue(rate: Rate) {
    this.fromValue = rate.contryPriceEn;
    this.fromValueFlag = rate.flag;
    this.fromValueAvgPrice = rate.avgPrice;
  }

  setToValue(rate: Rate) {
    this.toValue = rate.contryPriceEn;
    this.toValueFlag = rate.flag;
    this.toValueAvgPrice = rate.avgPrice;
  }

  getTodayExchangeRate() {
    let self = this;
    this.exchangeRatesService.todayRates().subscribe(res => {
      res.data.forEach(element => {
        self.rates.push(new Rate(
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

      self.rates.push(this.exchangeRatesService.getMacedonianDenarRate());

    }, error => {
      alert("No rates for today.");
    });
  }

  calculateValue(value: number) {
    let from = this.fromValueAvgPrice;
    let to = this.toValueAvgPrice;
    this.money = value;
    this.calcValue = ((from / to) * this.money).toFixed(2);
  }

  switchValues() {

    let tmpValue = this.fromValue;
    let tmpFromValueFlag = this.fromValueFlag;
    let tmpFromValueAvgPrice = this.fromValueAvgPrice;

    this.fromValue = this.toValue;
    this.fromValueFlag = this.toValueFlag;
    this.fromValueAvgPrice = this.toValueAvgPrice;

    this.toValue = tmpValue;
    this.toValueFlag = tmpFromValueFlag;
    this.toValueAvgPrice = tmpFromValueAvgPrice;

    this.calculateValue(this.money);
  }

}
