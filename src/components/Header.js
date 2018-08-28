import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';
import { history } from '../store';

import Spinner from "./Spinner";

import * as userActions from '../actions/user';

const mapStateToProps = state => ({
    user: state.userSelectors.user
});

const mapActionsToProps = dispatch => ({
    getUser(token) {
        dispatch( userActions.getUser(token) );
    },
    userLogout() {
        dispatch( userActions.userLogout() )
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class Header extends Component {
    constructor(oProps) {
        super(oProps);
    }

    componentWillMount(){
        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }
    }

    handleLogout() {
        this.props.userLogout();
        history.push('/login');
    }

    render() {
        const {user} = this.props;

        if(this.props.hide){
            return null;
        }

        if (!this.props.user) {
            return (
                <div className="regular-spinner">
                    <Spinner message={'Chargement'} />
                </div>
            );
        }

        return(
            <header className="header">
            <div className="bg"></div>
                <h1 className="header__title">
                    <Link to="/" title="Retour à l'accueil">Jiri</Link>
                </h1>

                { user.is_admin ?
                    <nav className="header__menu">
                        <h2 className="sro">Navigation</h2>
                        <a href="" className="nav__link">Étudiants</a>
                        <a href="" className="nav__link">Jurys</a>
                        <a href="" className="nav__link">Projets</a>
                    </nav>
                : "" }

                <div className="user">
                    <button tabIndex="1" className="user__name">
                        {user.name} <i className="fa fa-caret-down"></i>

                        <a href="#" tabIndex="2" className="user__logout" onClick={this.handleLogout.bind(this)}>Déconnexion</a>
                    </button>

                </div>
            </header>
        );
    }
}
