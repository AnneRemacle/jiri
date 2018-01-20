import { createStore, applyMiddleware, compose } from "redux";
import { hashHistory } from "react-router";
import { syncHistoryWithStore, routerMiddleware } from "react-router-redux";
import thunk from 'redux-thunk';
import freeze from "redux-freeze";
import { reducers } from "./reducers/index";
import promise from 'redux-promise';

// add the middlewares
let middlewares = [];

// add the router middleware
middlewares.push(routerMiddleware(hashHistory));

// add the freeze dev middleware
if (process.env.NODE_ENV !== 'production') {
  middlewares.push(freeze);
}

// apply the middleware
let middleware = applyMiddleware(...middlewares);

// add the redux dev tools
if (process.env.NODE_ENV !== 'production' && window.devToolsExtension) {
  middleware = compose(middleware, window.devToolsExtension());
}

// create the store
const store = createStore(reducers, middleware, applyMiddleware(thunk, promise));
const history = syncHistoryWithStore(hashHistory, store);

// export
export { store, history };
