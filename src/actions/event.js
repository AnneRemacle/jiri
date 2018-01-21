import axios from 'axios';
import * as userActions from "./user";

export const
    CREATE_EVENT = 'CREATE_EVENT',
    CREATE_EVENT_SUCCESS = 'CREATE_EVENT_SUCCESS',
    CREATE_EVENT_ERROR = 'CREATE_EVENT_ERROR',
    GET_EVENT_ERROR = 'GET_EVENT_ERROR',
    GET_EVENT_SUCCESS = 'GET_EVENT_SUCCESS',
    UPDATE_EVENT_SUCCESS = 'UPDATE_EVENT_SUCCESS',
    UPDATE_EVENT_ERROR = 'UPDATE_EVENT_ERROR',
    DELETE_EVENT_SUCCESS = 'DELETE_EVENT_SUCCESS',
    DELETE_EVENT_ERROR = 'DELETE_EVENT_ERROR',
    GET_EVENT_PROJECTS_SUCCESS = 'GET_EVENT_PROJECTS_SUCCESS',
    GET_EVENT_PROJECTS_ERROR = 'GET_EVENT_PROJECTS_ERROR',
    REMOVE_PROJECT_SUCCESS = 'REMOVE_PROJECT_SUCCESS',
    REMOVE_PROJECT_ERROR = 'REMOVE_PROJECT_ERROR';

const ROOT_URL = 'http://localhost:8000/api';

export function createEvent(name, academic_year, session, user_id) {
    const request = axios.post( `${ROOT_URL}/events/store`, {
        name: name,
        academic_year: academic_year,
        session: session,
        user_id : user_id
    });

    return (dispatch) => {
        dispatch({
            type: CREATE_EVENT,
            createEventPending: true
        })

        request.then( (response) => {
            dispatch({
                    type: CREATE_EVENT_SUCCESS,
                    event: response.data,
                    createEventPending: false
            })
        } ).catch( (errors) => {
            dispatch({
                type: CREATE_EVENT_ERROR,
                errors: errors,
                createEventPending: false
            })
        })
    };
}

export function getEvent(event_id){
    const request = axios.get(`${ROOT_URL}/events/${event_id}/show`);

    return (dispatch) => {
        request.then((response) => {
            dispatch({
                type: GET_EVENT_SUCCESS,
                event: response.data,
            })
        }).catch( (errors) => {
            dispatch({
                type: GET_EVENT_ERROR,
                error: errors
            })
        })
    }
}

export function updateEvent(course_name, academic_year, exam_session, event_id, user_id){
    const request = axios.post(`${ROOT_URL}/events/${event_id}/update`, {
        course_name: course_name,
        academic_year: academic_year,
        exam_session: exam_session,
        user_id: user_id
    });

    return (dispatch) => {
        request.then((response) => {
            dispatch({
                type: UPDATE_EVENT_SUCCESS,
            })
            dispatch(userActions.getUserEvents(user_id))
            dispatch(getEvent(event_id))
        }).catch((errors) => {
            dispatch({
                type: UPDATE_EVENT_ERROR,
                error: errors
            })
        })
    }
}

export function deleteEvent(event_id, user_id){
    const request = axios.post(`${ROOT_URL}/events/${event_id}/delete`, {
        user_id: user_id
    });

    return (dispatch) => {
        request.then((response) => {
            dispatch({
                type: DELETE_EVENT_SUCCESS,
            })
            dispatch(userActions.getUserEvents(user_id))
        }).catch((errors) => {
            dispatch({
                type: DELETE_EVENT_ERROR,
                error: errors
            })
        })
    }
}

export function getEventProjects(event_id){
    const request = axios.get(`${ROOT_URL}/events/${event_id}/projects`);

    return (dispatch) => {
        request.then((response) => {
            dispatch({
                type: GET_EVENT_PROJECTS_SUCCESS,
                projects: response.data
            })
        }).catch((errors) => {
            dispatch({
                type: GET_EVENT_PROJECTS_ERROR,
                error: errors
            })
        })
    }
}

export function removeProject( event_id, project_id ) {
    const request = axios.get( `${ROOT_URL}/events/${event_id}/removeProject/${project_id}` );

    return (dispatch) => {
        request.then((response) => {
            dispatch({
                type: REMOVE_PROJECT_SUCCESS,
                projects: response.data
            })
            dispatch(getEventProjects(event_id))
        }).catch((errors) => {
            dispatch({
                type: REMOVE_PROJECT_ERROR,
                error: errors
            })
        })
    }
}
