import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import {
  AboutComponent,
  ListComponent,
  ConvertComponent,
  HistoryComponent
} from './_views/index';

const routes: Routes = [
  { path: '', redirectTo: '/about', pathMatch: 'full' },
  { path: 'about', component: AboutComponent },
  { path: 'list', component: ListComponent },
  { path: 'convert', component: ConvertComponent },
  { path: 'history', component: HistoryComponent },
];


@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
