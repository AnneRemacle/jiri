import { combineReducers } from "redux";
import { routerReducer } from "react-router-redux";

import UserReducer from './UserReducer';

// main reducers
export const reducers = combineReducers({
  routing: routerReducer,
  userSelectors: UserReducer
});
