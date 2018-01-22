import axios from 'axios';
import {history} from '../store';
import * as eventActions from "./event";

export const
    ADD_OR_STORE_STUDENT = 'ADD_OR_STORE_STUDENT',
    ADD_OR_STORE_STUDENT_SUCCESS = 'ADD_OR_STORE_STUDENT_SUCCESS',
    ADD_OR_STORE_STUDENT_ERROR = 'ADD_OR_STORE_STUDENT_ERROR',
    GET_STUDENTS_SUCCESS = 'GET_STUDENTS_SUCCESS',
    GET_STUDENTS_ERROR = 'GET_STUDENTS_ERROR',
    GET_STUDENT_SUCCESS = 'GET_STUDENT_SUCCESS',
    GET_STUDENT_ERROR = 'GET_STUDENT_ERROR',
    UPDATE_STUDENT_SUCCESS = 'UPDATE_STUDENT_SUCCESS',
    UPDATE_STUDENT_ERROR = 'UPDATE_STUDENT_ERROR';

const ROOT_URL = 'http://localhost:8000/api';

export function addOrStore(data, event_id) {
    const request = axios.post(`${ROOT_URL}/students/addOrStore`, data, {headers: { 'content-type': 'multipart/form-data' }});

    return (dispatch) => {
        dispatch({
            type: ADD_OR_STORE_STUDENT,
            pending: true,
        })

        request.then( (response) => {
            dispatch({
                type: ADD_OR_STORE_STUDENT_SUCCESS,
            })
            dispatch(eventActions.getEventStudents(data.get("event_id")))
        } ).catch( (errors) => {
            dispatch({
                type: ADD_OR_STORE_STUDENT_ERROR,
                errors: errors,
            })
        })
    };
}

export function updateStudent(data, student_id) {
    const request = axios.post(`${ROOT_URL}/students/${student_id}/update`, data, {headers: { 'content-type': 'multipart/form-data' }});

    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: UPDATE_STUDENT_SUCCESS,
            })
            history.goBack()
        } ).catch( (errors) => {
            dispatch({
                type: UPDATE_STUDENT_SUCCESS,
                errors: errors,
            })
        })
    };
}

export function getStudents() {
    const request = axios.get( `${ROOT_URL}/students` );

    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: GET_STUDENTS_SUCCESS,
                students: response.data
            })
        }).catch( (errors) => {
            dispatch({
                type: GET_STUDENTS_ERROR,
                errors: errors
            })
        } )
    }
}

export function getStudent(student_id) {
    const request = axios.get( `${ROOT_URL}/students/${student_id}`);
    return (dispatch) => {
        request.then( (response) => {
            dispatch({
                type: GET_STUDENT_SUCCESS,
                student: response.data,
            })
        } ).catch( (errors) => {
            dispatch({
                type: GET_STUDENT_ERROR,
                errors: errors,
            })
        })
    };
}
