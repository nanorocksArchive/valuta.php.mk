import "./App.css";
import About from "./pages/About";
import Home from "./pages/Home";
import Converter from "./pages/Converter";
import History from "./pages/History";
import List from "./pages/List";
import NoMatch from "./pages/NoMatch";
import React from "react";
import Footer from "./layout/Footer";
import Header from "./layout/Header";
import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";
import ContactUs from "./pages/ContactUs";

function App() {
  return (
    <Router>
      <Header></Header>
      <Switch>
        <Route exact path="/">
          <Home></Home>
        </Route>
        <Route path="/about">
          <About></About>
        </Route>
        <Route path="/converter">
          <Converter></Converter>
        </Route>
        <Route path="/history">
          <History></History>
        </Route>
        <Route path="/list">
          <List></List>
        </Route>
        <Route path="/contact-us">
          <ContactUs></ContactUs>
        </Route>
        <Route path="*">
          <NoMatch />
        </Route>
      </Switch>
      <Footer></Footer>
    </Router>
  );
}

export default App;
