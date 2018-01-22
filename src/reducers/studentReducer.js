import {
    ADD_OR_STORE_STUDENT_SUCCESS,
    ADD_OR_STORE_STUDENT_ERROR,
    GET_STUDENTS_SUCCESS,
    GET_STUDENTS_ERROR,
    GET_STUDENT_ERROR,
    GET_STUDENT_SUCCESS,
    UPDATE_STUDENT_SUCCESS,
    UPDATE_STUDENT_ERROR,
    ADD_OR_STORE_STUDENT
} from '../actions/student';

const INITIAL_STATE = {
    error: null,
    students: null,
    student: null,
    addOrStorePending: false
};

export default function( state = INITIAL_STATE, action ) {
    switch (action.type) {
        case GET_STUDENTS_SUCCESS:
            return {
                ...state,
                students: action.students
            }
        case GET_STUDENTS_ERROR:
            return {
                ...state,
                error: action.error
            }
        case ADD_OR_STORE_STUDENT:
            return {
                ...state,
                addOrStorePending: action.pending
            }
        case ADD_OR_STORE_STUDENT_SUCCESS:
            return {
                ...state,
                addOrStorePending: action.pending
            }
        case ADD_OR_STORE_STUDENT_ERROR:
            return {
                ...state,
                error: action.error,
                addOrStorePending: action.pending
            }
        case GET_STUDENT_SUCCESS:
            return {
                ...state,
                student: action.student
            }
        case GET_STUDENT_ERROR:
            return {
                ...state,
                error: action.error
            }
        case UPDATE_STUDENT_SUCCESS:
            return {
                ...state,
                student: action.student
            }
        case UPDATE_STUDENT_ERROR:
            return {
                ...state,
                error: action.error
            }
        default:
            return state;
    }
}
