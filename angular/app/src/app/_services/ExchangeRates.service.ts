import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from "@angular/common/http";
import { Observable } from 'rxjs';
import { Rate } from '../_models/Rate';

@Injectable({
  providedIn: 'root'
})
export class ExchangeRatesService {

  constructor(private http: HttpClient) { }

  todayRates(): Observable<any>{
    let url = 'https://api.php.mk/nbrm/v1.0/?token=c40b5ab8a3b190ac6c40aaef3df88717';
    return this.http.get<any>(url);
  }

  historyRates(): Observable<any> {
    let url = 'https://valuta.php.mk/service/endpoint/';
    return this.http.get<any>(url);
  }

  getMacedonianDenarRate(): Rate
  {
    return new Rate(
      "",
      "MKD",
      1,
      1,
      1,
      1,
      "1",
      "MK",
      "MKD",
      "Macedonian denar",
      "македонски денар",
    );
  }

}
