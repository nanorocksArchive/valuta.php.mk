import { Fragment } from "react";
import About from "./About";
import ContactUs from "./ContactUs";
import List from "./List";
import History   from "./History";

const Home = () => {
    return (
      <Fragment>
        <section>
          <div
            id="main_slider"
            class="section carousel slide banner-main"
            data-ride="carousel"
          >
            <ol class="carousel-indicators">
              <li
                data-target="#main_slider"
                data-slide-to="0"
                class="active"
              ></li>
              <li data-target="#main_slider" data-slide-to="1"></li>
              <li data-target="#main_slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="container">
                  <div class="row marginii">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                      <div class="carousel-caption ">
                        <h1>
                          Welcome to <strong class="color">Our Shop</strong>
                        </h1>
                        <p>
                          There are many variations of passages of Lorem Ipsum
                          available, but the majority have suffered alteration
                          in some form, by injected humour
                        </p>
                        <a
                          class="btn btn-lg btn-primary"
                          href="#"
                          role="button"
                        >
                          Buy Now
                        </a>
                        <a
                          class="btn btn-lg btn-primary"
                          href="about.html"
                          role="button"
                        >
                          About{" "}
                        </a>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                      <div class="img-box">
                        <figure>
                          <img src="images/boksing-gloves.png" alt="img" />
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container">
                  <div class="row marginii">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                      <div class="carousel-caption ">
                        <h1>
                          Welcome to <strong class="color">Our Shop</strong>
                        </h1>
                        <p>
                          There are many variations of passages of Lorem Ipsum
                          available, but the majority have suffered alteration
                          in some form, by injected humour
                        </p>
                        <a
                          class="btn btn-lg btn-primary"
                          href="#"
                          role="button"
                        >
                          Buy Now
                        </a>
                        <a
                          class="btn btn-lg btn-primary"
                          href="about.html"
                          role="button"
                        >
                          About
                        </a>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                      <div class="img-box ">
                        <figure>
                          <img src="images/boksing-gloves.png" alt="img" />
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container">
                  <div class="row marginii">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                      <div class="carousel-caption ">
                        <h1>
                          Welcome to <strong class="color">Our Shop</strong>
                        </h1>
                        <p>
                          There are many variations of passages of Lorem Ipsum
                          available, but the majority have suffered alteration
                          in some form, by injected humour
                        </p>
                        <a
                          class="btn btn-lg btn-primary"
                          href="#"
                          role="button"
                        >
                          Buy Now
                        </a>
                        <a
                          class="btn btn-lg btn-primary"
                          href="about.html"
                          role="button"
                        >
                          About
                        </a>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                      <div class="img-box">
                        <figure>
                          <img src="images/boksing-gloves.png" alt="img" />
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a
              class="carousel-control-prev"
              href="#main_slider"
              role="button"
              data-slide="prev"
            >
              <i class="fa fa-angle-left"></i>
            </a>
            <a
              class="carousel-control-next"
              href="#main_slider"
              role="button"
              data-slide="next"
            >
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </section>
        <List></List>
        <About></About>
        <History></History>
        <ContactUs></ContactUs>
      </Fragment>
    );
}

export default Home;