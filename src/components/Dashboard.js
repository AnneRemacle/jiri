import React, { Component } from 'react';
import { connect } from "react-redux";
import { history } from '../store';

import * as userActions from '../actions/user';

const EMPTY_ERRORS = {
    email: [],
    password: []
};

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    error: state.userSelectors.error
});

const mapActionsToProps = dispatch => ({
    getUser(token) {
        dispatch( userActions.getUser(token) );
    }
});

@connect(mapStateToProps, mapActionsToProps)
export default class Dashboard extends Component {
    constructor(oProps){
        super(oProps);

        this.state = {
            values: {
                email: "",
                password: "",
            },
            errors: {
                email: [],
                password: [],
            },
        }
    }

    componentWillMount(){
        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    render() {
        if(this.props.user){
            return <p>"Vous êtes connecté" {this.props.user.name}</p>
        }

        return <p>{"Vous n'êtes pas connecté"}</p>
    }
}
