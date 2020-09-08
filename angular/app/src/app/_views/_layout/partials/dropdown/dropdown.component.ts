import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { Rate } from 'src/app/_models/Rate';

@Component({
  selector: 'app-dropdown',
  templateUrl: './dropdown.component.html',
  styleUrls: ['./dropdown.component.css']
})
export class DropdownComponent implements OnInit {

  @Input() title: string;

  @Input() rates: Rate[];

  @Output() newItemEvent = new EventEmitter<Rate>();

  constructor() { }

  ngOnInit() {
  }

  selectedRate(rate: Rate)
  {
    this.newItemEvent.emit(rate);
  }


}
