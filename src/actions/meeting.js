import axios from 'axios';
import {history} from "../store";
import {ROOT_URL} from "../config/constants";

import * as studentActions from "./student";
import * as meetingActions from "./meeting";

export const
    CREATE_MEETING = 'CREATE_MEETING',
    CREATE_MEETING_SUCCESS = 'CREATE_MEETING_SUCCESS',
    CREATE_MEETING_ERROR = 'CREATE_MEETING_ERROR',
    GET_MEETING_SUCCESS = 'GET_MEETING_SUCCESS',
    GET_MEETING_ERROR = 'GET_MEETINGS_ERROR',
    UPDATE_SCORES_SUCCESS = 'UPDATE_SCORES_SUCCESS',
    UPDATE_SCORES_ERROR = 'UPDATE_SCORES_ERROR';


export function createMeeting( user_id, event_id, student_id ) {
    const request = axios.post( `${ROOT_URL}/meetings/create`,{
        user_id: user_id,
        event_id: event_id,
        student_id: student_id
    } );

    return ( dispatch ) => {
        request.then( (response) => {
            dispatch({
                type: CREATE_MEETING_SUCCESS,
            })
            console.warn(response.data);
            history.push(`/editMeeting/${response.data}`);
        } ).catch( (errors) => {
            dispatch({
                type: CREATE_MEETING_ERROR,
                errors: errors
            })
        } )
    }
}

export function getMeeting(meeting_id) {
    const request = axios.get(`${ROOT_URL}/meetings/${meeting_id}/show`);

    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: GET_MEETING_SUCCESS,
                meeting: response.data
            })
        } ).catch( (errors) => {
            dispatch({
                type: GET_MEETING_ERROR,
                errors: errors
            })
        } )
    }
}

export function updateScores(data, general_evaluation, meeting_id, event_id, student_id) {
    const request = axios.post(`${ROOT_URL}/meetings/${meeting_id}/updateScores`, {
        data: JSON.stringify(data),
        general_evaluation: general_evaluation
    });

    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: UPDATE_SCORES_SUCCESS,
            })
            dispatch( studentActions.getImplementations(event_id, student_id, meeting_id))
            dispatch( meetingActions.getMeeting(meeting_id))
        } ).catch( (errors) => {
            dispatch({
                type: UPDATE_SCORES_ERROR,
                errors: errors
            })
        } )
    }
}
