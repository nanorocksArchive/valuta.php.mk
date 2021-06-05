import { Fragment } from "react";

const History = () => {
  return (
    <Fragment>
      <div id="plant" className="section_Clients layout_padding padding_bottom_0">
        <div className="container">
          <div className="row">
            <div className="col-md-12 ">
              <div className="titlepage">
                <h2> History</h2>
                <span className="text-center">available, but the majority have suffered alteration in some form, by injected randomised words which don't look even slightly believable</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="section Clients_2 layout_padding padding-top_0">
        <div className="container">
          <div className="row">
            <div className="col-sm-12">

              <div id="testimonial" className="carousel slide" data-ride="carousel">

                <ul className="carousel-indicators">
                  <li data-target="#testimonial" data-slide-to="0" className="active"></li>
                  <li data-target="#testimonial" data-slide-to="1"></li>
                  <li data-target="#testimonial" data-slide-to="2"></li>
                </ul>

                <div className="carousel-inner">
                  <div className="carousel-item active">
                    <div className="titlepage">
                      <div className="john">
                        <div className="john_image"><img src="images/john-image.png" classNameName="mw-100" /></div>
                        <div className="john_text">JOHN DUE<span classNameName="john-color-text">(ceo)</span></div>
                        <p className="lorem_ipsum_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, asIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as </p>
                        <div className="icon_image"><img src="images/icon-1.png" /></div>
                      </div>
                    </div>
                  </div>
                  <div className="carousel-item">
                    <div className="titlepage">
                      <div className="john">
                        <div className="john_image"><img src="images/john-image.png" classNameName="mw-100" /></div>
                        <div className="john_text">JOHN DUE<span classNameName="john-color-text">(ceo)</span></div>
                        <p className="lorem_ipsum_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, asIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as </p>
                        <div className="icon_image"><img src="images/icon-1.png" /></div>
                      </div>
                    </div>
                  </div>
                  <div className="carousel-item">
                    <div className="titlepage">
                      <div className="john">
                        <div className="john_image"><img src="images/john-image.png" classNameName="mw-100" /></div>
                        <div className="john_text">JOHN DUE<span classNameName="john-color-text">(ceo)</span></div>
                        <p className="lorem_ipsum_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, asIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as </p>
                        <div className="icon_image"><img src="images/icon-1.png" /></div>
                      </div>
                    </div>
                  </div>
                </div>
                <a className="carousel-control-prev" href="#testimonial" data-slide="prev">
                  <span className="carousel-control-prev-icon"></span>
                </a>
                <a className="carousel-control-next" href="#testimonial" data-slide="next">
                  <span className="carousel-control-next-icon"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Fragment >
  );
};

export default History;
