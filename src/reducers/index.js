import { combineReducers } from "redux";
import { routerReducer } from "react-router-redux";

import UserReducer from './UserReducer';
import eventReducer from './eventReducer';

// main reducers
export const reducers = combineReducers({
  routing: routerReducer,
  userSelectors: UserReducer,
  eventSelectors: eventReducer
});
