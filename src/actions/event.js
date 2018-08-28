import axios from 'axios';
import * as userActions from "./user";
import {history} from "../store";
import {ROOT_URL} from "../config/constants";

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
    REMOVE_PROJECT_ERROR = 'REMOVE_PROJECT_ERROR',
    GET_EVENT_STUDENTS_SUCCESS = 'GET_EVENT_STUDENTS_SUCCESS',
    GET_EVENT_STUDENTS_ERROR = 'GET_EVENT_STUDENTS_ERROR',
    REMOVE_STUDENT_SUCCESS = 'REMOVE_STUDENT_SUCCESS',
    REMOVE_STUDENT_ERROR = 'REMOVE_STUDENT_ERROR',
    GET_EVENT_JURYS_SUCCESS = 'GET_EVENT_JURYS_SUCCESS',
    GET_EVENT_JURYS_ERROR = 'GET_EVENT_JURYS_ERROR',
    REMOVE_JURY_SUCCESS = 'REMOVE_JURY_SUCCESS',
    REMOVE_JURY_ERROR = 'REMOVE_JURY_ERROR',
    GET_CURRENT_EVENT = 'GET_CURRENT_EVENT',
    GET_CURRENT_EVENT_SUCCESS = 'GET_CURRENT_EVENT_SUCCESS',
    GET_CURRENT_EVENT_ERROR = 'GET_CURRENT_EVENT_ERROR';

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
            history.push(`/showEvent/${response.data}`)
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

export function getEventStudents(event_id){
    const request = axios.get(`${ROOT_URL}/events/${event_id}/students`);

    return (dispatch) => {
        request.then((response) => {
            dispatch({
                type: GET_EVENT_STUDENTS_SUCCESS,
                students: response.data
            })
        }).catch((errors) => {
            dispatch({
                type: GET_EVENT_STUDENTS_ERROR,
                error: errors
            })
        })
    }
}

export function removeStudent( event_id, student_id ) {
    const request = axios.get( `${ROOT_URL}/events/${event_id}/removeStudent/${student_id}` );

    return (dispatch) => {
        request.then((response) => {
            dispatch({
                type: REMOVE_STUDENT_SUCCESS,
                student: response.data
            })
            dispatch(getEventStudents(event_id))
        }).catch((errors) => {
            dispatch({
                type: REMOVE_STUDENT_ERROR,
                error: errors
            })
        })
    }
}

export function getEventJurys(event_id){
    const request = axios.get(`${ROOT_URL}/events/${event_id}/jurys`);

    return (dispatch) => {
        request.then((response) => {
            dispatch({
                type: GET_EVENT_JURYS_SUCCESS,
                jurys: response.data
            })
        }).catch((errors) => {
            dispatch({
                type: GET_EVENT_JURYS_ERROR,
                error: errors
            })
        })
    }
}

export function removeJury( event_id, user_id ) {
    const request = axios.get( `${ROOT_URL}/events/${event_id}/removeJury/${user_id}` );

    return (dispatch) => {
        request.then((response) => {
            dispatch({
                type: REMOVE_JURY_SUCCESS,
                jury: response.data
            })
            dispatch(getEventJurys(event_id))
        }).catch((errors) => {
            dispatch({
                type: REMOVE_JURY_ERROR,
                error: errors
            })
        })
    }
}

export function getCurrentEvent() {
    const request = axios.get( `${ROOT_URL}/events/currentEvent` );

    return (dispatch) => {
        dispatch({
            type: GET_CURRENT_EVENT,
        })

        request.then((response) => {
            dispatch({
                type: GET_CURRENT_EVENT_SUCCESS,
                currentEvent: response.data,
            })
            dispatch(getEventJurys(event_id))
        }).catch((errors) => {
            dispatch({
                type: GET_CURRENT_EVENT_ERROR,
                error: errors,
            })
        })
    }
}
