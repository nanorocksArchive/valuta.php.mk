import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-input',
  templateUrl: './input.component.html'
})
export class InputComponent implements OnInit {

  @Input() disabled: string;

  @Input() type: string;

  @Output() newItemEvent = new EventEmitter<number>();

  constructor() { }

  ngOnInit() {
  }

  getRateValue(event)
  {
    this.newItemEvent.emit(event.target.value);
  }

}
