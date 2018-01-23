import axios from 'axios';
import {history} from '../store'
import * as eventActions from './event';

export const
    GET_PROJECTS_SUCCESS = 'GET_PROJECTS_SUCCESS',
    GET_PROJECTS_ERROR = 'GET_PROJECTS_ERROR',
    ADD_OR_STORE_PROJECTS_SUCCESS = 'ADD_OR_STORE_PROJECTS_SUCCESS',
    ADD_OR_STORE_PROJECTS_ERROR = 'ADD_OR_STORE_PROJECTS_ERROR',
    UPDATE_PROJECT_SUCCESS = 'UPDATE_PROJECT_SUCCESS',
    UPDATE_PROJECT_ERROR = 'UPDATE_PROJECT_ERROR',
    GET_PROJECT_SUCCESS = 'GET_PROJECT_SUCCESS',
    GET_PROJECT_ERROR = 'GET_PROJECT_ERROR';

const ROOT_URL = 'http://jiri-api.anne-remacle.be/api';

export function getProjects() {
    const request = axios.get( `${ROOT_URL}/projects`);
    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: GET_PROJECTS_SUCCESS,
                projects: response.data,
            })
        } ).catch( (errors) => {
            dispatch({
                type: GET_PROJECTS_ERROR,
                errors: errors,
            })
        })
    };
}

export function addOrStore(name, description, event_id, user_id) {
    const request = axios.post(`${ROOT_URL}/projects/addOrStore`, {
        name: name,
        description: description,
        event_id: event_id,
        user_id: user_id
    });

    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: ADD_OR_STORE_PROJECTS_SUCCESS,
            })
            dispatch(eventActions.getEventProjects(event_id))
        } ).catch( (errors) => {
            dispatch({
                type: ADD_OR_STORE_PROJECTS_ERROR,
                errors: errors,
            })
        })
    };
}

export function updateProject(name, description, project_id, event_id, user_id) {
    const request = axios.post(`${ROOT_URL}/projects/${project_id}/update`, {
        name: name,
        description: description,
        event_id: event_id,
        user_id: user_id
    });

    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: UPDATE_PROJECT_SUCCESS,
            })
            history.goBack()
        } ).catch( (errors) => {
            dispatch({
                type: UPDATE_PROJECT_ERROR,
                errors: errors,
            })
        })
    };
}

export function getProject(project_id) {
    const request = axios.get( `${ROOT_URL}/projects/${project_id}`);
    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: GET_PROJECT_SUCCESS,
                project: response.data,
            })
        } ).catch( (errors) => {
            dispatch({
                type: GET_PROJECT_ERROR,
                errors: errors,
            })
        })
    };
}
