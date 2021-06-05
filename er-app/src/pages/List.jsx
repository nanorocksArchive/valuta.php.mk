import { Fragment } from "react";

const List = () => {
  return (
    <Fragment>
      <div id="plant" className="section  product">
        <div className="container">
          <div className="row">
            <div className="col-md-12 ">
              <div className="titlepage">
                <h2><strong className="black"> Our</strong>  List</h2>
                <span>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected randomised words which don't look even slightly believable</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="clothes_main section ">
        <div className="container">
          <div className="row">

            <div className="col-xl-4 col-lg-4 col-md-6 col-sm-12">
              <div className="sport_product">
                <figure><img src="images/basketball.png" alt="img" /></figure>
                <h3> $<strong className="price_text">50</strong></h3>
                <h4>basket ball</h4>
              </div>
            </div>

            <div className="col-xl-4 col-lg-4 col-md-6 col-sm-12 ">
              <div className="sport_product">
                <figure><img src="images/t-shirt.png" alt="img" /></figure>
                <h3> $<strong className="price_text">50</strong></h3>
                <h4> T-Shirt</h4>
              </div>
            </div>

            <div className="col-xl-4 col-lg-4 col-md-6 col-sm-12 ">
              <div className="sport_product">
                <figure><img src="images/game.png" alt="img" /></figure>
                <h3> $<strong className="price_text">50</strong></h3>
                <h4>Game</h4>
              </div>
            </div>

          </div>
        </div>
      </div>
    </Fragment>
  );
};

export default List;
