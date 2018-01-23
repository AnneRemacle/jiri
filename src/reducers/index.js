import { combineReducers } from "redux";
import { routerReducer } from "react-router-redux";

import userReducer from './userReducer';
import eventReducer from './eventReducer';
import projectReducer from './projectReducer';
import studentReducer from './studentReducer';
import meetingReducer from './meetingReducer';

// main reducers
export const reducers = combineReducers({
  routing: routerReducer,
  userSelectors: userReducer,
  eventSelectors: eventReducer,
  projectSelectors: projectReducer,
  studentSelectors: studentReducer,
  meetingSelectors: meetingReducer
});
