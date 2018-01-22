import React from "react";
import { Router, Route, IndexRoute } from "react-router";
import { history } from "./store.js";

import App from "./components/App";
import Login from "./components/Login";
import Dashboard from "./components/Dashboard";
import CreateEvent from './components/CreateEvent';
import UserEvents from './components/UserEvents';
import EditEvent from './components/EditEvent';
import ShowEvent from './components/ShowEvent';
import AddProject from './components/AddProject';
import EditProject from './components/EditProject';
import AddStudent from './components/AddStudent';
import EditStudent from './components/EditStudent';
import AddJury from './components/AddJury';
import EditJury from './components/EditJury';
import ManageStudent from './components/ManageStudent';

// build the router
const router = (
  <Router onUpdate={() => window.scrollTo(0, 0)} history={history}>
    <Route path="/" component={App}>
        <IndexRoute component={Dashboard}/>
        <Route path="/login" component={Login} />
        <Route path="/createEvent" component={CreateEvent} />
        <Route path="/my/events" component={UserEvents} />
        <Route path="/editEvent/:id" component={EditEvent} />
        <Route path="/showEvent/:id" component={ShowEvent} />
        <Route path="/event/:id/manageProjects" component={AddProject} />
        <Route path="/event/:id/manageStudents" component={AddStudent} />
        <Route path="/event/:event_id/manageStudent/:student_id" component={ManageStudent} />
        <Route path="/event/:id/manageJurys" component={AddJury} />
        <Route path="/project/:id/edit" component={EditProject} />
        <Route path="/student/:id/edit" component={EditStudent} />
        <Route path="/jury/:id/edit" component={EditJury} />
    </Route>
  </Router>
);

// export
export { router };
