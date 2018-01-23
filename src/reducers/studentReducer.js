import {
    ADD_OR_STORE_STUDENT_SUCCESS,
    ADD_OR_STORE_STUDENT_ERROR,
    GET_STUDENTS_SUCCESS,
    GET_STUDENTS_ERROR,
    GET_STUDENT,
    GET_STUDENT_ERROR,
    GET_STUDENT_SUCCESS,
    UPDATE_STUDENT_SUCCESS,
    UPDATE_STUDENT_ERROR,
    ADD_OR_STORE_STUDENT,
    GET_IMPLEMENTATIONS_ERROR,
    GET_IMPLEMENTATIONS_SUCCESS
} from '../actions/student';

const INITIAL_STATE = {
    error: null,
    students: null,
    student: null,
    addOrStorePending: false,
    getPending: false,
    implementations: null,
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
        case GET_STUDENT:
            return {
                ...state,
                getPending: action.pending,
            }
        case GET_STUDENT_SUCCESS:
            return {
                ...state,
                student: action.student,
                getPending: action.pending,
            }
        case GET_STUDENT_ERROR:
            return {
                ...state,
                getPending: action.pending,
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
        case GET_IMPLEMENTATIONS_SUCCESS:
            return {
                ...state,
                implementations: action.implementations
            }
        case GET_IMPLEMENTATIONS_ERROR:
            return {
                ...state,
                error: action.error
            }
        case GET_IMPLEMENTATIONS_SUCCESS:
            return {
                ...state,
                implementations: action.implementations
            }
        case GET_IMPLEMENTATIONS_ERROR:
            return {
                ...state,
                error: action.error
            }
        default:
            return state;
    }
}
