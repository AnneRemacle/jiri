import React from "react";
import { Router, Route, IndexRoute } from "react-router";
import { history } from "./store.js";

import App from "./components/App";
import Login from "./components/Login";
import Dashboard from "./components/Dashboard"

// build the router
const router = (
  <Router onUpdate={() => window.scrollTo(0, 0)} history={history}>
    <Route path="/" component={App}>
        <IndexRoute component={Dashboard}/>
        <Route path="/login" component={Login} />
    </Route>
  </Router>
);

// export
export { router };
