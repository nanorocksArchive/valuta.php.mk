import { Component, Input } from '@angular/core';
import { Rate } from 'src/app/_models/Rate';

@Component({
  selector: 'app-table',
  templateUrl: './table.component.html',
})
export class TableComponent {

  @Input() rates: Rate[];

  tableColumns: string[] = ['Contry', 'Money mark', 'Customer Price', 'Seller Price', 'Average Price'];

}
