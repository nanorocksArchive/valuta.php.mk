import { Fragment } from "react";
import { Link } from "react-router-dom";

const Header = () => {
  return (
    <>
      <div className="loader_bg">
        <div className="loader">
          <img src="images/loading.gif" alt="#" />
        </div>
      </div>
      <header className="section">
        <div className="header_main">
          <div className="header_main">
            <div className="container">
              <div className="row">
                <div className="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div className="full">
                    <div className="center-desk">
                      <div className="logo">
                        {" "}
                        <a href="index.html">
                          <img src="images/logo.png" alt="#" />
                        </a>{" "}
                      </div>
                    </div>
                  </div>
                </div>
                <div className="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                  <div className="menu-area">
                    <div className="limit-box">
                      <nav className="main-menu">
                        <ul className="menu-area-main">
                          <li>
                            <Link to="/">Home</Link>
                          </li>
                          <li>
                            <Link to="/about">About</Link>
                          </li>
                          <li>
                            <Link to="/converter">Converter</Link>
                          </li>
                          <li>
                            <Link to="/history">History</Link>
                          </li>
                          <li>
                            <Link to="/list">List</Link>
                          </li>
                          <li>
                            <Link to="/contact-us">Contact Us</Link>
                          </li>
                          <li className="last">
                            <a href="#">
                              <img src="images/search_icon.png" alt="icon" />
                            </a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
    </>
  );
};

export default Header;
