import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';
import { history } from '../store';

import * as userActions from '../actions/user';

const mapStateToProps = state => ({
    user: state.userSelectors.user
});

const mapActionsToProps = dispatch => ({
    userLogout() {
        dispatch( userActions.userLogout() )
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class Header extends Component {
    constructor(oProps) {
        super(oProps);
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
            return(
                <p>Chargement</p>
            );
        }

        return(
            <header className="header">
                <h1 className="header__title">
                    <Link to="/" title="Retour à l'accueil">Jiri</Link>
                </h1>
                <div className="user">
                    {user.name} <i className="fa fa-caret-down"></i>

                    <a href="#" className="user__logout button" onClick={this.handleLogout.bind(this)}>Déconnexion</a>
                </div>
            </header>
        );
    }
}
