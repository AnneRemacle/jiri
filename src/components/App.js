import React from "react";
import "../stylesheets/main.scss";

import Header from './Header';

// app component
export default class App extends React.Component {
  // render
  render() {
    let hide = false, {pathname} = this.props.location;

    if(pathname === "/login"){
        hide = true;
    }

    return (
        <div className="container">
            <Header hide={hide} />
            {this.props.children}
        </div>
    );
  }
}
