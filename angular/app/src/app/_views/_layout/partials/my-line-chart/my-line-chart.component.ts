import { Component, Input, OnChanges} from '@angular/core';
import { ChartDataSets, ChartOptions, ChartType } from 'chart.js';
import { Color, Label } from 'ng2-charts';
import { Rate } from 'src/app/_models/Rate';
import { ThrowStmt } from '@angular/compiler';

@Component({
  selector: 'app-my-line-chart',
  templateUrl: './my-line-chart.component.html'
})

export class MyLineChartComponent implements OnChanges {

  @Input() dates = [];

  @Input() selectedRates: Rate[] | null;

  @Input() selectedRatesValue: string;

  public lineChartLegend;
  public lineChartType: ChartType;
  public lineChartPlugins = [];
  public lineChartColors: Color[] = [];
  public lineChartOptions: ChartOptions = { responsive: true };
  public lineChartLabels: any[] = [];
  public lineChartData: ChartDataSets[] = [];

  ngOnChanges()
  {
    //console.log(this.dates, this.selectedRates);
    this.reload();
  }

  reload()
  {
    this.lineChartLegend = true;
    this.lineChartType = 'line';
    this.lineChartPlugins = [];

    this.lineChartColors = [
      {
        borderColor: 'black',
        backgroundColor: this.randomRgba(),
      },
    ];

    this.lineChartOptions = { responsive: true };
    this.lineChartLabels = (this.dates) ? this.dates : [];

    let rates = [];

    this.selectedRates.forEach(element => {
      rates.push(element.avgPrice);
    });

    this.lineChartData = [
      {
        data: rates,
        label: this.selectedRatesValue
      },
    ];

  }

  randomRgba() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',' + 0.5 + ')';
  }

}
