import React from "react";
import { Router, Route, IndexRoute } from "react-router";
import { history } from "./store.js";

import App from "./components/App";
import Login from "./components/Login";
import Dashboard from "./components/Dashboard";
import CreateEvent from './components/CreateEvent';
import UserEvents from './components/UserEvents';
import EditEvent from './components/EditEvent';

// build the router
const router = (
  <Router onUpdate={() => window.scrollTo(0, 0)} history={history}>
    <Route path="/" component={App}>
        <IndexRoute component={Dashboard}/>
        <Route path="/login" component={Login} />
        <Route path="/createEvent" component={CreateEvent} />
        <Route path="/my/events" component={UserEvents} />
        <Route path="/editEvent/:id" component={EditEvent} />
    </Route>
  </Router>
);

// export
export { router };
