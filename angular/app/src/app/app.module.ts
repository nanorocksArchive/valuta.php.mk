import { BrowserModule } from '@angular/platform-browser';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {
  AboutComponent,
  HistoryComponent,
  ConvertComponent,
  ListComponent,
  NavComponent,
  TableComponent,
  DropdownComponent,
  InputComponent,
  MyLineChartComponent
} from './_views/index';

import { ChartsModule } from 'ng2-charts';
import { NgxSpinnerModule } from "ngx-spinner";

@NgModule({
  declarations: [
    AppComponent,
    AboutComponent,
    HistoryComponent,
    ConvertComponent,
    ListComponent,
    NavComponent,
    TableComponent,
    DropdownComponent,
    InputComponent,
    MyLineChartComponent
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    AppRoutingModule,
    HttpClientModule,
    ChartsModule,
    NgxSpinnerModule
  ],
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
