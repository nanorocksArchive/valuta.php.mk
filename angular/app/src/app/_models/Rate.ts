export class Rate {
  date: string;
  flag: string;
  sellerPrice: number;
  avgPrice: number;
  customerPrice: number;
  validId: number;
  one: any;
  contryMk: string;
  contryEn: string;
  contryPriceMk: string;
  contryPriceEn: string;

  constructor(
    date: string,
    flag: string,
    sellerPrice: number,
    avgPrice: number,
    customerPrice: number,
    validId: number,
    one: any,
    contryMk: string,
    contryEn: string,
    contryPriceEn: string,
    contryPriceMk: string
  ) {

    this.date = date;
    this.flag = flag;
    this.sellerPrice = sellerPrice;
    this.avgPrice = avgPrice;
    this.customerPrice = customerPrice;
    this.validId = validId;
    this.one = one;
    this.contryMk = contryMk;
    this.contryEn = contryEn;
    this.contryPriceEn = contryPriceEn;
    this.contryPriceMk = contryPriceMk;
  }
}
